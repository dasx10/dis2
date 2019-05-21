<?php

namespace App\Model\Fileaclaim;

use Illuminate\Database\Eloquent\Model;

class Fileaclaim extends Model{
    public $file_a_claim_files_model;
    protected $table  = 'file_a_claim';
    protected $dateFormat = 'U';
    protected $fillable = ['users_id','operation','text','unique_id'];

    public function __construct(){
        $this->file_a_claim_files_model = new FileaclaimFiles();
    }

    /**
     * @param $length
     *
     * @return string
     */
    public static function generate_password($length){
        $rnd = str_random($length);
        if(self::where('unique_id','=',$rnd)->exists()){
            self::generate_password($length);
        }

        return $rnd;
    }

    public function get_claims($users_id){
        $claims = self::where('users_id','=',$users_id)
            ->orderBy('created_at','DESC')
            ->get();

        foreach ($claims as $claim) {
            $str = '';
            $files = $this->file_a_claim_files_model->get_files_by_claims_id($claim->id);
            foreach ($files as $file) {
                $str.=$file->filename.',';
            }
            $str = substr($str,0,-1);
            $claim->files = $str;
        }

        return $claims;
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
