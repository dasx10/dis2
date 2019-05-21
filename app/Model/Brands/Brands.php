<?php

namespace App\Model\Brands;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model{
    protected $table = 'brands';
    protected $dateFormat = 'U';
    protected $fillable = ['id','title'];

    /**
     * @return mixed
     */
    public function get_brands(){
        return self::orderBy('title','ASC')
            ->get();
    }

    /**
     * @param $title
     *
     * @return mixed
     */
    public function create_new($title){
        return self::insertGetId([
            'title' => $title,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete_brand($id){
        return self::where('id','=',$id)
            ->delete();
    }
}
