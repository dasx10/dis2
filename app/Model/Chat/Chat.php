<?php

namespace App\Model\Chat;

use App\Model\Admins\Admins;
use App\Model\Clients\Clients;
use App\Model\Clients\ClientsData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chat extends Model{
    public $chat_messages_model;
    protected $table = 'chat_room';
    protected $dateFormat = 'U';
    protected $fillable = ['users_id_f','users_id_s','hide_for_users_id_f','hide_for_users_id_s'
        ,'type_of_users_id_f','type_of_users_id_s','created_at','updated_at'];

    /**
     * Chat constructor.
     */
    public function __construct() {
        $this->chat_messages_model = new ChatMessages();
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

    public function get_new_chats($exists_chats,$acc_data, $user_type){
        $array_users_ids = [];
        $admin_role_type = [
            'super_admin' => 'Super Admin',
            'admin' => 'Admin',
            'sales' => 'Sales',
            'purchase' => 'Purchase',
            'purchase_assistant' => 'Purchase Assistant',
            'customer_service' => 'Customer Service',
            'finance' => 'Finance',
            'opm' => 'Operation manager'
        ];
        foreach ($exists_chats as $exists_chat) {
            if (!in_array($exists_chat->users_id_f,$array_users_ids)) {
                if ($exists_chat->hide_for_users_id_f != 1) {
                    $array_users_ids[] = $exists_chat->users_id_f;
                }
            }
            if (!in_array($exists_chat->users_id_s,$array_users_ids)) {
                if ($exists_chat->hide_for_users_id_s != 1) {
                    $array_users_ids[] = $exists_chat->users_id_s;
                }
            }
        }

        $new_users = Clients::whereNotIn('users.id', $array_users_ids)
            ->select('users.id as users_id', 'a.name', 'a.role',
                'ud.contact_name', 'users.type_acc')
            ->leftJoin('admins as a', 'users.id', '=', 'a.users_id')
            ->leftJoin('users_data as ud', 'users.id', '=', 'ud.users_id')
            ->where('users.id', '!=', $acc_data->users_id)
            ->get();


        $response_data = [];
        foreach ($new_users as $key => $new_user) {
//            echo $new_user->type_acc;
            if ($user_type == 'user' && $new_user->role != 'customer_service' && $new_user->role != 'opm') {
                continue;
            }

            if ($new_user->type_acc == 'admin') {
                $new_user->full_name = $new_user->name;
            }else{
                $new_user->full_name = $new_user->contact_name;
            }
            $new_user->short_name = self::get_abbr($new_user->full_name);
            $new_user->color = self::get_color($key);
            $new_user->type_role = '';
            if($new_user->type_acc == 'admin' && array_key_exists($new_user->role,$admin_role_type)){
                $new_user->type_role = $admin_role_type[$new_user->role];
            }
            unset($new_user->name);
            unset($new_user->contact_name);
            $response_data[] = $new_user;
        }
        return $response_data;
    }


    public function get_exists_chats_for_admins($acc_data,$type_acc='admin'){
        $chats = self::select('chat_room.*')
            ->where([
                ['chat_room.users_id_f','=',$acc_data->users_id],
                ['chat_room.hide_for_users_id_f','=',0],
                ['chat_room.type_of_users_id_f','=',$type_acc]
            ])
            ->orWhere([
                ['chat_room.users_id_s','=',$acc_data->users_id],
                ['chat_room.hide_for_users_id_s','=',0],
                ['chat_room.type_of_users_id_s','=',$type_acc]
            ])
            ->selectRaw(DB::raw("IFNULL((select chat_room_messages.message from chat_room_messages where chat_room_id = chat_room.id order by chat_room_messages.created_at DESC limit 1),'') as message"))
            ->selectRaw(DB::raw("IFNULL((select chat_room_messages.created_at from chat_room_messages where chat_room_id = chat_room.id order by chat_room_messages.created_at DESC limit 1),'') as time"))
            ->orderBy('time','DESC')
            ->get();

        foreach ($chats as $key=>$chat) {
            $chat->full_name = self::get_full_name_for_chat($chat,$acc_data);
            $chat->short_name = self::get_abbr($chat->full_name);
            $chat->color = self::get_color($key);
            $chat->count_of_new_messages = $this->chat_messages_model->get_count_of_new_messages_by_chats_id($chat->id,$acc_data->users_id);
            $chat->time = self::get_how_long($this->chat_messages_model->get_last_message_time($chat->id));
        }

        return $chats;
    }

    private function get_full_name_for_chat($chat,$acc_data){
        if($chat->users_id_f==$acc_data->users_id) {
            if($chat->type_of_users_id_s == 'admin'){
                return Admins::where('users_id','=',$chat->users_id_s)->value('name');
            }
            return ClientsData::where('users_id','=',$chat->users_id_s)
                ->value('contact_name');
        }else{
            if($chat->type_of_users_id_f == 'admin'){
                return Admins::where('users_id','=',$chat->users_id_f)->value('name');
            }
            return ClientsData::where('users_id','=',$chat->users_id_f)
                ->value('contact_name');
        }
    }

    public static function get_abbr_s($name){
        $name_expl = explode(' ',$name);
        $short_name = ucfirst($name_expl[0])[0];
        if (!empty($name_expl[1])) {
            $short_name .= '' . ucfirst($name_expl[1])[0];
        }

        return $short_name;
    }


    private function get_abbr($name){
        $name_expl = explode(' ',$name);
        $short_name = '';
        if(!empty($name_expl[0])) {
            $short_name = ucfirst($name_expl[0])[0];
        }
        if (!empty($name_expl[1])) {
            $short_name .= '' . ucfirst($name_expl[1])[0];
        }

        return $short_name;
    }

    /**
     * @param $key
     *
     * @return mixed|string
     */
    private function get_color($key){
        $colors = ['#4c6897','#6e89b5','#33425a','#3f7bdc','#256bdc','#0b244e',
            '#213556','#354156','#393d44'];

        return (!empty($colors[$key]))? $colors[$key] : sprintf('#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255));
    }


    public function upload_file($file){
        $name = time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/chat_files');
        $file->move($destinationPath, $name);
        return asset('public/chat_files/'.$name);
    }

    /**
     * @param $chat_id
     *
     * @return bool
     */
    public function check_exists_chat_by_id($chat_id){
        $data = self::where('id','=',$chat_id)
            ->first();
        if(!empty($data)){
            return $data;
        }

        return false;
    }

    /**
     * @param $chat_data
     * @param $admin_id
     *
     * @return mixed
     */
    public function get_messages($chat_data, $admin_id){
        $messages = $this->chat_messages_model->get_messages_by_chats_id($chat_data->id);
        foreach ($messages as $message) {
            if($message->users_to == $admin_id){
                $message->time = $this->get_how_long($message->created_at);
            }else{
                $message->time = $this->get_how_long($message->created_at,1);
            }

            $message->full_name = ($message->type_acc == 'admin')? $message->name : $message->contact_name;
            $message->short_name = self::get_abbr($message->full_name);

        }
        $messages->users_to = ($chat_data->users_id_f==$admin_id)? $chat_data->users_id_s : $chat_data->users_id_f;
        $messages->users_from = $admin_id;
        $messages->chat_id = $chat_data->id;
        return $messages;
    }

    /**
     * @param $time
     * @param int $type
     *
     * @return false|string
     */
    public function get_how_long($time, $type=0){
        $curr_time = date('Y-m-d H:i:s',time());
        $diff_time =strtotime($curr_time)-strtotime($time);

        $minute = floor(0.0166667*$diff_time);
        $hours = floor($minute/60);
        if($type==0) {
            if ($diff_time < 3600) {
                return 'at ' . date('h:i A', strtotime($time . ' +3 hour'));
            } elseif ($diff_time > 3600 && $diff_time < 86400) {
                return $hours . ' hours ago, at ' . date('h:i A', strtotime($time . ' +3 hour'));
            } else {
                $day = date('j M', strtotime($time));
                $times = date('h:i A', strtotime($time . ' +3 hour'));
                return $day . ', at ' . $times;
            }
        }

        return date('h:i A', strtotime($time . ' +3 hour'));

    }

    /**
     * @param $chats_id
     *
     * @return mixed
     */
    public function delete_chat($chats_id){
        return self::where('id','=',$chats_id)
            ->delete();
    }

    /**
     * @param $chats_id
     * @param $type_users
     *
     * @return mixed
     */
    public function set_hide_for_users($chats_id, $type_users){
        return self::where('id','=',$chats_id)->update([
            $type_users => 1
        ]);
    }
}
