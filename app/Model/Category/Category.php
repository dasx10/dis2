<?php

namespace App\Model\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $table = 'category';
    protected $dateFormat = 'U';
    protected $fillable = ['id','title'];


    /**
     * @return mixed
     */
    public function get_categories(){
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
    public function delete_category($id){
        return self::where('id','=',$id)
            ->delete();
    }
}
