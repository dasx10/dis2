<?php
    namespace App\Http\Middleware\Web\Prize;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class AddPrize
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
                if(empty($request->file('prize_img'))){
                    throw new Exception('Please, select image');
                }
                $request->insert_data = $insert_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }


        private function check_empty_data($data){
            $insert_data = [];
            $array_required = [
                'title' => 'title',
                'points' => 'points',
                'end_date' => 'end date',
                'rate' => 'rate'
            ];
            foreach ($array_required as $key=>$full_name) {
                if(empty($data[$key])){
                    throw new Exception('Invalid parameter. Empty '.$full_name, 404);
                }
                $insert_data[$key] = $data[$key];
            }


            if(!empty($data['descr'])) {
                $insert_data['descr'] = $data['descr'];
            }

            return $insert_data;
        }

    }