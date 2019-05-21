<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class MainTailor extends Model
{
    protected $table = 'main_tailor';
    protected $dateFormat = 'U';
    protected $fillable = ['id','src','src_hover','title','descr','position'];
}
