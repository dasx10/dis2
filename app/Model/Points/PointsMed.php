<?php

namespace App\Model\Points;

use Illuminate\Database\Eloquent\Model;

class PointsMed extends Model
{
    protected $table = 'points_med';
    protected $dateFormat = 'U';
    protected $fillable = ['id','users_id','count','orders_id'];
}
