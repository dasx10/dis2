<?php
use App\Model\Chat\ChatMessages;
use App\Model\Sessions;
use App\Model\Chat\Chat;
use App\Model\Notifications\Notifications;
use App\Model\Admins\Admins;
use Illuminate\Http\Request;
$chat = new Chat();
$admins_id = Sessions::get_admins_id_by_token(Sessions::get_token());
$admins_data = Admins::where('id','=',$admins_id)->select('role','name','users_id')->first();
$admins_users_id = $admins_data->users_id;
$count = ChatMessages::where('users_to','=',$admins_users_id)
    ->where('status','=','send')->count();
$count_total = ChatMessages::where('users_to','=',$admins_users_id)
    ->orWhere('users_from','=',$admins_users_id)
    ->count();

$last_messages_data = ChatMessages::where([
        ['chat_room_messages.users_to','=',$admins_users_id],
        ['cr.hide_for_users_id_s','=',0]
    ])
    ->leftJoin('chat_room as cr','chat_room_messages.chat_room_id','=','cr.id')
    ->select('chat_room_messages.users_to','chat_room_messages.users_from','chat_room_messages.created_at',
        'chat_room_messages.chat_room_id','cr.type_of_users_id_f','cr.type_of_users_id_s','cr.users_id_f','cr.users_id_s')
    ->limit(1)
    ->orderBy('created_at','DESC')
    ->get();

//dd($last_messages_data);

$notifications_new = Notifications::where('is_new','=','1')->count();
$notifications_all = Notifications::count();
$notifications = Notifications::where('is_view','=','1')->orderBy('created_at','DESC')->limit(3)->get();

?>
<header class="app-header">
    <div class="container-fluid header_wrapper">
        <div class="row d-flex flex-nowrap">
        <div class="logo-header">
            <a href="/panel/admin"><img src="/public/img/admin/logo.png" alt=""></a>
        </div>
        <div class="col align-items-center d-none d-sm-none d-md-flex d-xl-flex">
            <span class="header_text" style="font-family: RalewayBold;"></span>
        </div>
        <div class="col align-items-center justify-content-end  d-none d-sm-none d-md-flex d-xl-flex">
            <div class="dropdown show">
                <a id="header_messages" class="align-self-center header_breadcrumb" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'RalewaySemiBold';font-size: 1rem;padding-bottom: 0.5rem;position: relative;width: 8.75rem;display: inline-flex;padding-top: 0.625rem;">
                    <span style="position:relative;"><img src="/public/img/admin/icon_messages.png" alt="" style="width: 2.5625rem;height: 2.1875rem;">
                    <span class="align-self-center" style="left: 0px;position: absolute;bottom:0.5rem;text-align:center;width:100%;color: #4c6897;">{{$count_total}}</span>
                        </span>
                    <span class="header_text_messages align-self-center">MESSAGES
                        @if($count!=0)
                            <div class="inform"><span class="msg_point">{{$count}}</span></div>
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu box-shadow" aria-labelledby="header_messages" id="message_popup">
                    <div class="col form-group">
                        <input type="search" name="search_people_chat" class="form-control" style="border-radius:0.5rem 0px 0px 0.5rem;border-right:none!important;height: 3.0625rem;" placeholder="Search people...">
                        <span style="border-radius:0px 0.5rem 0.5rem 0px;background-color:#f2f2f2;border:0.125rem solid #aab4bc!important;border-left:none!important;    width: 2.9375rem;
    height: 3.0625rem;">
                            <i class="fa fa-search" aria-hidden="true" style="color: #aab4bc;font-size: 1.3rem;margin-top: .8rem;margin-left: .5rem;"></i>
                    </span>
                    </div>
                    <h5 class="text-center latest_from_text" style="font-size: 1.125rem;font-family: RalewayRegular;">Latest messages from:</h5>
                    <div class="row form-group search_people">
                        @foreach($last_messages_data as $last_message)
                            <?php
                                if ($admins_users_id == $last_message->users_id_f) {
                                    $users_name = ($last_message->type_of_users_id_s == 'admin') ? Admins::where('users_id', '=', $last_message->users_id_s)->value('name') : \App\Model\Clients\ClientsData::where('users_id', '=', $last_message->users_id_s)
                                        ->value('contact_name');
                                } else {
                                    $users_name = ($last_message->type_of_users_id_f == 'admin') ? Admins::where('users_id', '=', $last_message->users_id_f)->value('name') : \App\Model\Clients\ClientsData::where('users_id', '=', $last_message->users_id_f)
                                        ->value('contact_name');
                                }
