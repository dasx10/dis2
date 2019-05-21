<?php

namespace App\Model\Admins\Documents;
use Illuminate\Database\Eloquent\Model;
use App\Model\Clients\ClientsData;
use Illuminate\Support\Facades\Session;
use App\Model\Admins\Documents\AdminDocumentsFile;
use Illuminate\Support\Facades\Storage;

class AdminDocuments extends Model{
    public $admins_documents_category_model;

    protected $table = 'admins_documents';
    protected $dateFormat = 'U';
    protected $fillable = ['id','title','category','admins_id'];

    public function __construct() {
        $this->admins_documents_category_model = new AdminDocumentsCategory();
    }

    /**
     * @param $file
     *
     * @return string
     */
    public function upload_file($file){
        $name = time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/admin_documents');
        $file->move($destinationPath, $name);
        return asset('public/admin_documents/'.$name);
    }


    /**
     * @param $file
     *
     * @return string
     */
    public static function upload_static_file($file){
        $name = time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/photo');
        $file->move($destinationPath, $name);
        return asset('public/photo/'.$name);
    }

    /**
     * @param $type
     * @param $value
     */
    public function delete_documents($type, $value){
        $data = AdminDocumentsFile::select('url')->where('admins_documents_id','=',$value)->get();
        foreach ($data as $item) {
            Storage::delete($item->url);
        }
        self::where($type,'=',$value)->delete();

    }

    /**
     * @param $url
     * @param $array
     *
     * @return mixed
     */
    public function create_documents($url, $array){
       $id =  self::insertGetId($array);
       $this->create_documents_version(['admins_documents_id'=>$id,'edit_admins_id'=>$array['admins_id'],'url'=>$url]);
       return $id;
    }

    /**
     * @param $array
     */
    public function create_documents_version($array){
        AdminDocumentsFile::create($array);
    }

    /**
     * @return array
     */
    public function get_documents_list(){
        $documents=[];
        $id_data = self::select('id')->get();
        foreach ($id_data as $item) {
            $documents[] =  AdminDocumentsFile::where('admins_documents_id','=',$item->id)->orderBy('admins_documents_file.updated_at','DESC')->join('admins', 'admins.id', '=', 'admins_documents_file.edit_admins_id')->join('admins_documents', 'admins_documents.id', '=', 'admins_documents_file.admins_documents_id')->first();
        }
        return $documents;
    }

}