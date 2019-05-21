<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class AddProduct
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
                $insert_data['created_by'] = $request->acc_data->id;
                $request->insert_data = $insert_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }


        private function check_empty_data($data){
            $insert_data = [];
            $array_required = [
                'product_name' => 'product name',
                'product_code' => 'product code',
                'specification' => 'specification',
                'category' => 'category',
                'brand' => 'brand',
                'shipping_class' => 'shipping class',
                'type_of_packaging1' => 'type of packaging1',
                'pallet_without_pallet' => 'pallet without pallet',
                'moc_1_1' => 'MOQ 1 for the packaging 1',
                'moc_2_1' => 'MOQ 2 for the packaging 1',
                'moc_3_1' => 'MOQ 3 for the packaging 1',
                'price_prod_plus_packaging1' => 'price of product + packaging 1',
                'lwh_packaging1_wp' => 'L*W*H of the packaging 1 (cm)',
                'loading_port' => 'loading port',
//                'restrictions' => 'restrictions',
//                'type_of_packaging1_price' => 'type of packaging 1 price',
                'pallet_capacity_for_packaging_type_1' => 'pallet capacity of packaging 1'
            ];
            foreach ($array_required as $key=>$full_name) {
                if(empty($data[$key])){
                    throw new Exception('Invalid parameter. Empty '.$full_name, 404);
                }
                $insert_data[$key] = $data[$key];
            }

            $options_fields = ['type_of_packaging1_price','type_of_packaging2',
                'type_of_packaging3','pallet_capacity_for_packaging_type_2','pallet_capacity_for_packaging_type_3',
                'price_prod_plus_packaging2','price_prod_plus_packaging3','lwh_packaging1_p',
                'lwh_packaging2_wp','lwh_packaging2_p', 'lwh_packaging3_wp',
                'lwh_packaging3_p','descr', 'fcl','cas','type_of_packaging2_price',
                'type_of_packaging3_price',
                'moc_1_2','moc_2_2','moc_3_2','moc_1_3','moc_2_3','moc_3_3'];

            foreach ($options_fields as $options_field){
                if(!empty($data[$options_field])){
                    $insert_data[$options_field] = $data[$options_field];
                }
            }
            unset($data['token']);

            return $insert_data;
        }

    }