<?php
    namespace App\Http\Middleware\Web\Prize;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class UpdatePrize
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
                $request->update_data = $update_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }


        private function check_empty_data($data){
            $insert_data = [];
            $array_required = ['title','points','end_date','descr','rate'];

            if(empty($data['prize_id'])){
                throw new Exception('Invalid parameter. Empty prize_id', 404);
            }


            foreach ($array_required as $key) {
                if(isset($data[$key])){
                    $insert_data[$key] = $data[$key];
                }else{
                    $insert_data[$key] = '';
                }
            }

            return $insert_data;
        }

    }