<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class MainIndustries2 extends Model
{
    protected $table = 'main_industries2';
    protected $dateFormat = 'U';
    protected $fillable = ['id','src','title','position','link'];
}
