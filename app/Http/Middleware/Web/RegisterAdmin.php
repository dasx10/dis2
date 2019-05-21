<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Sessions;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\CheckRoleTypeAccess;
use App\Http\Middleware\Web\DefaultValidation;
    class RegisterAdmin
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
                $insert_data = $this->check_empty_data($data);
                $this->check_email($data['email']);
                $this->check_exists_admin($data['email']);
                $this->check_password($data['password'],$data['password_confirm']);
                if(strlen($data['password'])<6){
                    throw new Exception('The minimum password length is 6 characters!');
                }

                $this->check_role($data['role']);

                $insert_data['password'] = md5($insert_data['password']);
                $request->insert_data = $insert_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_role($role){
            $array_required = ['super_admin','admin','sales','purchase','customer_service','finance','opm','purchase_assistant'];
            if(!in_array($role,$array_required)){
                throw new Exception("Invalid parameter. Incorrect role", 404);
            }

            return true;
        }

        private function check_password($pass1,$pass2){
            if($pass1!=$pass2){
                throw new Exception("Passwords do not match", 404);
            }

            return true;
        }

        private function check_exists_admin($email){
            $admins_exists = DB::table('admins')->where('email','=',$email)->exists();
            $users_exists = DB::table('users_data')->where('email','=',$email)->exists();
            if($admins_exists || $users_exists){
                throw new Exception("Invalid parameter. Email is already exists", 404);
            }

            return true;
        }

        private function check_email($email){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid parameter. Incorrect email", 404);
            }

            return true;
        }

        private function check_empty_data($data){
            $insert_data = [];
            $array_required = ['token'=>'token','name'=>'name','email'=>'email','role'=>'role','regione'=>'regione','password'=>'password','password_confirm'=>"confirm password"];
            foreach ($array_required as $item=>$full_name) {
                if(empty($data[$item])){
                    throw new Exception('Invalid parameter. Empty '.$full_name, 404);
                }
                $insert_data[$item] = $data[$item];
            }

            return $insert_data;
        }

    }