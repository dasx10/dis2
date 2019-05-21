<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Admins\Admins;
    use App\Model\Clients\ClientsData;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class ClientsEditBase
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
                $this->find_client($data['client_id']);
                if(!empty($data['password']) && strlen($data['password'])<8){
                    throw new Exception('The password must be at least 8 characters in length');
                }

                if(!empty($data['email'])){
                    $this->check_email($data['email'],$data['client_id']);
                }

                $request->update_data = $update_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_email($email,$id){
            if(Admins::where('email','=',$email)->exists() || ClientsData::where('email','=',$email)->where('users_id','!=',$id)->exists()){
                throw new Exception("Email is already exists", 404);
            }

            return true;
        }

        private function find_client($id){
            if(!DB::table('users_data')->where('users_id','=',$id)->exists()){
                throw new Exception("User was not found", 404);
            }

            return true;
        }

        private function check_empty_data($data){
            $update_data = [];
            if(empty($data['client_id'])){
                throw new Exception('Invalid parameter. Empty client id', 404);
            }

            $options_fields = ['country','regione','contact_name','contact_name2',
                'nif','iban','phone_number','email2','office_phone','skype',
                'potential_products','preferred_destination_port','preferred_packaging_style',
                'language','billing_address','banks_details','office_phone','terms','dop_bank1','dop_bank2','email',
                'limitations','notes','payment_type_default','payment_type_other'];
            foreach ($options_fields as $field) {
                if(isset($data[$field])){
                    $update_data[$field] = strip_tags($data[$field]);
                }
            }

            if(!empty($data['password'])){
                $update_data['password'] = md5($data['password']);
            }
            return $update_data;
        }

    }