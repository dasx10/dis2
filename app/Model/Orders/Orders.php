<?php

namespace App\Model\Orders;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model{
    public $orders_category_model,$orders_category_files_model,$orders_products_model;
    protected $table = 'orders';
    protected $dateFormat = 'U';
    protected $fillable = ['id','users_id','total_amount','pod','other_instructions'
        ,'dis_ref','po_num','arrival_date','payment_terms','points','fob_subtotal'
        ,'freight_charges','insurance','hst','pay_with_points','container_size','region','status'
        ,'pol','etd','eta','bl_number','shipping_company','created_at','tracking_order_number',
        'tracking_link'];

    public function __construct() {
        $this->orders_category_model = new OrdersCategory();
        $this->orders_category_files_model = new OrdersCategoryFiles();
        $this->orders_products_model = new OrdersProducts();
    }

    /**
     * @param $users_id
     *
     * @return mixed
     */
    public function get_order_by_users_id($users_id){
        return self::where('users_id','=',$users_id)
            ->get();
    }

    public function create_new($array){
        $array['created_at'] = time();
        $array['updated_at'] = time();
        return self::insertGetId($array);
    }
}