//                                dd($last_message);
                                $time = $chat->get_how_long($last_message->created_at);
                            ?>
                            <div class="col text-center" style="cursor: pointer" onclick="window.location='/panel/admin/chat/{{$last_message->chat_room_id}}'">
                                <span style="font-family: RalewayMedium;" data-msg="{{\App\Model\Chat\Chat::get_abbr_s($users_name)}}"></span>
                                <p style="margin:0;font-size: 1.125rem;font-family: RalewaySemiBold;"><b>{{$users_name}}</b></p>
                                <p style="margin:0;font-size: 0.875rem;font-family: RalewayLight;">{{$time}}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="col text-center" style="background:#e9e9e9;padding-top:0.625rem;padding-bottom:0.625rem;">
                        <a href="/panel/admin/messages" style="color:#4c6897;">Show all messages</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col align-items-center  d-none d-sm-none d-md-flex d-xl-flex" style="padding-left: 0.9375rem;">
            <a id="header_notifications" class="header_breadcrumb" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'RalewaySemiBold';font-size: 1rem;padding-bottom: 0.5rem;position: relative;width: 9.875rem;display: inline-flex;padding-top: 0.625rem;">
                <span style="position:relative;"><img src="/public/img/admin/icon_notification.png" style="height: 2.4375rem;width: 2rem;">
                <span class="align-self-center" style="left: 0px;position: absolute;bottom:0.5rem;color: #4c6897;text-align:center;width:100%;">{{$notifications_all}}</span>
                    </span>
                <span class="header_text_notifications align-self-center">NOTIFICATIONS
                @if($notifications_new>0)
                    <div class="inform inform_notifications"><span class="notif_point">{{$notifications_new}}</span></div>
                @endif
                </span>
            </a>
            <div class="dropdown-menu box-shadow" aria-labelledby="header_notifications" id="notifications_popup">
                <div class="form-group" style="margin-bottom:0.4375rem;">
                    <div class="col" style="padding-right:0.625rem;padding-left:0.625rem;">
                        <div class="card" style="padding-right:0.625rem;padding-left:0.625rem;border: 0.0625rem solid #e5e5e5;">
                            @foreach($notifications as $notification)
                                <?php
                                    $time = \App\Model\Clients\Clients::get_how_long($notification->created_at);
                                ?>
                                <div class="row notifications_item" style="cursor: pointer;" data-id="{{$notification->id}}">
                                    {{--<div class="col-2 d-flex align-items-center">--}}
                                        {{--<img src="/public/img/admin/ico_notif.png" alt="" style="width:2.625rem;height:2.75rem;">--}}
                                    {{--</div>--}}
                                    <div class="col" onclick="window.location = '{{$notification->src}}'">
                                        <p class="mb-0" style="font-size:1rem;margin-top: 0.5rem;"><b>{{$notification->title}}:</b> {{$notification->message}}</p>
                                        <p style="font-size:0.875rem;color:#b8b8b8;margin-bottom: 0.5rem;">{{$time}}</p>
                                    </div>
                                    <div class="col-2">
                                        <a href="javascript:void(0);" onclick="delete_notifications_block('{{$notification->id}}')">
                                            <img src="/public/img/admin/ico_close.png" alt="" style="float: right;margin-top: 0.5rem;width: 0.625rem;height: 0.625rem;">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col text-center" style="background:#e9e9e9;padding-top:0.625rem;padding-bottom:0.625rem;">
                    <a href="/panel/admin/notifications" style="color:#4c6897;">Show all notifications</a>
                </div>

            </div>
        </div>
            <div class="col d-flex align-items-center justify-content-end hide_name" style="text-transform:uppercase; font-family: RalewayBold;color:white;font-size: 1rem;">
                <p class="m-0 text-center"><span>{{$admins_data->name}}</span> <br> <span>
                        <?php
                            if($admins_data->role=='opm'){
                                $role = 'Operation manager';
                            }else{
                                $expl = explode('_',$admins_data->role);
                                $role = ucfirst($expl[0]);
                                if(!empty($expl[1])){
                                    $role.=' '.$expl[1];
                                 }
                            }
                            echo $role;
                        ?>
                    </span></p>
            </div>
        <div class="col-1 align-items-center justify-content-end  d-none d-sm-none d-md-flex d-xl-flex">
            <a id="header_logout" href="/logout" class="d-flex  flex-wrap" style="font-family: 'RalewaySemiBold'; font-size:1rem; color: white;">
                <img src="/public/img/admin/icon_logout.png" alt="logout" class="header_icon_logout">
                <span class="hide-xs">LOG OUT</span>
            </a>
        </div>
        <div class="col d-flex d-sm-flex d-md-none d-xl-none align-items-center justify-content-end">
            <button class="navbar-dark navbar-toggler btn_open_navbar" type="button" >
                <span style="display: inline-flex;" class="navbar-toggler-icon"></span>
            </button>
        </div>
        </div>
    </div>
</header>