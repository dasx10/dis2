<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class MainIndustries extends Model
{
    protected $table = 'main_industries';
    protected $dateFormat = 'U';
    protected $fillable = ['id','src','src1','title','descr','position','link'];
}