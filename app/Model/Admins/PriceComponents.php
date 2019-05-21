<?php

    namespace App\Model\Admins;
    use Illuminate\Database\Eloquent\Model;

    class PriceComponents extends Model{

        protected $table = 'price_components';
        protected $dateFormat = 'U';
        protected $fillable = ['id','type','value','title'];


    }