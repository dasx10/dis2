<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Clients\ClientsData;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;


    class SignUpMainPage
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
                $data['ref_id'] = $this->generate_ref_id();
                $this->check_empty_data($data);
                $this->check_email($data['email']);
                $this->check_exists_user_or_admin($data['email']);
                DefaultValidation::check_token($data['token']);
                $created_by = $this->get_created_by_id($data['token']);

                if(strlen($data['password'])<8){
                    throw new Exception("The password must be at least 8 characters in length!", 404);
                }
                $request->created_by = $created_by;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function generate_ref_id(){
            $ref_id = str_random(10);
            if(ClientsData::where('ref_id','=',$ref_id)->exists()){
                self::generate_ref_id();
            }

            return $ref_id;
        }

        private function get_created_by_id($token){
            $data = DB::table('sessions')->where('token','=',$token)->first();
            return $data->admins_id;
        }

        private function check_exists_user_or_admin($email){
            $users_exists = DB::table('users_data')->where('email','=',$email)->exists();
            $admins_exists = DB::table('admins')->where('email','=',$email)->exists();
            if($users_exists || $admins_exists){
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
            $array_required = ['password'=>'password','contact_name'=>'contact name','email'=>'email','company_name'=>'company name','phone_number'=>'phone number','regione'=>'regione','country'=>'country'];
            foreach ($array_required as $item=>$full_name) {
                if(empty($data[$item])){
                    throw new Exception('Invalid parameter. Empty '.$full_name, 404);
                }
            }

            return true;
        }

    }