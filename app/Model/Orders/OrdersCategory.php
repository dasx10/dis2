<?php

namespace App\Model\Orders;

use Illuminate\Database\Eloquent\Model;

class OrdersCategory extends Model
{
    protected $table = 'orders_category';
    protected $dateFormat = 'U';
    protected $fillable = ['id','orders_id','title','link'];

    /**
     * @param $category_id
     *
     * @return mixed
     */
    public function delete_category($category_id){
        return self::where('id','=',$category_id)
            ->delete();
    }
}
