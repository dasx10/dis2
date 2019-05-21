<?php

    namespace App\Model;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;
    use App\Model\Clients\ClientsData;
    class Sessions extends Model{

        protected $table = 'sessions';
        protected $hidden = ['token','ip','user_agent'];
        protected $dateFormat = 'U';
        protected $fillable = ['id','users_id','admins_id','token','ip','user_agent'];

        /**
         * @return bool
         */
        public static function check_exists_session_data(){
            if (Session::has('token_key')) {
                $key  = Session::get('token_key');
                $result = self::where('token','=',$key)->exists();
                if(!$result){
                    return false;
                }else{
                    return true;
                }
            }else{
                return false;
            }
        }

        /**
         * @param $users_id
         *
         * @return string
         */
        public static function get_last_visit($users_id){
            $sess_date  = self::where('users_id','=',$users_id)
                ->value('created_at');
            $reg_date  = ClientsData::where('users_id','=',$users_id)
                ->value('created_at');

            $created_at = (empty($sess_date))? $reg_date : $sess_date;

            return date('F j, Y', strtotime($created_at));
        }

        /**
         * @param $type
         *
         * @return bool
         */
        public static function check_type_session($type){
            $result = self::where('token','=',Session::get('token_key'))->select('users_id','admins_id')->first();
            if(!empty($result->$type)){
                return true;
            }

            return false;
        }

        /**
         * @param $token
         *
         * @return mixed
         */
        public static function get_users_id_by_token($token){
            return self::where('token','=',$token)->value('users_id');
        }

        /**
         * @param $token
         *
         * @return mixed
         */
        public static function get_admins_id_by_token($token){
            return self::where('token','=',$token)->value('admins_id');
        }

        /**
         * @return mixed
         */
        public static function generate_token_key(){
            return Hash::make(md5(str_random(16).time()));
        }

        /**
         * @return mixed
         */
        public static function get_token(){
            return Session::get('token_key');
        }

        public static function check_exists_token($token){
            $data = self::where('token','=',$token)->select('users_id','admins_id')
                ->first();
            if(!empty($data->users_id)){
                return ['type'=>'user','acc_id'=>$data->users_id];
            }
            if(!empty($data->admins_id)){
                return ['type'=>'admin','acc_id'=>$data->admins_id];
            }

            return false;
        }

        /**
         * @param $token
         * @param null $users_id
         * @param null $admins_id
         *
         * @return bool
         */
        public static function set_token_key($token, $users_id=NULL, $admins_id=NULL){
            if($users_id!=NULL){
                $templ = self::where([
                    ['users_id','=',$users_id],
                    ['ip','=',\Request::ip()],
                    ['user_agent','=',\Request::header('User-Agent')]
                ]);
            }else{
                $templ = self::where([
                    ['admins_id','=',$admins_id],
                    ['ip','=',\Request::ip()],
                    ['user_agent','=',\Request::header('User-Agent')]
                ]);
            }
            //Exists check
            $exists_id = $templ->value('id');
            if(!$exists_id) {
                Sessions::create([
                    'admins_id' => $admins_id,
                    'users_id' => $users_id,
                    'token' => $token,
                    'ip' => \Request::ip(),
                    'user_agent' => \Request::header('User-Agent')
                ]);
            }else{
                self::where('id','=',$exists_id)->update([
                    'token' => $token
                ]);
            }
            Session::put('token_key',$token);
            return true;
        }

        /**
         *Delete key
         */
        public static function delete_key(){
            Session::flush();
            //$key  = Session::get('token_key');
            //DB::table('sessions')->where('token','=',$key)->delete();
            return true;
        }
    }