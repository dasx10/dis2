<?php

namespace App\Http\Controllers\Admins\Chat;

use App\Model\Clients\ClientsData;
use App\Model\Logs\Logs;
use App\Model\Photos\Photos;
use App\Model\Sessions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Chat\Chat;
use App\Model\Admins\Admins;
use App\Model\Chat\ChatMessages;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller{
    private $chat_model,$data;

    /**
     * ChatController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->chat_model = new Chat();
        $this->data = $request->post();
    }

    public function main_view_user(Request $request){
        //Get Data
        $exists_chats = $this->chat_model->get_exists_chats_for_admins($request->acc_data,'user');
        $new_chats = $this->chat_model->get_new_chats($exists_chats, $request->acc_data, $request->acc_type);
        return view('user.message', [
            'have_new_chats' => (count($new_chats)>0)?1:0,
            'new_chats' => $new_chats,
            'exists_chats' => $exists_chats,
            'token' => Sessions::get_token()
        ]);
    }

    public function chat_view_user($chat_id,Request $request){
        if(!empty($chat_id) && $chat_data = $this->chat_model->check_exists_chat_by_id($chat_id)){
            if($chat_data->users_id_f == $request->acc_data->id2 && $chat_data->hide_for_users_id_f == 1){
                return redirect('/panel/user/messages')->with('status', 'Chat does not exists');
            }elseif ($chat_data->users_id_s == $request->acc_data->id2 && $chat_data->hide_for_users_id_s == 1){
                return redirect('/panel/user/messages')->with('status', 'Chat does not exists');
            }else {
                $exists = ($chat_data->users_id_f == $request->acc_data->id2 && $chat_data->hide_for_users_id_s == 1 || $chat_data->users_id_s == $request->acc_data->id2 && $chat_data->hide_for_users_id_f == 1)?0:1;
                ChatMessages::where('chat_room_id', '=', $chat_id)->where('users_to', '=', $request->acc_data->users_id)->update(['status' => 'read']);
                $messages = $this->chat_model->get_messages($chat_data, $request->acc_data->users_id);

                return view('user.chat', [
                    'exists' => $exists,
                    'admin_id' => $request->acc_data->users_id,
                    'token' => Sessions::get_token(),
                    'messages' => $messages
                ]);
            }
        }

        return redirect('/panel/user/messages')
            ->with('status','Chat does not exists');
    }


    public function main_view(Request $request){
        //Get Data
        $exists_chats = $this->chat_model->get_exists_chats_for_admins($request->acc_data);
        $new_chats = $this->chat_model->get_new_chats($exists_chats, $request->acc_data, $request->acc_type);

        return view('admin.message', [
            'have_new_chats' => (count($new_chats)>0)?1:0,
            'new_chats' => $new_chats,
            'exists_chats' => $exists_chats,
            'token' => Sessions::get_token()
        ]);
    }


    /**
     * @param $chat_id
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function chat_view($chat_id, Request $request){
        if(!empty($chat_id) && $chat_data = $this->chat_model->check_exists_chat_by_id($chat_id)){
                if($chat_data->users_id_f == $request->acc_data->id2 && $chat_data->hide_for_users_id_f == 1){
                    return redirect('/panel/admin/messages')->with('status', 'Chat does not exists');
                }elseif ($chat_data->users_id_s == $request->acc_data->id2 && $chat_data->hide_for_users_id_s == 1){
                    return redirect('/panel/admin/messages')->with('status', 'Chat does not exists');
                }else {
                    $exists = ($chat_data->users_id_f == $request->acc_data->id2 && $chat_data->hide_for_users_id_s == 1 || $chat_data->users_id_s == $request->acc_data->id2 && $chat_data->hide_for_users_id_f == 1)?0:1;
                    ChatMessages::where('chat_room_id', '=', $chat_id)->where('users_to', '=', $request->acc_data->users_id)->update(['status' => 'read']);
                    $messages = $this->chat_model->get_messages($chat_data, $request->acc_data->users_id);

                    return view('admin.chat', [
                        'exists' => $exists,
                        'admin_id' => $request->acc_data->users_id,
                        'token' => Sessions::get_token(),
                        'messages' => $messages
                    ]);
                }
            }

        return redirect('/panel/admin/messages')
            ->with('status','Chat does not exists');
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function chat_create(Request $request){

        //Creating New
        $this->chat_model->create_new([
            'users_id_f' => $request->acc_data->users_id,
            'users_id_s' => $this->data['users_id_s'],
            'type_of_users_id_f' => $request->acc_type,
            'type_of_users_id_s' => $this->data['type_acc']
        ]);

        //Create Log
        if($this->data['type_acc'] == 'admin') {
            $users2_name_role = Admins::where('users_id', '=', $this->data['users_id_s'])->select('name', 'role')->first();
        }else{
            $users2_name_role = (object)['name'=>ClientsData::where('users_id','=',$this->data['users_id_s'])->value('contact_name'),'role'=>''];
        }
        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') create a chat with '.$users2_name_role->name.'( '.$users2_name_role->role.' )',
            'type' => 'chats'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'chat success created'
        ],200);
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_chat(Request $request){

        if($request->chat_data->users_id_f == $request->acc_data->users_id){
            $this->chat_model->set_hide_for_users($this->data['chat_id'],'hide_for_users_id_f');
            if($request->chat_data->hide_for_users_id_s == 1){
                //Deleting
                $this->chat_model->chat_messages_model->delete_message_with_files_by_chats_id($this->data['chat_id']);
                $this->chat_model->delete_chat($this->data['chat_id']);
            }
        }else{
            $this->chat_model->set_hide_for_users($this->data['chat_id'],'hide_for_users_id_s');
            if($request->chat_data->hide_for_users_id_f == 1){
                //Deleting
                $this->chat_model->chat_messages_model->delete_message_with_files_by_chats_id($this->data['chat_id']);
                $this->chat_model->delete_chat($this->data['chat_id']);
            }
        }


        //Creating Log
        Logs::create([
            'admins_id' => $request->acc_data->id,
            'text' => $request->acc_data->name.'('.$request->acc_data->role.') removed the chat',
            'type' => 'chats'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Chat success deleted'
        ],200);
    }


    public function search_message(Request $request){
        if(empty($this->data['type'])) {
            $messages = $this->chat_model->chat_messages_model->search_messages($this->data['text'],$request->acc_data,false);
        }else{
            $messages = $this->chat_model->chat_messages_model->search_messages($this->data['text'],$request->acc_data,true);
        }
        return response()->json([
            'success' => true,
            'items' => $messages
        ],200);
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function send_message(Request $request){
        if($this->data['type_message'] == 'file' && !empty($request->file('file'))){
            $request->insert_data['message'] = Photos::upload_photo($request->file('file'),'/chats_files/');
        }
        $chat_messages_id = $this->chat_model->chat_messages_model->create_new($request->insert_data);
        $chat_messages_data = $this->chat_model->chat_messages_model->find($chat_messages_id);

        return response()->json([
            'success' => true,
            'time' => $this->chat_model->get_how_long($chat_messages_data->created_at,1),
            'message' => $chat_messages_data->message,
            'message_id' => $chat_messages_id
        ],200);
    }

    public function delete_messages(Request $request){
        $this->chat_model->chat_messages_model->delete_message_by_messages_ids($this->data['array_ids_to_delete']);

        return response()->json([
            'success' => true,
            'message' => 'success delete'
        ],200);
    }


    public function get_messages(){
        $name='';
        $name123 = '';
        $admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
        $messages = ChatMessages::where('chat_room_id','=',$this->data['chat_room_id'])
            ->where('admin_from','<>',$admins_id)
            ->where('id','>',$this->data['last_message'])
            ->get();
        if(count($messages)>0){
            $name = Admins::where('id','=',$messages[0]->admin_from)->value('name');
            $names = explode(' ',$name);
            $name123 = ucfirst($names[0])[0];
            if(!empty($names[1])){
                $name123.=''.ucfirst($names[1])[0];
            }
            foreach ($messages as $message) {
                $message->time = $this->chat_model->get_how_long($message->created_at);
            }
        }
        return response()->json(['success'=>true,'ii'=>$name123,'name'=>$name,'messages'=>$messages],200);
    }

    /**
     *Destruct
     */
    public function __destruct(){
        unset($this->model);
        unset($this->data);
    }
}
