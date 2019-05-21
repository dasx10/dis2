<?php

namespace App\Model\Admins\Documents;

use Illuminate\Database\Eloquent\Model;

class AdminDocumentsCategory extends Model
{
    protected $table = 'category_documents';
    protected $dateFormat = 'U';
    protected $fillable = ['id','name'];


    /**
     * @param $name
     *
     * @return bool
     */
    public function check_exists($name){
        if(self::where('name','=',$name)->exists()){
            return false;
        }

        return true;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function create_new($name){
        return self::insertGetId([
            'name' => $name,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * @return mixed
     */
    public function get_categories(){
        return self::orderBy('name','ASC')->select('name')->get();
    }
}
