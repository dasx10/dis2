<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class MainPageDescription extends Model
{
    protected $table = 'main_page_description';
    protected $dateFormat = 'U';
    protected $fillable = ['id','src','text','type'];
}
