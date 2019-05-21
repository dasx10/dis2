<?php
    namespace App\Http\Middleware\Web\Orders;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class PurchaseOrder
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
                'pod' => 'destination port',
//                'other_instructions' => 'other instructions',
                'po_num' => 'po number',
                'dis_ref' => 'dis ref',
                'total_amount' => 'total amount',
                'payment_terms' => 'payment terms',
                'fob_subtotal' => 'fob subtotal',
                'container_size' => 'container size',
                'region' => 'region'
            ];
            foreach ($array_required as $key=>$full_name) {
                if(empty($data[$key])){
                    throw new Exception('Invalid parameter. Empty '.$full_name, 404);
                }
                $insert_data[$key] = $data[$key];
            }


            $optional = ['insurance','freight_charges','hst','pay_with_points','pay_with_points','other_instructions'];
            foreach ($optional as $o_field) {
                if (!empty($data[$o_field])) {
                    $insert_data[$o_field] = $data[$o_field];
                }
            }

            return $insert_data;
        }

    }