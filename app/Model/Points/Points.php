<?php

namespace App\Model\Points;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    protected $table = 'points';
    protected $dateFormat = 'U';
    protected $fillable = ['id','users_id','count','orders_id','orders_name','end_date'];
}
