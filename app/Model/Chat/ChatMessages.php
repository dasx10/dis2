<?php

namespace App\Model\Chat;

use App\Model\Admins\Admins;
use App\Model\Clients\ClientsData;
use App\Model\Photos\Photos;
use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model{
    protected $table = 'chat_room_messages';
    protected $dateFormat = 'U';
    protected $fillable = ['chat_room_id','users_from','users_to','message','type_message','type_file','status','created_at'];

    /**
     * @param $chats_id
     * @param $users_to
     *
     * @return mixed
     */
    public function get_count_of_new_messages_by_chats_id($chats_id, $users_to){
        return self::where([
                ['users_to','=',$users_to],
                ['chat_room_id','=',$chats_id],
                ['status','=','send']
            ])
            ->count();
    }

    public function get_last_message_time($chats_id){
        return self::where('chat_room_id','=',$chats_id)
            ->limit(1)
            ->orderBy('created_at','DESC')
            ->value('created_at');
    }


    public function delete_message_with_files_by_chats_id($chats_id){
        $messages = self::where('chat_room_id','=',$chats_id)
            ->where('type_message','=','file')
            ->select('message')
            ->get();
        foreach ($messages as $file) {
            Photos::delete_photo($file->message);
        }

        return true;
    }

    public function delete_message_by_messages_ids($array_ids){
        $messages = self::whereIn('id',$array_ids)
            ->get();
        foreach ($messages as $message) {
            if($message->type_message == 'file'){
                Photos::delete_photo($message->message);
            }
            $message->delete();
        }

        return true;
    }


    /**
     * @param $chats_id
     *
     * @return mixed
     */
    public function get_messages_by_chats_id($chats_id){
        return self::where('chat_room_messages.chat_room_id', '=', $chats_id)
            ->leftJoin('admins as a', 'chat_room_messages.users_from', '=', 'a.users_id')
            ->leftJoin('users_data as ud', 'chat_room_messages.users_from', '=', 'ud.users_id')
            ->leftJoin('users as u', 'chat_room_messages.users_from', '=', 'u.id')
            ->select('chat_room_messages.*','a.name','ud.contact_name','u.type_acc')
            ->orderBy('chat_room_messages.created_at','ASC')
            ->get();
    }

    /**
     * @param $array
     *
     * @return mixed
     */
    public function create_new($array){
        $array['created_at'] = time();
        $array['updated_at'] = time();
        return self::insertGetId($array);
    }


    public function search_messages($word,$acc_data,$type=false){
        $response = [];
        $chat_model = new Chat();
        if(!$type) {
            $messages = self::select('chat_room_messages.*','cr.users_id_f','cr.users_id_s',
                    'cr.type_of_users_id_f','cr.type_of_users_id_s')
                ->leftJoin('chat_room as cr','chat_room_messages.chat_room_id','=','cr.id')
                ->where([
                    ['chat_room_messages.message','LIKE',"%$word%"],
                    ['cr.hide_for_users_id_f','=',0],
                    ['cr.users_id_f','=',$acc_data->users_id]
                ])
                ->orWhere([
                    ['chat_room_messages.message','LIKE',"%$word%"],
                    ['cr.hide_for_users_id_s','=',0],
                    ['cr.users_id_s','=',$acc_data->users_id]
                ])
                ->limit(5)
                ->get();
            foreach ($messages as $message) {
                if ($acc_data->users_id == $message->users_id_f) {
                    $users_name = ($message->type_of_users_id_s == 'admin') ? Admins::where('users_id', '=', $message->users_id_s)->value('name') : ClientsData::where('users_id', '=', $message->users_id_s)
                        ->value('contact_name');
                } else {
                    $users_name = ($message->type_of_users_id_f == 'admin') ? Admins::where('users_id', '=', $message->users_id_f)->value('name') : ClientsData::where('users_id', '=', $message->users_id_f)
                        ->value('contact_name');
                }
                $response[] = ['id' => $message->chat_room_id, 'value' => 'Chat with: ' . $users_name . ' . Message: ' . $message->message ];
            }
        }else{
            $chat_data = Chat::where([
                    ['users_id_f','=',$acc_data->users_id],
                    ['hide_for_users_id_f','=',0]
                ])
                ->orWhere([
                    ['users_id_s','=',$acc_data->users_id],
                    ['hide_for_users_id_s','=',0],
                ])
                ->select('users_id_f','users_id_s','id','type_of_users_id_s','type_of_users_id_f')
                ->get();
            foreach ($chat_data as $chat) {

                if ($acc_data->users_id == $chat->users_id_f) {
                    $users_name = ($chat->type_of_users_id_s == 'admin') ? Admins::where('users_id', '=', $chat->users_id_s)->value('name') : ClientsData::where('users_id', '=', $chat->users_id_s)
                        ->value('contact_name');
                } else {
                    $users_name = ($chat->type_of_users_id_f == 'admin') ? Admins::where('users_id', '=', $chat->users_id_f)->value('name') : ClientsData::where('users_id', '=', $chat->users_id_f)
                        ->value('contact_name');
                }
                if(!empty($users_name)) {
                    $message_data = ChatMessages::where('chat_room_id','=',$chat->id)->select('created_at')->orderBy('created_at','DESC')->first();
                    $time = (!empty($message_data))? $chat_model->get_how_long($message_data->created_at) : '';
                    $response[] = ['id' => $chat->id, 'value' => $users_name,'time'=>$time];
                }

            }
        }

        return $response;
    }
}
