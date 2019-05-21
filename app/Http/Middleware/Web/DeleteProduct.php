<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Sessions;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\CheckRoleTypeAccess;
    use App\Http\Middleware\Web\DefaultValidation;
    class DeleteProduct
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
                $products_data = $this->check_exists_product($data['products_id']);
                $request->products_data = $products_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_exists_product($id){
            $data = DB::table('products')->where('id','=',$id)->first();
            if(empty($data)){
                throw new Exception("Products does not exists", 404);
            }

            return $data;
        }

        private function check_empty_data($data){
            if(empty($data['products_id'])){
                throw new Exception('Invalid parameter. Empty products_id', 404);
            }

            return true;
        }

    }