<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Fileaclaim\Fileaclaim;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;


    class FileaclaimCreating
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
                $insert_data['operation'] = $data['operation'];
                $insert_data['text'] = (!empty($data['text']))? $data['text']:'';
                $insert_data['users_id'] = $request->acc_data->id;
                $insert_data['unique_id'] = Fileaclaim::generate_password(16);
                $request->insert_data = $insert_data;

                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }


        private function check_empty_data($data){
            if(empty($data['operation'])){
                throw new Exception('Invalid parameter. Empty operation', 404);
            }

            return true;
        }

    }