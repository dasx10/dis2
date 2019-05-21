<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class Industries extends Model{

    protected $table = 'industries';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','title','descr','descr_photo_url','photo_url','photo_url_hover',
        'position','link'];

    public static function get_link($text){
        $text = strip_tags($text);
        $text = trim($text);
        $text=explode(PHP_EOL,$text);
        $text = implode(' ',$text);
        $text = preg_replace ("/^[^a-zA-ZА-Яа-я\s]*$/","",$text);
        $text = mb_strtolower($text);
        $text = str_replace('&amp;','',$text);
        $text = str_replace('&nbsp;',' ',$text);
        $text = str_replace('\n','',$text);
        $text = preg_replace("/  +/"," ",$text);
        $text = str_replace(' ','-',$text);
        $text = str_replace('\n','',$text);
        return $text;
    }

    public static function get_name($link){
        $link = str_replace('-',' ',$link);
        $link = ucfirst($link);
        return $link;
    }
}
