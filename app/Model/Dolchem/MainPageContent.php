<?php

namespace App\Model\Dolchem;

use App\Model\Photos\Photos;
use Illuminate\Database\Eloquent\Model;

class MainPageContent extends Model{

    protected $table = 'dolchem_main_page_content';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','photo_url','title','title1','position'];


    /**
     * @return mixed
     */
    public function get_content(){
        return self::orderBy('position','ASC')
            ->get();
    }

    /**
     * @param $slide_id
     *
     * @return mixed
     */
    public function get_photo_url_by_slide_id($slide_id){
        return self::where('id','=',$slide_id)->value('photo_url');
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
     * @param $slide_id
     * @param $array
     *
     * @return mixed
     */
    public function update_slide($slide_id, $array){
        return self::where('id','=',$slide_id)
            ->update($array);
    }


    /**
     * @param $slide_id
     *
     * @return mixed
     */
    public function delete_slide($slide_id){
        $slide_data = self::where('id','=',$slide_id)->first();
        Photos::delete_photo($slide_data->photo_url);
        return $slide_data->delete();
    }
}
