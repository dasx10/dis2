<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;


    class DeleteAdminDocuments
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
                $this->check_exists_documents($data['documents_id']);
                DefaultValidation::check_token($data['token']);
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_exists_documents($id){
            $data = DB::table('admins_documents')->where('id','=',$id)->exists();
            if(!$data){
                throw new Exception("Documents not found!", 404);
            }
        }

        private function check_empty_data($data){
            $array_required = ['token'=>'Token','documents_id'=>'Documents id'];
            foreach ($array_required as $item=>$full_name) {
                if(!array_key_exists($item,$data)){
                    throw new Exception($full_name." is empty!", 404);
                }
            }
        }

    }