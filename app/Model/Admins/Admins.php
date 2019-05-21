<?php

    namespace App\Model\Admins;
    use App\Model\Admins\Documents\AdminDocuments;
    use Illuminate\Database\Eloquent\Model;
    use App\Model\Clients\ClientsData;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;

    class Admins extends Model{
        public $admin_documents_model;

        protected $table = 'admins';
        protected $hidden = ['password'];
        protected $dateFormat = 'U';
        protected $fillable = ['id','users_id','name','email','password','role','regione'];


        public function __construct(){
            $this->admin_documents_model = new AdminDocuments();
        }

        public static function check_name_role_for_logs($admins_id){
            $admin_name_role = Admins::where('id','=',$admins_id)->select('name','role')->first();
            if($admin_name_role->role=='opm'){
                $role = 'Operation manager';
            }else{
                $expl = explode('_',$admin_name_role->role);
                $role = ucfirst($expl[0]);
                if(!empty($expl[1])){
                    $role.=' '.$expl[1];
                }
            }
            return ['role'=>$role,'name'=>$admin_name_role->name];
        }
        /**
         * @param $select_data
         * @param $type
         * @param $value
         *
         * @return mixed
         */
        public static function get_admin_data($select_data, $type, $value){
            return self::select($select_data)->where($type,'=',$value)->first();
        }


        /**
         * @param $admins_id
         *
         * @return mixed
         */
        public function get_admin_by_id($admins_id){
            return self::where('id','=',$admins_id)->first();
        }



        /**
         * @param $type
         * @param $value
         *
         * @return bool
         */
        public function check_exists($type, $value){
            $data =self::where($type,'=',$value)->exists();
            if(!$data){
                return false;
            }

            return true;
        }

        /**
         * @param $type
         * @param $value
         */
        public function delete_admin($type, $value){
            self::where($type,'=',$value)->delete();
        }

        /**
         * @param $data
         * @param $type
         * @param $value
         */
        public function edit_data($data, $type, $value){
            self::where($type,'=',$value)->update($data);
        }

        /**
         * @param $data
         *
         * @return mixed
         */
        public function create_new_admin($data){
            return self::create($data);
        }



        /**
         * @return mixed
         */
        public function get_admin_list(){
            $data =  self::orderBy('name','ASC')->get();
            $role_type = ['super_admin'=>'Super Admin','admin'=>'Admin','sales'=>'Sales','purchase_assistant'=>'Purchase Assistant','purchase'=>'Purchase','customer_service'=>'Customer Service','finance'=>'Finance','opm'=>'OPM'];
            foreach ($data as $admin) {
                if(array_key_exists($admin['role'],$role_type)){
                    $admin['type'] = $role_type[$admin['role']];
                }
            }
            return $data;
        }

    }