<?php

    namespace App\Http\Controllers\Admins;
    use App\Model\Admins\Documents\AdminDocuments;
    use App\Model\Admins\PriceComponents;
    use App\Model\Clients\Clients;
    use App\Model\Fileaclaim\FileaclaimFiles;
    use App\Model\Logs\Logs;
    use App\Model\Main\BrandSlider;
    use App\Model\Main\MainIndustries;
    use App\Model\Main\MainIndustries2;
    use App\Model\Main\MainIndustries3;
    use App\Model\Main\MainIndustries4;
    use App\Model\Main\MainIndustries5;
    use App\Model\Main\MainJoin;
    use App\Model\Main\MainPageDescription;
    use App\Model\Main\MainSlider;
    use App\Model\Main\MainTailor;
    use App\Model\Notifications\Notifications;
    use App\Model\Orders\Orders;
    use App\Model\Orders\OrdersCategory;
    use App\Model\Orders\OrdersCategoryFiles;
    use App\Model\Orders\OrdersProducts;
    use App\Model\Orders\OrdersStatus;
    use App\Model\Photos\Photos;
    use App\Model\Points\Points;
    use App\Model\Points\PointsMed;
    use App\Model\Products\Products;
    use App\Model\Sessions;
    use App\Model\Clients\ClientsData;
    use App\Model\Visitors;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Model\Admins\Admins;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;

    class AdminsController extends Controller{
        private $admin_model,$data;

        /**
         * AdminsController constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request) {
            $this->admin_model = new Admins;
            $this->data = $request->post();
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function search_user(){
            $text=preg_replace('/\s+/', ' ', $this->data['text']);
            $data =  ClientsData::where('contact_name','LIKE','%'.$text.'%')->select('contact_name','users_id')
                ->get();
            foreach ($data as $project){
                $project->value=$project->users_id;
                $project->label=$project->contact_name;
                unset($project->users_id);
                unset($project->contact_name);
            }
            return response()->json($data,200);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function main(){
            //Get List
            $data = $this->admin_model->get_admin_list();

            return view('admin.admins',[
                'admins' => $data,
                'token' => Sessions::get_token()
            ]);
        }

        /**
         * @param $admins_id
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
         */
        public function admin_edit_view($admins_id){
            //Get data
            $admins_data = $this->admin_model->get_admin_by_id($admins_id);

            if(empty($admins_data)){
                return redirect('/panel/admin/admins');
            }

            return view('admin.admins_edit', [
                'data' => $admins_data,
                'token' => Sessions::get_token()
            ]);
        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function edit_admin_data(Request $request){
            //Update
            $this->admin_model->edit_data($request->update_data,'id',$this->data['admins_id']);

            return response()->json([
                'success' => true,
                'message' => 'success change'
            ],200);
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function delete_admin(){
            //Deleting
            $this->admin_model->delete_admin('id',$this->data['admins_id']);

            return response()->json([
                'success' => true,
                'message' => 'success deleted'
            ],200);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function add_admins_view(){
            return view('admin.admins_add',['token'=>Sessions::get_token()]);
        }


        public function notification_set_inactive(){
            if(!empty($this->data['notification_id'])){
                Notifications::where('id','=',$this->data['notification_id'])
                    ->update([
                       'is_view' => 0,
                        'is_new' => 0
                    ]);
                return response()->json(['success'=>true],200);
            }
            return response()->json(['success'=>false,'message'=>'Something went wrong!'],200);
        }


        public function main_slider_edit(Request $request){
            $insert_data['title'] = (!empty($this->data['title']))? $this->data['title']:'';

            if(!empty($request->file('file')) && !empty($this->data['main_slide_id'])){
                $last_src = MainSlider::where('id', '=', $this->data['main_slide_id'])->value('src');
                Photos::delete_photo($last_src);
                $src = Photos::upload_photo($request->file('file'),'/dis_photo/');
                $insert_data['src'] = $src;
            }

            if(!empty($this->data['main_slide_id'])){
                $slide_id = $this->data['main_slide_id'];
                MainSlider::where('id','=',$this->data['main_slide_id'])->update($insert_data);
            }else{
                $response = MainSlider::create($insert_data);
                $slide_id = $response->id;
            }

            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
                'type' => 'dis'
            ]);


            return response()->json([
                'success' => true,
                'id' => $slide_id
            ],200);
        }

        public function brand_slider_edit(Request $request){
            $insert_data['title'] =  (!empty($this->data['title']))?$this->data['title']:'';

            if(!empty($request->file('file')) && !empty($this->data['brand_slide_id'])){
                $last_src = BrandSlider::where('id', '=', $this->data['brand_slide_id'])->value('src');
                Photos::delete_photo($last_src);
                $src = Photos::upload_photo($request->file('file'),'/dis_photo/');
                $insert_data['src'] = $src;
            }

            if(!empty($this->data['brand_slide_id'])){
                $slide_id = $this->data['brand_slide_id'];
                BrandSlider::where('id','=',$this->data['brand_slide_id'])->update($insert_data);
            }else{
                $response = BrandSlider::create($insert_data);
                $slide_id = $response->id;
            }

            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
                'type' => 'dis'
            ]);

            return response()->json([
                'success' => true,
                'id' => $slide_id
            ],200);
        }

        public function main_slider_delete(Request $request){
            if(!empty($this->data['main_slide_id'])){
                $src = MainSlider::where('id', '=', $this->data['main_slide_id'])->value('src');
                Photos::delete_photo($src);

                MainSlider::where('id', '=', $this->data['main_slide_id'])->delete();

                Logs::create([
                    'admins_id' => $request->acc_data->id,
                    'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
                    'type' => 'dis'
                ]);

                return response()->json([
                    'success' => true
                ],200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ],200);
        }


        public function brand_slider_delete(Request $request){
            if(!empty($this->data['brand_slide_id'])){
                $src = BrandSlider::where('id', '=', $this->data['brand_slide_id'])->value('src');
                Photos::delete_photo($src);
                BrandSlider::where('id', '=', $this->data['brand_slide_id'])->delete();

                Logs::create([
                    'admins_id' => $request->acc_data->id,
                    'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the dis-content',
                    'type' => 'dis'
                ]);

                return response()->json([
                    'success' => true
                ],200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ],200);
        }

        public function main_slider_set_position(){
            if(!empty($this->data['positions'])){
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                    'type' => 'dis'
                ]);
                $array_id = explode(',',$this->data['positions']);
                foreach ($array_id as $key=>$value) {
                    MainSlider::where('id', '=', $value)->update([
                        'position' => $key
                    ]);
                }
            }
            return response()->json(['success'=>true],200);
        }

        public function main_descr_edit(Request $request){
            $insert_data = [
                'text' => $this->data['text'],
                'type' => $this->data['type']
            ];
            $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
            $admin_name_role = Admins::check_name_role_for_logs($admins_id);
            Logs::create([
                'admins_id' => $admins_id,
                'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                'type' => 'dis'
            ]);
            if(!empty($request->file('file'))){
                $photo_data = MainPageDescription::where('type','=',$this->data['type'])->first();
                if(!empty($photo_data->src)){
                    if (file_exists($photo_data->src)) {
                        unlink($photo_data->src);
                    }
                }
                $src = AdminDocuments::upload_static_file($request->file('file'));
                $insert_data = array_merge($insert_data,['src'=>$src]);
            }

            if(MainPageDescription::where('type','=',$this->data['type'])->exists()) {
                MainPageDescription::where('type','=',$this->data['type'])->update($insert_data);
            }else{
                MainPageDescription::create($insert_data);
            }
            return response()->json(['success'=>true],200);
        }

        public function brand_slider_set_position(){
            if(!empty($this->data['positions'])){
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                    'type' => 'dis'
                ]);
                $array_id = explode(',',$this->data['positions']);
                foreach ($array_id as $key=>$value) {
                    BrandSlider::where('id', '=', $value)->update([
                        'position' => $key
                    ]);
                }
            }
            return response()->json(['success'=>true,'data'=>$this->data['positions']],200);
        }


        public function tailor_slider_edit(Request $request){
            $insert_data = [
                'title' => $this->data['title'],
                'descr' => $this->data['descr']
            ];
            $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
            $admin_name_role = Admins::check_name_role_for_logs($admins_id);
            Logs::create([
                'admins_id' => $admins_id,
                'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                'type' => 'dis'
            ]);
            if(!empty($request->file('file')) && !empty($this->data['tailor_slide_id'])){
                $last_src = MainTailor::where('id', '=', $this->data['tailor_slide_id'])->value('src');
                Photos::delete_photo($last_src);
                $src = Photos::upload_photo($request->file('file'),'/dis_photo/');
                $insert_data['src'] = $src;
            }

            if(!empty($request->file('file1')) && !empty($this->data['tailor_slide_id'])){
                $last_src = MainTailor::where('id', '=', $this->data['tailor_slide_id'])->value('src_hover');
                Photos::delete_photo($last_src);
                $src = Photos::upload_photo($request->file('file1'),'/dis_photo/');
                $insert_data['src_hover'] = $src;
            }

            if(!empty($this->data['tailor_slide_id'])){
                $slide_id = $this->data['tailor_slide_id'];
                MainTailor::where('id','=',$this->data['tailor_slide_id'])->update($insert_data);
            }else{
                $response = MainTailor::create($insert_data);
                $slide_id = $response->id;
            }
            return response()->json(['success'=>true,'id'=>$slide_id],200);
        }

        public function tailor_slider_delete(){
            if(!empty($this->data['tailor_slide_id'])){
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                    'type' => 'dis'
                ]);
                $sliders_data = MainTailor::where('id', '=', $this->data['tailor_slide_id'])->select('src')
                    ->first();
                if (!empty($sliders_data->src)) {
                    if (file_exists($sliders_data->src)) {
                        unlink($sliders_data->src);
                    }
                }
                MainTailor::where('id', '=', $this->data['tailor_slide_id'])->delete();
                return response()->json(['success'=>true],200);
            }
            return response()->json(['success'=>false,'message'=>'Something went wrong!'],200);
        }

        public function industries_slider_set_position(){
            if(!empty($this->data['positions'])){
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                    'type' => 'dis'
                ]);
                $array_id = explode(',',$this->data['positions']);
                foreach ($array_id as $key=>$value) {
                    MainIndustries::where('id', '=', $value)->update([
                        'position' => $key
                    ]);
                }
            }
            return response()->json(['success'=>true,'type'=>'industries_slider_set_position','data'=>$this->data['positions']],200);
        }

        public function tailor_slider_set_position(){
            if(!empty($this->data['positions'])){
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                    'type' => 'dis'
                ]);
                $array_id = explode(',',$this->data['positions']);
                foreach ($array_id as $key=>$value) {
                    MainTailor::where('id', '=', $value)->update([
                        'position' => $key
                    ]);
                }
            }
            return response()->json(['success'=>true,'type'=>'tailor_slider_set_position','data'=>$this->data['positions']],200);
        }

        public function join_slider_edit(Request $request){
            $insert_data = [
                'title' => $this->data['title'],
                'descr' => $this->data['descr']
            ];
            $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
            $admin_name_role = Admins::check_name_role_for_logs($admins_id);
            Logs::create([
                'admins_id' => $admins_id,
                'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                'type' => 'dis'
            ]);
            if(!empty($request->file('file')) && !empty($this->data['join_slide_id'])){
                $last_src = MainJoin::where('id', '=', $this->data['join_slide_id'])->value('src');
                Photos::delete_photo($last_src);
                $src = Photos::upload_photo($request->file('file'),'/dis_photo/');
                $insert_data['src'] = $src;
            }

            if(!empty($request->file('file1')) && !empty($this->data['join_slide_id'])){
                $last_src = MainJoin::where('id', '=', $this->data['join_slide_id'])->value('src_hover');
                Photos::delete_photo($last_src);
                $src = Photos::upload_photo($request->file('file1'),'/dis_photo/');
                $insert_data['src_hover'] = $src;
            }

            if(!empty($this->data['join_slide_id'])){
                $slide_id = $this->data['join_slide_id'];
                MainJoin::where('id','=',$this->data['join_slide_id'])->update($insert_data);
            }else{
                $response = MainJoin::create($insert_data);
                $slide_id = $response->id;
            }
            return response()->json(['success'=>true,'id'=>$slide_id],200);
        }

        public function join_slider_delete(){
            if(!empty($this->data['join_slide_id'])){
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                    'type' => 'dis'
                ]);
                $sliders_data = MainJoin::where('id', '=', $this->data['join_slide_id'])->select('src')
                    ->first();
                if (!empty($sliders_data->src)) {
                    if (file_exists($sliders_data->src)) {
                        unlink($sliders_data->src);
                    }
                }
                MainJoin::where('id', '=', $this->data['join_slide_id'])->delete();
                return response()->json(['success'=>true],200);
            }
            return response()->json(['success'=>false,'message'=>'Something went wrong!'],200);
        }

        public function join_slider_set_position(){
            if(!empty($this->data['positions'])){
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') changed the dis-content',
                    'type' => 'dis'
                ]);
                $array_id = explode(',',$this->data['positions']);
                foreach ($array_id as $key=>$value) {
                    MainJoin::where('id', '=', $value)->update([
                        'position' => $key
                    ]);
                }
            }
            return response()->json(['success'=>true,'type'=>'join_slider_set_position','data'=>$this->data['positions']],200);
        }

        public function orders_view(Request $request){
            $response = [];
            $orders = Orders::orderBy('created_at','DESC')->get();
            foreach ($orders as $order) {
                $order->files = '';
                $response[date('o',strtotime($order->created_at))][] = $order;
                $cat_id = OrdersCategory::where('orders_id','=',$order->id)->where('title','=','Shipment Confirmation')->value('id');
                if($cat_id){
                    $files_str = '';
                    $files = OrdersCategoryFiles::where('orders_category_id','=',$cat_id)->select('src')->get();
                    foreach ($files as $file) {
                        $files_str.=$file->src.',';
                    }
                    $files_str = substr($files_str, 0, -1);
                    $order->files = $files_str;
                }
                $link = OrdersCategory::where('orders_id','=',$order->id)->where('title','=','Shipment Confirmation')->value('link');
                $order->link = $link;
            }
            return view('admin.orders',[
                'orders' => $response,
                'role' => $request->acc_data->role,
                'token' => Sessions::get_token()
            ]);
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function delete_order(Request $request){
            if(!empty($this->data['orders_id'])){
                Orders::where('id','=',$this->data['orders_id'])->delete();
                $orders_prod = OrdersProducts::where('orders_id','=',$this->data['orders_id'])->select('products_id','quantity')->get();
                foreach ($orders_prod as $product) {
                    Products::where('id','=',$product->products_id)->increment('in_stock',(int)$product->quantity);
                }

                Logs::create([
                    'admins_id' => $request->acc_data->id,
                    'text' => $request->acc_data->name.'('.$request->acc_data->role.') removed the order ( Ref '.Orders::where('id', '=', $this->data['orders_id'])->value('dis_ref').')',
                    'type' => 'orders'
                ]);
            }
            return response()->json([
                'success' => true
            ],200);
        }

        public function orders_documents_view($id,Request $request){
            if(!Orders::where('id','=',$id)->exists() || empty($id)){
                return redirect('/panel/admin/orders');
            }else {
                $orders_data = Orders::where('id','=',$id)->first();
                $products_data = OrdersProducts::select('*')
                    ->where('orders_products.orders_id','=',$id)
                    ->get();
                $orders_categories = OrdersCategory::where('orders_id','=',$id)
                    ->select('orders_id','title','id','link')
                    ->get();
                foreach ($orders_categories as $orders_category) {
                    $files = '';
                    $ids = '';
                    $type_files = '';
                    $j=0;
                    $files_ids =  OrdersCategoryFiles::where('orders_category_id','=',$orders_category->id)
                        ->select('src','id')->get();
                    foreach ($files_ids as $item) {
                        $j++;
                        $filename = $item->src;
                        $url = explode('/',$filename);

                        $prom_type = explode('.',$url[count($url)-1]);
                        $type_files.= $prom_type[count($prom_type)-1].',';
                        $files.=$url[count($url)-1].',';
                        $ids.=$item->id.',';
                    }
                    $files = substr($files,0,-1);
                    $ids = substr($ids,0,-1);
                    $type_files = substr($type_files,0,-1);
                    $orders_category->files = $files;
                    $orders_category->files_ids = $ids;
                    $orders_category->files_count = $j;
                    $orders_category->type_files = $type_files;
                    if(!empty($orders_category->link)){
                        $orders_category->files_count++;
                    }
                }
                return view('admin.orders_documents',[
                    'role' => $request->acc_data->role,
                    'orders_data' => $orders_data,
                    'products_data' => $products_data,
                    'orders_categories' => $orders_categories,
                    'token' => Sessions::get_token()
                ]);
            }
        }

        public function edit_orders_info(Request $request){
            if(!empty($this->data['orders_id'])){
                $update_data = [];
                foreach (['pol','pod','etd','eta','shipping_company','bl_number'] as $field) {
                    if(!empty($this->data[$field])){
                        $update_data[$field] = $this->data[$field];
                    }
                }

                Orders::where('id','=',$this->data['orders_id'])->update($update_data);

                return response()->json(['success'=>true,'message'=>'Something went wrong'],200);
            }

            return response()->json(['success'=>false,'message'=>'Something went wrong'],200);
        }

        public function change_order_status(Request $request){
            $update_data['arrival_date'] = date('M d, o h:i a');
            $update_data['status'] = $this->data['status'];
            $update_data['tracking_link'] = (!empty($this->data['tracking_link']))?$this->data['tracking_link']:'';
            Orders::where('id','=',$this->data['orders_id'])->update($update_data);

            if($this->data['status'] == 'Paid in Full' && !OrdersStatus::where('status','=','Paid in Full')->where('orders_id','=',$this->data['orders_id'])->exists()){
                $p_m = PointsMed::where('orders_id','=',$this->data['orders_id'])->select('count','users_id')->first();
                if(!empty($p_m)) {
                    $orders_name = Orders::where('id','=', $this->data['orders_id'])->value('dis_ref');
                    Points::create([
                        'users_id'    => $p_m->users_id,
                        'orders_id'   => $this->data['orders_id'],
                        'orders_name' => $orders_name,
                        'count'       => $p_m->count
                    ]);
                    PointsMed::where('orders_id', '=', $this->data['orders_id'])->delete();
                    ClientsData::where('users_id', '=', $p_m->users_id)->increment('dis_points', $p_m->count);
                    ClientsData::ref_points_updates($p_m->users_id,$this->data['orders_id'],$orders_name,$p_m->count);
                }


            }

            if(!OrdersStatus::where('status','=',$this->data['status'])->where('orders_id','=',$this->data['orders_id'])->exists()){
                OrdersStatus::create([
                    'orders_id' => $this->data['orders_id'],
                    'status' => $this->data['status']
                ]);
            }

            //Send Email
            if(!empty($this->data['sent_email']) && $this->data['sent_email']=='yes') {
                Mail::raw('Order Ref' . $this->data['orders_id'] . ' status changed to ' . ucfirst($this->data['status']), function ($message) {
                    $order_users_email = ClientsData::where('users_id', '=', Orders::where('id', '=', $this->data['orders_id'])->value('users_id'))->value('email');
                    $message->to($order_users_email);
                    $message->from('dis2@yobibyte.in.ua');
                    $message->subject('Orders status changed');
                });
            }

            //Create Log
            Logs::create([
                'admins_id' => $request->acc_data->id,
                'text' => $request->acc_data->name.'('.$request->acc_data->role.') changed the status of order ( Ref'.Orders::where('id', '=', $this->data['orders_id'])->value('dis_ref').') to "'.ucfirst($this->data['status']).'"',
                'type' => 'orders'
            ]);


            return response()->json([
                'success' => true
            ],200);
        }

        public function category_order_create(Request $request){
            $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
            $admin_name_role = Admins::check_name_role_for_logs($admins_id);
            $src = '';

            if(!empty($this->data['type']) && $this->data['type']=='Shipment Confirmation'){
                if(!empty($this->data['link'])) {
                    $link = $this->data['link'];
//                    if (strpos($link, 'http://') === false || strpos($link, 'https://') === false) {
//                        $link = 'http://' . $link;
//                    }
                }else{
                    $link = NULL;
                }
                OrdersCategory::where('id','=',$this->data['data_id'])->update([
                    'link' => $link
                ]);
                return response()->json(['success'=>true,'data'=>$this->data],200);
            }


            if(!empty($request->file('file'))){
                $src = FileaclaimFiles::upload_file($request->file('file'));
            }
            if(empty($this->data['cat_id'])) {
                $cat_data = OrdersCategory::create([
                    'title' => $this->data['title'],
                    'orders_id' => $this->data['orders_id']
                ]);
                $cat_id = $cat_data->id;
                Mail::raw('The file was attached to the order Ref'.$this->data['orders_id'],function ($message){
                    $orders_data = Orders::where('id','=',$this->data['orders_id'])->select('users_id')->first();
                    $users_data = ClientsData::where('users_id','=',$orders_data->users_id)->select('email')->first();
                    $message->subject('Orders documents');
                    $message->to($users_data->email);
                    $message->from('dis@yobibyte.in.ua');
                });
                $orders_id = OrdersCategory::where('id','=',$cat_id)->value('orders_id');
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') created the category ('.$this->data['title'].') of order ( Ref'.Orders::where('id', '=', $orders_id)->value('dis_ref').')',
                    'type' => 'orders'
                ]);
            }else{
                $cat_id = $this->data['cat_id'];
            }
            if(!empty($src)){
                $title = OrdersCategory::where('id','=',$cat_id)->value("title");
                $orders_id = OrdersCategory::where('id','=',$cat_id)->value('orders_id');
                OrdersCategoryFiles::create([
                    'orders_category_id' => $cat_id,
                    'src' => $src
                ]);
                Logs::create([
                    'admins_id' => $admins_id,
                    'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') attached the file to category ('.$title.') of order ( Ref'.Orders::where('id', '=', $orders_id)->value('dis_ref').')',
                    'type' => 'orders'
                ]);
            }
            return response()->json(['success'=>true],200);
        }

        public function category_order_delete(){
            if(!empty($this->data['data_id']) && !empty($this->data['type'])){
                $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
                $admin_name_role = Admins::check_name_role_for_logs($admins_id);

                if($this->data['type'] == 'category') {
                    $cat_data = OrdersCategory::where('id','=',$this->data['data_id'])->select('title','orders_id')->first();
                    Logs::create([
                        'admins_id' => $admins_id,
                        'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') removed the category ('.$cat_data->title.') of order ( Ref'.Orders::where('id', '=', $cat_data->orders_id)->value('dis_ref').')',
                        'type' => 'orders'
                    ]);
                    OrdersCategory::where('id', '=', $this->data['data_id'])->delete();
                }elseif ($this->data['type'] == 'file'){
                    $cat_id = OrdersCategoryFiles::where('id', '=', $this->data['data_id'])->value('orders_category_id');
                    $cat_data = OrdersCategory::where('id','=',$cat_id)->select('title','orders_id')->first();
                    $src = OrdersCategoryFiles::where('id', '=', $this->data['data_id'])->value('src');
                    if (!empty($src)) {
                        if (file_exists($src)) {
                            unlink($src);
                        }
                    }
                    OrdersCategoryFiles::where('id', '=', $this->data['data_id'])->delete();
                    Logs::create([
                        'admins_id' => $admins_id,
                        'text' => $admin_name_role['name'].'('.$admin_name_role['role'].') removed the file in category ('.$cat_data->title.') of order ( Ref'.$cat_data->orders_id.')',
                        'type' => 'orders'
                    ]);
                }
            }
            return response()->json(['success'=>true],200);
        }

        public function main_page_view(Request $request){

            $orders = Orders::select('total_amount')->get();
            $total_sum = 0;
            $total_orders = 0;
            foreach ($orders as $order) {
                $total_orders++;
                $total_sum+=$order->total_amount;
            }
            $doc_count = AdminDocuments::count();
            $total_prod = Products::where('is_deleted','=',0)->count();
            if($request->acc_data->role=='sales') {
                $users_data = ClientsData::limit(29)->where('can_see','=',1)->where('regione','=',$request->acc_data->regione)->select('users_id', 'contact_name')->get();
            }else{
                $users_data = ClientsData::limit(29)->where('can_see','=',1)->select('users_id', 'contact_name')->get();
            }
            $users_count = 0;
            if(count($users_data)>0) {
                foreach ($users_data as $user) {
                    $sum = 0;
                    $users_count++;
                    $orders_us = Orders::where('users_id', '=', $user->users_id)->get();
                    $user->count_orders = count($orders_us);
                    foreach ($orders_us as $order) {
                        $sum += $order->total_amount;
                    }
                    $user->total_sum = $sum;
                }
            }

            //Obj to Array
            if(!empty($users_data)) {
                foreach ($users_data as $user) {
                    $sort_arrays[] = json_decode(json_encode($user), true);
                }
                usort($sort_arrays, function ($a, $b) {
                    return ($b['total_sum'] - $a['total_sum']);
                });
                //Array to Obj
                $users_data = json_decode(json_encode($sort_arrays), false);
            }



            //Stat
            if($request->acc_data->role!='sales') {
                $users_arr = ClientsData::where('can_see','=',1)->get();
            }else{
                $users_arr = ClientsData::where('regione','=',$request->acc_data->regione)
                    ->where('can_see','=',1)
                    ->get();
            }

            //Statistics for per country volume
            $users_per_country = [];
            $users_per_country_arr = [];
            $count_per_country = 0;
            if(count($users_arr)>0) {
                foreach ($users_arr as $user) {
                    $count_per_country++;
                    if (!empty($users_per_country[$user->country])) {
                        $users_per_country[$user->country] += 1;
                    } else {
                        $users_per_country[$user->country] = 1;
                    }
                }
                $color = 0;
                foreach ($users_per_country as $key => $val) {
                    $users_per_country_arr[$key] = ['count' => $val, 'color' => self::random_html_color($color), 'proc' => round((($val * 100) / $count_per_country), 0)];
                    $color++;
                }
            }


            //Statistics for per client volume
            $i = 0;
            $per_client = [];
            $per_client['active'] = 0;
            $per_client['inactive'] = 0;
            $per_client_arr = [];
            if(count($users_arr)>0) {
                foreach ($users_arr as $user) {
                    $i++;
                    if (Orders::where('users_id', '=', $user->users_id)->exists()) {
                        $per_client['active'] += 1;
                    } else {
                        $per_client['inactive'] += 1;
                    }
                }
                foreach ($per_client as $key => $item) {
                    $per_client_arr[$key] = ['type' => $key, 'value' => $item, 'proc' => round((($item * 100) / $i), 0)];
                }
            }else{
                $per_client_arr['active'] = ['type' => 'active', 'value' => 0, 'proc' => 0];
                $per_client_arr['inactive'] = ['type' => 'inactive', 'value' => 0, 'proc' => 0];
            }


            //Statistics for per brand volume
            $i=0;
            $per_brand = [];
            $per_brand_arr = [];
            if($request->acc_data->role=='sales') {
                $orders_data = OrdersProducts::select('orders_products.products_id', 'orders.users_id', 'users_data.regione')
                    ->leftJoin('orders', 'orders_products.orders_id', '=', 'orders.id')
                    ->leftJoin('users_data', 'orders.users_id', '=', 'users_data.users_id')
                    ->where('users_data.regione', '=', $request->acc_data->regione)
                    ->get();
            }else{
                $orders_data = OrdersProducts::get();
            }
            foreach ($orders_data as $orders_datum) {
                $i++;
                $product_data = Products::where('id','=',$orders_datum->products_id)->select('brand')->first();
                if(!empty($per_brand[$product_data->brand])){
                    $per_brand[$product_data->brand]+=1;
                }else{
                    $per_brand[$product_data->brand]=1;
                }
            }
            $color = 0;
            foreach ($per_brand as $key=>$val) {
                $per_brand_arr[$key] = ['value'=>$val,'color'=>self::random_html_color($color),'proc'=>round((($val*100)/$i),0)];
                $color++;
            }


            //Per Payments term volume
            $i=0;
            $per_term = [];
            $per_term_arr = [];
            if($request->acc_data->role!='sales') {
                $orders_data = Orders::get();
            }else{
                $orders_data = Orders::select('orders.payment_terms','orders.users_id','users_data.regione')
                    ->leftJoin('users_data', 'orders.users_id', '=', 'users_data.users_id')
                    ->where('users_data.regione', '=', $request->acc_data->regione)
                    ->get();
            }
            foreach ($orders_data as $orders_datum) {
                $i++;
                if(!empty($per_term[$orders_datum->payment_terms])){
                    $per_term[$orders_datum->payment_terms]+=1;
                }else{
                    $per_term[$orders_datum->payment_terms]=1;
                }
            }
            $color = 0;
            foreach ($per_term as $key=>$val) {
                $per_term_arr[$key] = ['value'=>$val,'color'=>self::random_html_color($color),'proc'=>round((($val*100)/$i),0)];
                $color++;
            }

            //Statistics for per brand volume
            $i=0;
            $per_prod = [];
            $per_prod_arr = [];
            if($request->acc_data->role!='sales') {
                $orders_data = OrdersProducts::get();
            }else{
                $orders_data = OrdersProducts::select('orders_products.products_id', 'orders.users_id', 'users_data.regione')
                    ->leftJoin('orders', 'orders_products.orders_id', '=', 'orders.id')
                    ->leftJoin('users_data', 'orders.users_id', '=', 'users_data.users_id')
                    ->where('users_data.regione', '=', $request->acc_data->regione)
                    ->get();
            }
            foreach ($orders_data as $orders_datum) {
                $i++;
                if(!empty($per_prod[$orders_datum->products_id])){
                    $per_prod[$orders_datum->products_id]+=1;
                }else{
                    $per_prod[$orders_datum->products_id]=1;
                }
            }
            $color = 0;
            foreach ($per_prod as $key=>$val) {
                $product_data = Products::where('id','=',$key)->select('product_name')->first();
                $per_prod_arr[$product_data->product_name] = ['value'=>$val,'color'=>self::random_html_color($color),'proc'=>round((($val*100)/$i),0)];
                $color++;
            }


            //Statistics for per brand volume
            //Statistics for per brand volume
            $i1=0;
            $per_country_ship1 = [];
            $per_country_ship_arr1 = [];
            if($request->acc_data->role!='sales') {
                $orders_data1 = Orders::get();
            }else{
                $orders_data1 = Orders::select('orders.payment_terms','orders.users_id','users_data.regione')
                    ->leftJoin('users_data', 'orders.users_id', '=', 'users_data.users_id')
                    ->where('users_data.regione', '=', $request->acc_data->regione)
                    ->get();
            }
            foreach ($orders_data1 as $orders_datum) {
                $i1++;
                $users_data1 = ClientsData::where('users_id','=',$orders_datum->users_id)->first();
                if(!empty($per_country_ship1[$users_data1['country']])){
                    $per_country_ship1[$users_data1['country']]++;
                }else{
                    $per_country_ship1[$users_data1['country']]=1;
                }
            }
            $color = 0;
            foreach ($per_country_ship1 as $key1=>$val1) {
                $per_country_ship_arr1[$key1] = ['value'=>$val1,'color'=>self::random_html_color($color),'proc'=>round((($val1*100)/$i1),0)];
                $color++;
            }

            //Statistics for per brand volume
            $i2=0;
            $per_country_ship2 = [];
            $per_country_ship_arr2 = [];
            if($request->acc_data->role!='sales') {
                $orders_data2 = Orders::get();
            }else{
                $orders_data2 = Orders::select('orders.payment_terms','orders.users_id','users_data.regione')
                    ->leftJoin('users_data', 'orders.users_id', '=', 'users_data.users_id')
                    ->where('users_data.regione', '=', $request->acc_data->regione)
                    ->get();
            }
            foreach ($orders_data2 as $orders_datum) {
                $i2++;
                $users_data2 = ClientsData::where('users_id','=',$orders_datum->users_id)->first();
                if(!empty($per_country_ship2[$users_data2['regione']])){
                    $per_country_ship2[$users_data2['regione']]++;
                }else{
                    $per_country_ship2[$users_data2['regione']]=1;
                }
            }
            $color = 0;
            foreach ($per_country_ship2 as $key2=>$val2) {
                $per_country_ship_arr2[$key2] = ['value'=>$val2,'color'=>self::random_html_color($color),'proc'=>round((($val2*100)/$i2),0)];
                $color++;
            }



//            dd($users_per_country_arr);
            $visitors = Visitors::get_count();
            return view('admin.welcome',[
                'users_count' => $users_count,
                'total_sum' => $total_sum,
                'total_prod' => $total_prod,
                'total_orders' => $total_orders,
                'doc_count' => $doc_count,
                'users_data' => $users_data,
                'users_per_country' => $users_per_country_arr,
                'per_client_arr' => $per_client_arr,
                'per_brand_arr' => $per_brand_arr,
                'per_term_arr' => $per_term_arr,
                'per_prod_arr' => $per_prod_arr,
                'per_country_ship_arr' => $per_country_ship_arr1,
                'per_regione_ship_arr' => $per_country_ship_arr2,
                'role' => $request->acc_data->role,
                'visitors' => $visitors
            ]);
        }

        public function random_html_color($i) {
            $arr = ['#5eadce','#568fb6','#cdc964','#6ec174','#4c6897','#eca46e'];
            if($i>5) {
                return sprintf('#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255));
            }else{
                return $arr[$i];
            }
        }


        public function edit_price_components(Request $request){
            if($request->acc_type == 'admin'){
                $array_field = [
                    'pallet_price' => '',
                    'insurance' => '',
                    'south_east_asia' => '',
                    'north_america' => '',
                    'south_america' => '',
                    'mena' => ''
                ];
                foreach ($array_field as $key=>$value) {
                    if(!empty($this->data[$key])){
                        PriceComponents::where('type','=',$key)->update(['value'=>$this->data[$key]]);
                    }
                }
                return response()->json(['success'=>true],200);
            }

            return response()->json(['success'=>false,'message'=>'You do not have permission'],200);
        }


        public function create_region(Request $request){
            $type = Clients::get_type_for_region($this->data['title']);
            if(!PriceComponents::where('type','=',$type)->exists()) {
                PriceComponents::create([
                    'type' => $type,
                    'value' => $this->data['value'],
                    'title' => $this->data['title']
                ]);
                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'message' => 'Region is already exists'], 200);
        }

        public function delete_region(Request $request){
            PriceComponents::where('id','=',$this->data['id'])->delete();
            return response()->json(['success' => true], 200);
        }
        /**
         *Destruct
         */
        public function __destruct(){
            unset($this->admin_model);
            unset($this->data);
        }
    }
