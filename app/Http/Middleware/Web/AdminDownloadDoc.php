<?php
    namespace App\Http\Middleware\Web;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\DefaultValidation;

    class AdminDownloadDoc
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
//                DefaultValidation::check_token($data['token']);
                if(!$request->file('afile')){
                    throw new Exception("File is empty!", 404);
                }
                $this->check_title($data['title']);
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_title($title){
            $data = DB::table('admins_documents')->where('title','=',$title)->exists();
            if($data){
                throw new Exception("Document with current title is already exists", 404);
            }
        }

        private function check_empty_data($data){
            $array_required = ['title'=>'title','category'=>'category'];
            foreach ($array_required as $item=>$full_name) {
                if(empty($data[$item])){
                    throw new Exception('Invalid parameter. Empty '.$item, 404);
                }
            }
        }

    }