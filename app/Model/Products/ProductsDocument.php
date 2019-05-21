<?php

namespace App\Model\Products;
use App\Model\Photos\Photos;
use Illuminate\Database\Eloquent\Model;

class ProductsDocument extends Model{
    protected $table = 'products_document';
    protected $dateFormat = 'U';
    protected $fillable = ['id','products_id','filename'];


    /**
     * @param $products_id
     *
     * @return mixed
     */
    public function get_documents_by_products_id($products_id){
        return self::where('products_id','=',$products_id)
            ->orderBy('created_at','DESC')
            ->get();
    }

    /**
     * @param $products_id
     *
     * @return bool
     */
    public function delete_files($products_id){
        $photos = self::get_documents_by_products_id($products_id);
        foreach ($photos as $photo) {
            Photos::delete_photo($photo->filename);
            self::where('id','=',$photo->id)->delete();
        }
        return true;
    }

    /**
     * @param $filename
     * @param $products_id
     *
     * @return mixed
     */
    public function create_new($filename, $products_id){
        return self::insertGetId([
            'products_id' => $products_id,
            'filename' => $filename,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * @param $documents_id
     *
     * @return bool
     */
    public function delete_documents_by_id($documents_id){
        $photos = self::where('id','=',$documents_id)->first();

        Photos::delete_photo($photos->filename);

        $photos->delete();

        return true;
    }
}