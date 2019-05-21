<?php
    namespace App\Http\Middleware\Web\Basket;
    use App\Model\Brands\Brands;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class AddToBasket
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
                $insert_data['users_id'] = $request->acc_data->id;
                $request->insert_data = $insert_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_empty_data($data){
            $insert_data = [];
            $array_required = [
                'products_id' => 'products id',
                'quantity' => 'quantity',
                'pallet_type' => 'pallet type',
                'packaging_type' => 'packaging type',
                'amount' => 'amount',
                'unit_price' => 'unit price',
                'quantity_val' => 'quantity value'
            ];
            foreach ($array_required as $key=>$full_name) {
                if(empty($data[$key])){
                    throw new Exception('Invalid parameter. Empty '.$full_name, 404);
                }
                $insert_data[$key] = $data[$key];
            }
            if(!empty($data['quantity_decr_key'])){
                $insert_data['quantity_decr_key'] = $data['quantity_decr_key'];
            }

            if(!empty($data['packaging_type_name'])){
                $insert_data['packaging_type_name'] = $data['packaging_type_name'];
            }
            return $insert_data;
        }

    }