<?php

namespace App\Model\Clients;

use App\Model\Brands\Brands;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientsAccessBrands extends Model{
    protected $table = 'users_access_brands';
    protected $dateFormat = 'U';
    protected $fillable = ['id','users_id','brands_id'];


    /**
     * @param $users_id
     *
     * @return mixed
     */
    public function get_access_brands($users_id){
        return Brands::select('brands.id','brands.title')
            ->selectRaw("IFNULL((
                SELECT  1
                FROM  `users_access_brands` uab
                WHERE uab.users_id = $users_id
                 AND uab.brands_id = brands.id
                 limit 1
                ),'0') AS is_check")
            ->get();
    }

    /**
     * @param $access_brand_id
     *
     * @return mixed
     */
    public function delete_access_brand($access_brand_id,$users_id){
        return self::where([
            ['brands_id','=',$access_brand_id],
            ['users_id','=',$users_id]
        ])->delete();
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
}
