<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Products\Products;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class UpdateProduct
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
                $prod_name = $this->find_products($data['products_id']);
                $request->update_data = $update_data;
                $request->products_name = $prod_name;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function find_products($products_id){
            if(!$data = Products::where('id','=',$products_id)->value('product_name')){
                throw new Exception('Invalid parameter. Products was not found', 404);
            }
            return $data;
        }


        private function check_empty_data($data){
            $insert_data = [];
            if(empty($data['products_id'])){
                throw new Exception('Invalid parameter. Empty products_id', 404);
            }

            $options_fields = ['product_name','product_code','specification',
                'category','brand','shipping_class','type_of_packaging1','type_of_packaging2',
                'type_of_packaging3','type_of_packaging1_price','type_of_packaging2_price','type_of_packaging3_price',
                'pallet_without_pallet','price_prod_plus_packaging1',
                'price_prod_plus_packaging2','price_prod_plus_packaging3',
                'lwh_packaging1_wp','lwh_packaging1_p','lwh_packaging2_wp','lwh_packaging2_p',
                'lwh_packaging3_wp','lwh_packaging3_p','loading_port','restrictions','descr',
                'fcl','is_deleted','active','absent','in_stock','pre_order','cas',
                'moc_1_1','moc_1_2','moc_1_3','moc_2_1','moc_2_2','moc_2_3',
                'moc_3_1','moc_3_2','moc_3_3', 'pallet_capacity_for_packaging_type_1',
                'pallet_capacity_for_packaging_type_2','pallet_capacity_for_packaging_type_3'];

            foreach ($options_fields as $options_field){
                if(isset($data[$options_field])){
                    $insert_data[$options_field] = $data[$options_field];
                }else{
                    $insert_data[$options_field] = '';
                }
            }

            return $insert_data;
        }

    }