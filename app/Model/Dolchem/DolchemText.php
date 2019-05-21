<?php

namespace App\Model\Dolchem;

use Illuminate\Database\Eloquent\Model;

class DolchemText extends Model{
    protected $table = 'dolchem_text';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','text','text1','text2','type'];

    public function check_exists($type){
        if($id = self::where('type','=',$type)->value('id')){
            return $id;
        }

        return false;
    }

    /**
     * @param $array
     *
     * @return mixed
     */
    public function create_new($array){
        $array['created_at'] = time();
        $array['updated_at'] = time();
        return self::insertGetId($array);
    }

    /**
     * @param $text_id
     * @param $array
     *
     * @return mixed
     */
    public function update_text($text_id, $array){
        return self::where('id','=',$text_id)
            ->update($array);
    }

    /**
     * @param $type
     *
     * @return object
     */
    public function get_text_by_type($type){
        $data = self::where('type','=',$type)->first();
        if(empty($data)){
            $data = (object)[
                'type' => $type,
                'text' => '',
                'text1' => '',
                'text2' => '',
            ];
        }

        return $data;
    }

}
