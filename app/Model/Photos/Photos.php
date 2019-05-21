<?php

namespace App\Model\Photos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Photos extends Model{

    /**
     * @param $file
     * @param string $path
     *
     * @return string
     */
    public static function upload_photo($file, $path='/users_photo/'){
        //Get Name
        $pref = time().'_';
        $filename = str_replace(' ','',$file->getClientOriginalName());
        $photo_url = $pref.$filename;

        //Upload full image
        $destinationPath = public_path($path);
        $file->move($destinationPath, $photo_url);


        return asset('public'.$path.$photo_url);
    }


    /**
     * @param $link
     */
    public static function delete_photo($link){
        if(!empty($link)) {
            $link = public_path(str_replace(Config::get('app.url') . '/public', '', $link));
            if (file_exists($link)) {
                unlink($link);
            }
        }
    }
}
