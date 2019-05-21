<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;


    class Login
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
                $this->check_empty_data($data);
                $acc_data = $this->check_exists_acc($request['email']);
                $this->check_password($data['email'],$data['password'],$acc_data['table']);
                $request->type_acc = $acc_data['type'];
                $request->acc_id = $acc_data['acc_id'];
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_password($email,$pass,$table){
            $data = DB::table($table)->where('email','=',$email)->first();
            if($data->password != md5($pass)){
                throw new Exception("Invalid parameter. Incorrect password", 404);
            }
        }

        private function check_exists_acc($email){
            $admins_id = DB::table('admins')->where('email','=',$email)->value('id');
            $users_id = DB::table('users_data')->where('email','=',$email)->value('users_id');
            if(!$admins_id && !$users_id){
                throw new Exception("Email was not found", 404);
            }
            if($admins_id){
                return ['table'=>'admins','type'=>'admin','acc_id'=>$admins_id];
            }

            return ['table'=>'users_data','type'=>'user','acc_id'=>$users_id];
        }

        private function check_empty_data($data){
            $array_required = ['email','password'];
            foreach ($array_required as $item) {
                if(empty($data[$item])){
                    throw new Exception('Invalid parameter. Empty '.$item, 404);
                }
            }
        }

    }