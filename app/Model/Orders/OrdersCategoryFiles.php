<?php

namespace App\Model\Orders;

use App\Model\Photos\Photos;
use Illuminate\Database\Eloquent\Model;

class OrdersCategoryFiles extends Model
{
    protected $table = 'orders_category_files';
    protected $dateFormat = 'U';
    protected $fillable = ['id','orders_category_id','src'];

    public function delete_files($orders_category_id){
        $files = self::get_files($orders_category_id);
        foreach ($files as $file){
            Photos::delete_photo($file->src);
        }

        return true;
    }

    /**
     * @param $orders_category_id
     *
     * @return mixed
     */
    public function get_files($orders_category_id){
        return self::where('orders_category_id','=',$orders_category_id)
            ->get();
    }
}
