<?php

namespace App\Model\SimpleSignUp;

use Illuminate\Database\Eloquent\Model;

class SimpleSignUp extends Model
{
    protected $table = 'simple_sign_up';
    protected $dateFormat = 'U';
    protected $fillable = ['id','users_id','token'];
}
