<?php

namespace App\Model\Dolchem;

use App\Model\Products\Products;
use Illuminate\Database\Eloquent\Model;

class DolchemProducts extends Model{
    protected $table = 'doclhem_products';
    protected $dateFormat = 'U';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','dolchem_products_categories_id','products_id'];


    /**
     * @param $products_id
     *
     * @return mixed
     */
    public function delete_prod_from_cat($products_id){
        return self::where('products_id','=',$products_id)
            ->delete();
    }


    /**
     * @param $products_id
     * @param $dolchem_products_categories_id
     *
     * @return mixed
     */
    public function add_prod_to_cat($products_id, $dolchem_products_categories_id){
        return self::insertGetId([
            'created_at' => time(),
            'updated_at' => time(),
            'dolchem_products_categories_id' => $dolchem_products_categories_id,
            'products_id' => $products_id
        ]);
    }


    public function get_products(){
        $data = Products::select('products.id as products_id','products.product_name',
            'dpc.title as dolchem_products_categories_title','dpc.id as dolchem_products_categories_id',
            'products.product_code')
            ->where('products.brand','=','Dolchem')
            ->leftJoin('doclhem_products as dp','products.id','=','dp.products_id')
            ->leftJoin('dolchem_products_categories as dpc','dp.dolchem_products_categories_id','=','dpc.id')
            ->selectRaw("coalesce(dolchem_products_categories_id, '') as dolchem_products_categories_id")
            ->get();

        return $data;
    }
}
