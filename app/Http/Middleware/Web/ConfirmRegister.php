<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Sessions;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\CheckRoleTypeAccess;
    use App\Http\Middleware\Web\DefaultValidation;
    class ConfirmRegister
    {
        /**
         * @param $request
         * @param Closure $next
         *
         * @return \Illuminate\Http\JsonResponse|mixed
         */
        public function handle($request, Closure $next)
        {
            try{
                $data = $request->post();
//                CheckRoleTypeAccess::check_add_delete_admin();
                $this->check_empty_data($data);
                $this->check_exists_token($data['token']);
                $this->check_users_exists($data['token']);
                $this->check_password($data['password'],$data['confirm_password']);
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        /**
         * @param $pass1
         * @param $pass2
         *
         * @throws Exception
         */
        private function check_password($pass1, $pass2){
            if($pass1!=$pass2){
                throw new Exception('Password do not match!',404);
            }
        }

        /**
         * @param $token
         *
         * @return mixed
         */
        private function get_users_id_by_token($token){
            $data = DB::table('invite_links')->where('token','=',$token)->first();
            return $data->users_id;
        }

        /**
         * @param $token
         *
         * @throws Exception
         */
        private function check_users_exists($token){
            $id = self::get_users_id_by_token($token);
            $data = DB::table('users')->where('id','=',$id)->exists();
            if(!$data){
                throw new Exception("Users does not exists", 404);
            }
        }

        /**
         * @param $token
         *
         * @throws Exception
         */
        private function check_exists_token($token){
            $data = DB::table('invite_links')->where('token','=',$token)->exists();
            if(!$data){
                throw new Exception("Token does not exists", 404);
            }
        }

        /**
         * @param $data
         *
         * @throws Exception
         */
        private function check_empty_data($data){
            $array_required = ['token'=>'Token','password'=>'Password','confirm_password'=>'Confirm password'];
            foreach ($array_required as $item=>$full_name) {
                if(!array_key_exists($item,$data)){
                    throw new Exception($full_name." is empty!", 404);
                }
            }
        }

    }