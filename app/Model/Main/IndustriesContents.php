<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class IndustriesContents extends Model{

    protected $table = 'industries_contents';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','industries_id','src','src_hover','title','descr','link','src1','position'];
}
