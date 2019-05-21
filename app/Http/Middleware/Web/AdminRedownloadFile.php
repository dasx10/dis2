<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
use App\Http\Middleware\Web\DefaultValidation;

    class AdminRedownloadFile
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
                DefaultValidation::check_token($data['token']);
                if(!$request->file('afile')){
                    throw new Exception("File is empty!", 404);
                }
                $this->check_doc_id($data['documents_id']);
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_doc_id($doc_id){
            $data = DB::table('admins_documents')->where('id','=',$doc_id)->exists();
            if(!$data){
                throw new Exception("Document dos not exists!", 404);
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