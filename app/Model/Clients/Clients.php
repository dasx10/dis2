<?php

namespace App\Model\Clients;
use App\Model\Basket\Basket;
use App\Model\Fileaclaim\Fileaclaim;
use App\Model\Points\Points;
use Illuminate\Database\Eloquent\Model;
use App\Model\Clients\ClientsData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Clients extends Model{
    public $users_data_model,$clients_notes_model,$clients_access_brands_model;

    protected $table = 'users';
    protected $dateFormat = 'U';
    protected $fillable = ['id','created_by','type_acc','created_at','updated_at'];

    /**
     * Clients constructor.
     */
    public function __construct() {
        $this->users_data_model = new ClientsData();
        $this->clients_notes_model = new ClientsNotes();
        $this->clients_access_brands_model = new ClientsAccessBrands();
    }

    public static function get_type_for_region($text){
        $text = strip_tags($text);
        $text = trim($text);
        $text=explode(PHP_EOL,$text);
        $text = implode(' ',$text);
        $text = preg_replace ("/^[^a-zA-ZА-Яа-я\s]*$/","",$text);
        $text = mb_strtolower($text);
        $text = str_replace('&amp;','',$text);
        $text = str_replace('&nbsp;',' ',$text);
        $text = str_replace('\n','',$text);
        $text = preg_replace("/  +/"," ",$text);
        $text = str_replace(' ','_',$text);
        $text = str_replace('\n','',$text);
        return $text;
    }

    /**
     * @param $type
     * @param $value
     */
    public function delete_user($type, $value){
        return self::where($type,'=',$value)
            ->delete();
    }

    /**
     * @param null $count
     *
     * @return float
     */
    public static function get_points($count= NULL){
        return round($count/200,0);
    }

    /**
     * @param $time
     * @param int $type
     *
     * @return false|string
     */
    public static function get_how_long($time, $type=0){
        $curr_time = date('Y-m-d H:i:s',time());
        $diff_time =strtotime($curr_time)-strtotime($time);

        $minute = floor(0.0166667*$diff_time);
        $hours = floor($minute/60);
        if($type==0) {
            if ($diff_time < 3600) {
                return 'at ' . date('h:i A', strtotime($time . ' +3 hour'));
            } elseif ($diff_time > 3600 && $diff_time < 86400) {
                return $hours . ' hours ago, at ' . date('h:i A', strtotime($time . ' +3 hour'));
            } else {
                $day = date('j M', strtotime($time));
                $times = date('h:i A', strtotime($time . ' +3 hour'));
                return $day . ', at ' . $times;
            }
        }

        return date('h:i A', strtotime($time . ' +3 hour'));
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function search_filter($data){
        foreach ($data as $project){
            $project->value=$project->users_id;
            $project->label=$project->company_name;
            unset($project->users_id);
            unset($project->company_name);
        }
        return $data;
    }


    /**
     * @param $created_by
     */
    public function create_users($created_by=NULL){
        return self::insertGetId([
            'created_by' => $created_by,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }


    /**
     * @param $type
     * @param $value
     *
     * @return bool
     */
    public function check_exists($type, $value){
        if(!$data = $this->users_data_model->where($type,'=',$value)->first()){
            return false;
        }

        return $data;
    }

    /**
     * @param $data
     * @param $type
     * @param $value
     */
    public function update_data($data, $type, $value){
        return ClientsData::where($type,'=',$value)->update($data);
    }

    /**
     * @param $select_data
     * @param $type
     * @param $value
     *
     * @return mixed
     */
    public function get_user_data($select_data, $type, $value){
        return ClientsData::select($select_data)->where($type,'=',$value)->first();
    }

    /**
     * @param $users_id
     *
     * @return mixed
     */
    public function get_sum_points($users_id){
        return Points::where('users_id','=',$users_id)
            ->sum('count');
    }

    /**
     * @param $users_id
     *
     * @return mixed
     */
    public function get_basket($users_id){
        return Basket::where('basket.users_id','=',$users_id)
            ->select('p.*','basket.id as cart_id','basket.quantity')
            ->leftJoin('products as p','basket.products_id','=','p.id')
            ->get();
    }

    /**
     * @param $users_id
     *
     * @return mixed
     */
    public function get_claims($users_id){
        $claims = Fileaclaim::where('file_a_claim.users_id','=',$users_id)
            ->select('file_a_claim.*')
            ->orderBy('file_a_claim.created_at','DESC')
            ->selectRaw("IFNULL((
                SELECT  filename
                FROM  `file_a_claim_files` ff
                WHERE ff.file_a_claim_id = file_a_claim.id
                 AND ff.type = 'images'
                 limit 1
                ),'') AS images")
            ->selectRaw("IFNULL((
                SELECT  filename
                FROM  `file_a_claim_files` ff
                WHERE ff.file_a_claim_id = file_a_claim.id
                 AND ff.type = 'imagesvideos'
                 limit 1
                ),'') AS imagesvideos")
            ->get();
        return $claims;
    }
}