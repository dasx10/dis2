<?php

namespace App\Model\Products;
use App\Model\Brands\Brands;
use App\Model\Category\Category;
use Illuminate\Database\Eloquent\Model;
use App\Model\Products\ProductsPhoto;
use App\Model\Products\ProductsDocument;
use Illuminate\Support\Facades\Storage;
class Products extends Model{
    public $products_documents_model,$products_photo_model;
    protected $table = 'products';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','created_by','product_name','product_code','specification',
        'category','brand','shipping_class','type_of_packaging1','type_of_packaging2',
        'type_of_packaging3','type_of_packaging1_price','type_of_packaging2_price','type_of_packaging3_price',
        'pallet_without_pallet','price_prod_plus_packaging1',
        'price_prod_plus_packaging2','price_prod_plus_packaging3',
        'lwh_packaging1_wp','lwh_packaging1_p','lwh_packaging2_wp','lwh_packaging2_p',
        'lwh_packaging3_wp','lwh_packaging3_p','loading_port','restrictions','descr',
        'fcl','is_deleted','active','absent','in_stock','pre_order','cas',
        'moc_1_1','moc_1_2','moc_1_3','moc_2_1','moc_2_2','moc_2_3',
        'moc_3_1','moc_3_2','moc_3_3', 'pallet_capacity_for_packaging_type_1',
        'pallet_capacity_for_packaging_type_2','pallet_capacity_for_packaging_type_3'];


    /**
     * Products constructor.
     */
    public function __construct() {
        $this->products_photo_model = new ProductsPhoto();
        $this->products_documents_model = new ProductsDocument();
    }

    /**
     * @param $file
     *
     * @return string
     */
    public function save_images($file){
        $name = str_random(10).time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/products_photo');
        $file->move($destinationPath, $name);
        $full_name = asset('public/products_photo/'.$name);
        return $full_name;
    }

    /**
     * @param $array
     * @param $value
     */
    public function change_active_status($array, $value){
        self::whereIn('id', $array)->update([
           'active'=>$value
        ]);
    }

    /**
     * @param $array
     * @param $value
     */
    public function change_absent_status($array, $value){
        return self::whereIn('id', $array)->update([
            'absent'=>$value
        ]);
    }

    /**
     * @param $array
     * @param $value
     *
     * @return mixed
     */
    public function change_pre_order_status($array, $value){
        return self::whereIn('id', $array)->update([
            'pre_order'=>$value
        ]);
    }

    /**
     * @param $products_id
     *
     * @return bool
     */
    public function check_exists_products($products_id){
        $data = self::where([
            ['id','=',$products_id],
            ['is_deleted','=','0']
        ])->exists();
        if($data){
            return true;
        }

        return false;
    }

    /**
     * @param $products_id
     *
     * @return mixed
     */
    public function get_products_data_by_id($products_id){
        $data =  self::where('id','=',$products_id)->first();

        //Get Photos
        $data->photos = $this->products_photo_model->get_photos_by_products_id($products_id);

        //Get Documents
        $data->documents = $this->products_documents_model->get_documents_by_products_id($products_id);

        return $data;
    }

    /**
     * @param $type
     * @param $value
     */
    public function delete_products($type, $value){
        return self::where($type,'=',$value)->update([
            'is_deleted'=>1
        ]);
    }


    /**
     * @param $type
     * @param $value
     *
     * @return bool
     */
    public function delete_documents($type, $value){
        $data = ProductsDocument::select('filename')->where($type,'=',$value)->get();
        foreach ($data as $item) {
            Storage::delete($item->filename);
        }
        ProductsDocument::where($type,'=',$value)->delete();

        return true;
    }


    /**
     * @param $type
     * @param $value
     *
     * @return bool
     */
    public function delete_photos($type, $value){
        $data = ProductsPhoto::select('filename')->where($type,'=',$value)->get();
        foreach ($data as $item) {
            Storage::delete($item->filename);
        }
        ProductsPhoto::where($type,'=',$value)->delete();

        return true;
    }

    /**
     * @return mixed
     */
    public function get_products($find_by=NULL){
        $data =  self::orderBy('products.created_at','DESC')
            ->select('products.*','ph.filename as photo')
            ->leftJoin('products_photo as ph','products.id','=','ph.products_id')
            ->where('products.is_deleted','=','0')
            ->groupBy('products.id');

        if($find_by!=NULL){
            $data = $data->where('products.product_name','LIKE',"%$find_by%");
        }


        return $data->get();
    }

    /**
     * @param $file
     *
     * @return string
     */
    public function save_product_document($file){
        $name = str_random(10).time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/products_documents');
        $file->move($destinationPath, $name);
        $full_name = asset('public/products_documents/'.$name);
        return $full_name;
    }

    public function get_products_by_id($products_id){
        $data = self::where('id','=',$products_id)->first();
        $data->documents = $this->products_documents_model->get_documents_by_products_id($products_id);
        $data->photos = $this->products_photo_model->get_photos_by_products_id($products_id);

        return $data;
    }

    /**
     * @param $array
     *
     * @return mixed
     */
    public function create_product($array){
        $array['created_at'] = time();
        $array['updated_at'] = time();
        return self::insertGetId($array);
    }

    /**
     * @param $data
     */
    public function add_photo_link_to_db($data){
        return ProductsPhoto::create($data);
    }

    /**
     * @param $data
     */
    public function add_doc_link_to_db($data){
        return ProductsDocument::create($data);
    }

    /**
     * @param $products_id
     * @param $array
     *
     * @return mixed
     */
    public function update_products($products_id, $array){
        return self::where('id','=',$products_id)
            ->update($array);
    }

    public function get_products_for_user(){
        $products = self::where([
                ['active', '=', '1'],
                ['is_deleted', '=', 0]
            ])
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($products as $product) {
            $product->msds = 0;
            $product->tds = 0;
            $files = ProductsDocument::where('products_id','=',$product->id)->get();
            foreach ($files as $file) {
                if(strpos($file->filename,'.msds')){
                    $product->msds = $file->filename;
                }

                if(strpos($file->filename,'.tds')){
                    $product->tds = $file->filename;
                }
            }
        }

        return $products;
    }

}