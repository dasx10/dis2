<?php

namespace App\Model\Fileaclaim;

use App\Model\Photos\Photos;
use Illuminate\Database\Eloquent\Model;

class FileaclaimFiles extends Model
{
    protected $table  = 'file_a_claim_files';
    protected $dateFormat = 'U';
    protected $fillable = ['file_a_claim_id','filename','type'];

    /**
     * @param $file
     *
     * @return string
     */
    public static function upload_file($file){
        $name = str_random(6).'_'.$file->getClientOriginalName();
        $destinationPath = public_path('/file_a_claim');
        $file->move($destinationPath, $name);
        return asset('public/file_a_claim/'.$name);
    }


    /**
     * @param $claims_id
     *
     * @return mixed
     */
    public function get_files_by_claims_id($claims_id){
        return self::where('file_a_claim_id','=',$claims_id)
            ->get();
    }

    /**
     * @param $claims_id
     * @param $file
     * @param $type
     */
    public function create_new($claims_id, $file, $type){
        $src = Photos::upload_photo($file,'/file_a_claim/');
        return self::insertGetId([
            'file_a_claim_id' => $claims_id,
            'filename' => $src,
            'type' => $type
        ]);
    }
}
