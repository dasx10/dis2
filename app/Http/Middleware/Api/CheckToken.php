<?php
    /**
     * Created by PhpStorm.
     * User: Bogdan
     * Date: 13.11.17
     * Time: 19:54
     */
    namespace App\Http\Middleware\Api;
    use App\Model\Admins\Admins;
    use App\Model\Clients\ClientsData;
    use App\Model\Sessions;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use Illuminate\Support\Facades\Log;

    class CheckToken
    {
        /**
         * @param $request
         * @param Closure $next
         *
         * @return \Illuminate\Http\JsonResponse|mixed
         */
        public function handle($request, Closure $next)
        {
            try {
                $data = $request->post();
                $this->check_input_data($data);
                $acc_data = $this->get_acc_data($data['token']);
                $request->acc_data = $acc_data['acc_data'];
                $request->acc_type = $acc_data['type'];
                return $next($request);
            } catch (Exception $e) {
                Log::debug(\Request::ip().' ----- '.\Request::header('User-Agent').' ----- '.json_encode($data).' ----- '.json_encode($e->getMessage()));
                return response()->json(['success' => false, "message" => $e->getMessage()], 200);
            }
        }

        private function get_acc_data($token){
            if(!$data = Sessions::check_exists_token($token)){
                throw new Exception('Invalid token');
            }

            switch ($data['type']) {
                case 'user':
                    $acc_data = ClientsData::select('users_data.*','users_data.id as id2','users_data.users_id as id')
                        ->where('users_data.users_id', '=', $data['acc_id'])
                        ->first();
                break;
                case 'admin':
                    $acc_data = Admins::select('admins.*')
                        ->where('admins.id', '=', $data['acc_id'])
                        ->first();
                break;
            }

            return ['acc_data' => $acc_data, 'type' => $data['type']];
        }


        /**
         * @param $data
         *
         * @return bool
         * @throws Exception
         */
        private function check_input_data($data){
            if(empty($data['token'])) {
                throw new Exception('Invalid parameter. Empty token' , 404);
            }

            return true;
        }


    }