<?php

    namespace App\Http\Controllers\Admins\Products;
    use App\Model\Admins\PriceComponents;
    use App\Model\Brands\Brands;
    use App\Model\Category\Category;
    use App\Model\Logs\Logs;
    use App\Model\Orders\Orders;
    use App\Model\Orders\OrdersCategory;
    use App\Model\Orders\OrdersCategoryFiles;
    use App\Model\Photos\Photos;
    use App\Model\Points\Points;
    use App\Model\Prize\Prize;
    use App\Model\Sessions;
    use App\Model\Clients\ClientsData;
    use Illuminate\Http\Request;
    use App\Model\Products\Products;
    use App\Http\Controllers\Controller;
    use App\Model\Admins\Admins;
    use App\Model\Products\ProductsPhoto;
    use App\Model\Products\ProductsDocument;
    use Maatwebsite\Excel\Facades\Excel;
    use App\Imports\Model\Products\ProductsImport;

    class ProductsController extends Controller{
        private $data,$products_model;

        /**
         * AdminsController constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request) {
            $this->products_model = new Products();
            $this->data = $request->post();
        }


        /**
         * @param $products_id
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
         */
        public function products_view_by_id($products_id, Request $request){
            if($this->products_model->check_exists_products($products_id)) {
                //Get Data
                $data = $this->products_model->get_products_data_by_id($products_id);
                $pallet_price = PriceComponents::where('type','=','pallet_price')->value('value');
                return view('admin.view_products',[
                    'data' => $data,
                    'admin_role' => $request->acc_data->role,
                    'pallet_price' => (!empty($pallet_price))?$pallet_price:0
                ]);
            }

            return redirect('/panel/admin/catalog');
        }

        public function change_status(Request $request){
            //Change Status
            switch ($this->data['type']){
                case 'active':
                    $this->products_model->change_active_status($this->data['products_id'],$this->data['value']);
                    $this->products_model->change_absent_status($this->data['products_id'], 1);
                    $this->products_model->change_pre_order_status($this->data['products_id'], 0);
                break;
                case 'absent':
                    $this->products_model->change_absent_status($this->data['products_id'],$this->data['value']);
                    $this->products_model->change_active_status($this->data['products_id'], 0);
                    $this->products_model->change_pre_order_status($this->data['products_id'],0);
                break;
                case 'pre_order':
                    $this->products_model->change_pre_order_status($this->data['products_id'],$this->data['value']);
                    $this->products_model->change_active_status($this->data['products_id'],0);
                    $this->products_model->change_absent_status($this->data['products_id'],1);
                break;
            }

            //Create Log
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the status of product ('.$request->products_name.') to '.ucfirst($this->data['type']),
                'type' => 'products'
            ]);


            return response()->json([
                'success' => true,
                'message' => 'success changed status'
            ],200);
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function delete_products(Request $request){
            foreach ($this->data['products_id'] as $prod_id) {

                //Deleting
                $this->products_model->delete_documents('products_id', $prod_id);
                $this->products_model->delete_photos('products_id', $prod_id);
                $this->products_model->delete_products('id', $prod_id);

                //Create Log
                Logs::create([
                    'admins_id' => $request->acc_data->id,
                    'text' => $request->acc_data->name.'('.$request->acc_data->role.') remove the product ('.$request->products_data->product_name.')',
                    'type' => 'products'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'success deleted products'
            ],200);
        }

        public function delete_prize(Request $request){
            //Deleting
            foreach ($this->data['prizes_id'] as $prod_id) {
                $prize_name = Prize::where('id','=',$prod_id)->value('title');

                //Create Log
                Logs::create([
                    'admins_id' => $request->acc_data->id,
                    'text' => $request->acc_data->name.'('.$request->acc_data->role.') removed the prize ('.$prize_name.') ',
                    'type' => 'prizes'
                ]);

                //Removing
                Prize::where('id','=',$prod_id)->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'success deleted prize'
            ],200);
        }

        public function update_product(Request $request){
            //Update Product
            $this->products_model->update_products($this->data['products_id'],$request->update_data);

            if($request->file('photo_files')) {
                //Delete Last Photo
                $this->products_model->products_photo_model->delete_files($this->data['products_id']);

                //Uploading new
                foreach ($request->file('photo_files') as $file) {
                    $url = Photos::upload_photo($file, '/products_photo/');
                    $this->products_model->products_photo_model->create_new($url, $this->data['products_id']);
                }
            }
            if($request->file('doc_files')) {
                //Delete Last Doc
                $this->products_model->products_documents_model->delete_files($this->data['products_id']);

                //Uploading new
                foreach ($request->file('doc_files') as $file) {
                    $url = Photos::upload_photo($file, '/products_documents/');
                    $this->products_model->products_documents_model->create_new($url, $this->data['products_id']);
                }
            }

            //Creating Log
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the product ('.$request->products_name.')',
                'type' => 'products'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'success updated product'
            ],200);
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function add_product(Request $request){
            //Create Product
            $products_id = $this->products_model->create_product($request->insert_data);

            $this->products_model->delete_documents('products_id', $products_id);
            $this->products_model->delete_photos('products_id', $products_id);
            //Upload Photo
            if(!empty($request->file('photo_files'))) {
                foreach ($request->file('photo_files') as $file) {
                    $url = Photos::upload_photo($file, '/products_photo/');
                    $this->products_model->products_photo_model->create_new($url, $products_id);
                }
            }

            //Upload Doc Files
            if(!empty($request->file('doc_files'))) {
                foreach ($request->file('doc_files') as $file) {
                    $url = Photos::upload_photo($file, '/products_documents/');
                    $this->products_model->products_documents_model->create_new($url, $products_id);
                }
            }

            //Creating Log
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') create a product ('.$this->data['product_name'].')',
                'type' => 'products'
            ]);


            return response()->json([
                'success' => true,
                'message' => 'success added product'
            ],200);
        }

        public function update_prize(Request $request){
            //Upload Photo
            if(!empty($request->file('prize_img'))) $request->update_data['src']  = Photos::upload_photo($request->file('prize_img'),'/prize_img/');


            $prize_model = new Prize();
            //Updating
            $prize_model->update_prize($this->data['prize_id'],$request->update_data);


            //Create Log
            $prize_name = Prize::where('id','=',$this->data['prize_id'])->value('title');
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the prize ('.$prize_name.')',
                'type' => 'prizes'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'success updated prize'
            ],200);
        }

        public function add_prize(Request $request){
            //Upload Photo
            $request->insert_data['src'] = (!empty($request->file('prize_img'))) ? Photos::upload_photo($request->file('prize_img'),'/prize_img/') : '';

            $prize_model = new Prize();
            //Creating
            $prize_model->create_new($request->insert_data);

            //Create Log
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') created a prize ('.$this->data['title'].')',
                'type' => 'prizes'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'success added prize'
            ],200);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function add_product_view(){
            $brands_model = new Brands();
            $categories_model = new Category();
            //Get Data
            $brands = $brands_model->get_brands();
            $category = $categories_model->get_categories();

            return view('admin.add_products',[
                'token' => Sessions::get_token(),
                'brands' => $brands,
                'categories' => $category
            ]);
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function catalog_view(Request $request){
            $find_by = (empty($this->data['find_by']))? NULL:$this->data['find_by'];

            //Get Products
            $products = $this->products_model->get_products($find_by);

            //Get Prizes
            $prize_model = new Prize();
            $prizes = $prize_model->get_prizes($find_by);

            //price components
            $p_c = [];
            $price_components = PriceComponents::get();
            foreach ($price_components as $component) {
                $p_c[$component->type] = $component->value;
            }

            return view('admin.catalog',[
                'token' => Sessions::get_token(),
                'products' => $products,
                'prizes' => $prizes,
                'admin_role' => $request->acc_data->role,
                'p_c' => $p_c,
                'price_components' => $price_components
            ]);
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function add_brand(){
            $brands_model = new Brands();
            //Creating
            $brands_model->create_new($this->data['title']);

            return response()->json([
                'success' => true
            ],200);
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function add_category(){
            $categories_model = new Category();
            //Creating
            $categories_model->create_new($this->data['title']);

            return response()->json([
                'success' => true
            ], 200);
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function delete_brand(){
            $brands_model = new Brands();
            //Deleting
            $brands_model->delete_brand($this->data['item']);

            return response()->json([
                'success' => true
            ],200);
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function delete_order_category(){
            $orders_model = new Orders();
            //Delete Files
            $orders_model->orders_category_files_model->delete_files($this->data['cat_id']);

            //Delete Category
            $orders_model->orders_category_model->delete_category($this->data['cat_id']);

            return response()->json([
                'success' => true,
                'message' => 'success deleting'
            ],200);
        }

        public function delete_category(){
            $categories_model = new Category();
            //Deleting
            $categories_model->delete_category($this->data['item']);

            return response()->json([
                'success' => true
            ],200);
        }

        public function edit_products_view(
            $products_id,
            Brands $brands_model,
            Category $category_model,
            ProductsDocument $products_document_model
        )
        {
            if(Products::where('id','=',$products_id)->exists()) {
                //Get Data
                $products_data = $this->products_model->get_products_data_by_id($products_id);
                $brands = $brands_model->get_brands();
                $category = $category_model->get_categories();
                $documents = $products_document_model->get_documents_by_products_id($products_id);

                return view('admin.edit_products',[
                    'token' => Sessions::get_token(),
                    'products_data' => $products_data,
                    'brands' => $brands,
                    'categories' => $category,
                    'documents' => $documents
                ]);
            }
            return redirect('/panel/admin/catalog');
        }

        public function prod_photo_delete(){
            //Deleting
            if(!empty($this->data['photo_id'])){
                $this->products_model->products_photo_model->delete_photo_by_id($this->data['photo_id']);
            }

            return response()->json([
                'success' => true,
                'message' => 'success deleted'
            ],200);
        }

        public function prod_doc_delete(){
            //Deleting
            if(!empty($this->data['doc_id'])){
                $this->products_model->products_documents_model->delete_documents_by_id($this->data['doc_id']);
            }

            return response()->json([
                'success' => true,
                'message' => 'success deleted'
            ],200);
        }


        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function products_user_view(){
            $products  = $this->products_model->get_products_for_user();

            return view('user.products',[
                'products' => $products
            ]);
        }

        public function upload_xls_file(Request $request){
//            $link = Photos::upload_photo($request->file('xls_file'),'/xls_file/');
            Excel::import(new ProductsImport(), $request->file('xls_file'));
            return response()->json([
                'success' => true
            ],200);
        }



        /**
         *Destruct
         */
        public function __destruct(){
            unset($this->products_model);
            unset($this->data);
        }
    }
