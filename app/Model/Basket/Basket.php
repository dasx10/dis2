<?php

namespace App\Model\Basket;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'basket';
    protected $dateFormat = 'U';
    protected $fillable = ['users_id','products_id','quantity','pallet_type','packaging_type',
        'quantity_decr_key','amount','unit_price','packaging_type_name','quantity_val'];
}
