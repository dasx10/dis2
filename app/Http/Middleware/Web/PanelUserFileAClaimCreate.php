<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Model\Sessions;

    class PanelUserFileAClaimCreate
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
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_empty_data($data){
            $array_required = ['token'=>'Token','operation'=>'Operation reference','text'=>'Text of claim'];
            foreach ($array_required as $item=>$full_name) {
                if(!array_key_exists($item,$data)){
                    throw new Exception($full_name." is empty!", 404);
                }
            }
        }


    }