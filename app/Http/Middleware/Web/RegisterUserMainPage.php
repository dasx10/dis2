<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Admins\Admins;
    use App\Model\Clients\ClientsData;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;


    class RegisterUserMainPage
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
                $insert_data = $this->check_empty_data($data);
                $this->check_email($data['email']);
                $this->check_exists_user_or_admin($data['email']);
                $insert_data['ref_id'] = $this->generate_ref_id();
                $insert_data['can_see'] = 0;
                $insert_data['registered_by'] = (!empty($data['referal_id']))? $data['referal_id']:NULL;

                $request->insert_data = $insert_data;

                $mail_data = [];
                $array_options = ['contact_name'=>'Contact name','position'=>'Position','country'=>'Country','phone_number'=>'Phone number','company_website'=>'Company website','company_name'=>'Company name','bisiness_scope'=>'Type of business','email'=>'Email'];
                foreach ($array_options as $key=>$options_field) {
                    if(!empty($data[$key])) {
                        $mail_data[$options_field] = $data[$key];
                    }
                }
                $request->mail_data = $mail_data;

                $request->admin_email =  Admins::where('role','=','super_admin')->value('email');
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

        private function check_exists_user_or_admin($email){
            $users_exists = DB::table('users_data')->where('email','=',$email)->exists();
            $admins_exists = DB::table('admins')->where('email','=',$email)->exists();
            if($users_exists || $admins_exists){
                throw new Exception("Email is already exists", 404);
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
            $array_required = ['bisiness_scope'=>'bisiness scope','contact_name'=>'contact name',
                'email'=>'email','company_name'=>'company name','phone_number'=>'phone number',
                'country'=>'country'];
            foreach ($array_required as $item=>$full_name) {
                if(empty($data[$item])){
                    throw new Exception('Invalid parameter. Empty '.$full_name, 404);
                }
                $insert_data[$item] = $data[$item];
            }

            return $insert_data;
        }

    }