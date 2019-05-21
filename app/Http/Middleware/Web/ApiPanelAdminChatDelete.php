<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Chat\Chat;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Model\Sessions;

    class ApiPanelAdminChatDelete
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
                $chat_data = $this->check_exists_chat($data['chat_id']);
                $request->chat_data = $chat_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_exists_chat($chat_id){
            if(!$data = Chat::where('id','=',$chat_id)
                ->first()){
                throw new Exception('Chat was not found',404);
            }

            return $data;
        }

        private function check_empty_data($data){
            if(empty($data['chat_id'])){
                throw new Exception('Invalid parameter. Empty chat id', 404);
            }
        }


    }