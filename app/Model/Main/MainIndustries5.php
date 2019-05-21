<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class MainIndustries5 extends Model
{
    protected $table = 'main_industries5';
    protected $dateFormat = 'U';
    protected $fillable = ['id','src','src1','title','descr','position','link'];
}
