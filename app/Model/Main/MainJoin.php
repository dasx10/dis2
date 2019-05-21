<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class MainJoin extends Model
{
    protected $table = 'main_join';
    protected $dateFormat = 'U';
    protected $fillable = ['id','src','src_hover','title','descr','position'];
}
