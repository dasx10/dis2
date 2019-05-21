<?php

namespace App\Model\Dolchem;

use Illuminate\Database\Eloquent\Model;

class DolchemMarkers extends Model{
    protected $table = 'dolchem_markers';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','title','content','type','lat','lng'];

    public function get_content(){
        return self::get();
    }
}
