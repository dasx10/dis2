<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
use App\Http\Middleware\Web\CheckRoleTypeAccess;
use App\Http\Middleware\Web\DefaultValidation;
    class EditAdmin
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
                $update_data = $this->check_empty_data($data);
//                CheckRoleTypeAccess::check_edit_access($data['admins_id'],$data['token'],$data['role']);
                $this->check_email($data['email']);
                $this->check_exists_admin($data['email'],$data['admins_id']);
                $this->check_password($data);
//                DefaultValidation::check_token($data['token']);
                $this->check_role($data['role']);
                if(!empty($data['password'])) $update_data['password'] = md5($data['password']);

                $request->update_data = $update_data;
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

        private function check_password($data){
            if(!empty($data['password']) && !empty($data['password_confirm'])) {
                if ($data['password'] != $data['password_confirm']) {
                    throw new Exception("Passwords do not match!", 404);
                }elseif(strlen($data['password'])<6){
                    throw new Exception('The minimum password length is 6 characters!');
                }
            }

            return true;
        }

        private function check_exists_admin($email,$admins_id){
            $admins_exists = DB::table('admins')->where('email','=',$email)
                ->where('id','!=',$admins_id)->exists();
            $users_exists = DB::table('users_data')->where('email','=',$email)->exists();

            if($admins_exists || $users_exists){
                throw new Exception("Email is already exists!", 404);
            }

            return true;
        }

        private function check_email($email){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Incorrect email!", 404);
            }

            return true;
        }

        private function check_empty_data($data){
            $update_data = [];
            $array_required = ['admins_id'=>'Admins id','name'=>'Name','email'=>'Email','role'=>'Role name','regione'=>'Regione'];
            foreach ($array_required as $item=>$full_name) {
                if(empty($data[$item])){
                    throw new Exception('Invalid parameter. Empty '.$full_name, 404);
                }
                $update_data[$item] = $data[$item];
            }

            unset($update_data['admins_id']);
            return $update_data;
        }

    }