<?php

namespace App\Model\Prize;

use Illuminate\Database\Eloquent\Model;

class PrizeBuy extends Model
{
    protected $table = 'prize_buy';
    protected $dateFormat = 'U';
    protected $fillable = ['id','users_id','prize_id'];
}
