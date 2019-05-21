<?php

namespace App\Model\Logs;

use App\Model\Admins\Admins;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model{
    protected $table = 'logs';
    protected $dateFormat = 'U';
    protected $fillable = ['id','admins_id','text','type'];

    public function get_ga_email(){
        return Admins::where('role','=','super_admin')->value('email');
    }

    public function get_admins(){
        $data = Admins::where('role','!=','super_admin')->select('name','role','id')->get();
        foreach ($data as $item) {
            if($item->role=='opm'){
                $role = 'Operation manager';
            }else{
                $expl = explode('_',$item->role);
                $role = ucfirst($expl[0]);
                if(!empty($expl[1])){
                    $role.=' '.$expl[1];
                }
            }
            $item->role = $role;
        }
        return $data;
    }

    public function upload_file($array){
        $file_name = time().'_'.str_random(4).'.csv';
        $filename = public_path('/csv/'.$file_name);
        $handle = fopen($filename, 'a');
        foreach ($array as $fields) {
            fputcsv($handle,$fields);
        }
        fclose($handle);
        return 'http://disdebug.yobibyte.in.ua/public/csv/'.$file_name;
    }
}
