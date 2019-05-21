<?php
    namespace App\Http\Middleware\Web;
    use App\Model\Chat\Chat;
    use Illuminate\Support\Facades\DB;
    use Closure;
    use Exception;
    use App\Model\Sessions;

    class ApiAdminChatSendMessage
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

                if($data['type_message'] == 'file' && empty($request->file('file'))){
                    throw new Exception('Invalid parameter. Empty file', 404);
                }

                $this->check_exists_chat($data['chat_room_id']);
                $request->insert_data = $insert_data;
                return $next($request);
            }catch (Exception $e){
                return response(json_encode(['success' => false,"message"=>$e->getMessage()],200));
            }
        }

        private function check_exists_chat($chat_id){
            if(!Chat::where('id','=',$chat_id)
                ->exists()){
                throw new Exception('Chat was not found',404);
            }

            return true;
        }

        private function check_empty_data($data){
            $insert_data = [];
            $array_required = ['chat_room_id','users_from','users_to','type_message'];
            foreach ($array_required as $item) {
                if(empty($data[$item])){
                    throw new Exception('Invalid parameter. Empty '.$item, 404);
                }
                $insert_data[$item] = $data[$item];
            }

            if($data['type_message'] == 'text' && empty($data['message'])){
                throw new Exception('Invalid parameter. Empty message', 404);
            }
            if(!empty($data['message'])){
                $insert_data['message'] = strip_tags($data['message']);
                $insert_data['message'] = stripslashes($insert_data['message']);
                $insert_data['message'] = str_replace("&nbsp;", '', $insert_data['message']);
                $insert_data['message'] = htmlspecialchars($insert_data['message']);
            }

            return $insert_data;
        }


    }