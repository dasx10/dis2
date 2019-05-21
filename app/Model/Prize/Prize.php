<?php

namespace App\Model\Prize;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $table = 'prize';
    protected $dateFormat = 'U';
    protected $fillable = ['id','title','descr','src','points','end_date','rate'];


    public function get_prizes($find_by=NULL){
        $data = self::orderBy('points','ASC');

        if($find_by!=NULL){
            $data = $data->where('title','LIKE',"%$find_by%");
        }

        return $data->get();
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
     * @param $prize_id
     * @param $array
     *
     * @return mixed
     */
    public function update_prize($prize_id, $array){
        return self::where('id','=',$prize_id)
            ->update($array);
    }
}
