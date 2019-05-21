<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model{
    protected $table = 'main_slider';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','src','title','position'];
}
