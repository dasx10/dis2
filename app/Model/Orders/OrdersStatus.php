<?php

namespace App\Model\Orders;

use Illuminate\Database\Eloquent\Model;

class OrdersStatus extends Model
{
    protected $table = 'orders_status';
    protected $dateFormat = 'U';
    protected $fillable = ['id','orders_id','status'];

}
