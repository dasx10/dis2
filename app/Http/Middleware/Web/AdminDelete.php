<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Sessions;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Http\Middleware\Web\CheckRoleTypeAccess;
    use App\Http\Middleware\Web\DefaultValidation;
    class AdminDelete
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
//                CheckRoleTypeAccess::check_add_delete_admin();
                $this->check_empty_data($data);
                $this->check_exists_admin($data['admins_id']);
//                DefaultValidation::check_token($data['token']);
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_exists_admin($id){
            $admins_exists = DB::table('admins')->where('id','=',$id)->exists();
            if(!$admins_exists){
                throw new Exception("Admin was not found", 404);
            }

            return true;
        }

        private function check_empty_data($data){
            if(empty($data['admins_id'])){
                throw new Exception('Invalid parameter. Empty admins_id', 404);
            }

            return true;
        }

    }