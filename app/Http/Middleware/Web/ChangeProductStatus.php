<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Sessions;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\CheckRoleTypeAccess;
    use App\Http\Middleware\Web\DefaultValidation;
    class ChangeProductStatus
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
                $products_name = $this->check_exists_product($data['products_id']);
                if(!isset($data['value'])){
                    throw new Exception('Invalid parameter. Empty value', 404);
                }
                $this->check_value($data['value']);
                $this->check_type($data['type']);
                $request->products_name = $products_name;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_value($value){
            if(!in_array($value,['0','1'])) {
                throw new Exception('Invalid parameter. Incorrect value', 404);
            }

            return true;
        }

        private function check_type($type){
            if(!in_array($type,['active','absent','pre_order'])) {
                throw new Exception('Invalid parameter. Incorrect type', 404);
            }

            return true;
        }

        private function check_exists_product($id){
            $name = DB::table('products')->where('id','=',$id)->value('product_name');
            if(empty($name)){
                throw new Exception("Invalid parameter. Products does not exists", 404);
            }

            return $name;
        }

        private function check_empty_data($data){
            $array_required = ['products_id','type'];
            foreach ($array_required as $item) {
                if(empty($data[$item])){
                    throw new Exception('Invalid parameter. Empty '.$item, 404);
                }
            }
        }

    }