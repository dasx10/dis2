<?php

namespace App\Model\Orders;

use Illuminate\Database\Eloquent\Model;

class OrdersProducts extends Model
{
    protected $table = 'orders_products';
    protected $dateFormat = 'U';
    protected $fillable = ['id','orders_id','quantity','products_id','products_name',
        'products_specification','products_packaging_type','products_pallet_wpallet',
        'products_unit_price','quantity','quantity_val'];

    public function create_new($array){
        $array['created_at'] = time();
        $array['updated_at'] = time();
        return self::insertGetId($array);
    }
}
