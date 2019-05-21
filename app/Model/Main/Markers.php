<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class Markers extends Model{
    protected $table = 'markers';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','title','type','lat','lng','content'];
}
