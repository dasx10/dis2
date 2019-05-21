<?php

    namespace App\Model\InviteLinks;
    use Illuminate\Database\Eloquent\Model;

    class InviteLinks extends Model{
        protected $table = 'invite_links';
        protected $fillable = ['token','users_id'];
        protected $dateFormat = 'U';

        /**
         * @param $data
         */
        public static function create_invite($data){
            self::create($data);
        }

        /**
         * @param $token
         */
        public static function delete_link($token){
            self::where('token','=',$token)->delete();
        }

        /**
         * @param $selected_data
         * @param $type
         * @param $value
         *
         * @return mixed
         */
        public static function get_data($selected_data, $type, $value){
            return self::select($selected_data)->where($type,'=',$value)->first();
        }

        /**
         * @return string
         */
        public static function generate_token(){
            return md5(time().str_random(10));
        }


        /**
         * @param $token
         *
         * @return bool
         */
        public static function check_exists($token){
            $data = self::where('token','=',$token)->exists();
            if(!$data){
                return false;
            }else{
                return true;
            }
        }
    }