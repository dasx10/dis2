<?php
    namespace App\Http\Middleware\Web\Brands;
    use App\Model\Brands\Brands;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class AddBrand
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
                $this->check_title($data['title']);
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_title($title){
            if(Brands::where('title','=',$title)->exists()){
                throw new Exception("Brand with current title is already exists", 404);
            }
            return true;
        }

        private function check_empty_data($data){
            if(empty($data['title'])){
                throw new Exception('Invalid parameter. Empty title', 404);
            }

            return true;
        }

    }