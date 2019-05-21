<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class BrandSlider extends Model
{
    protected $table = 'brand_slider';
    protected $dateFormat = 'U';
    protected $fillable = ['id','src','title','position','link'];
}
