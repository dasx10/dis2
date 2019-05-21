@extends('layout.user')
@section('head')
    @include('template.head_user_template')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .card {
            border-radius: 0;
            height: 100%;
            border: none;
        }
        .box-shadow {
            -webkit-box-shadow: 0px 2px 7px 2px rgba(211,209,209,1);
            -moz-box-shadow: 0px 2px 7px 2px rgba(211,209,209,1);
            box-shadow: 0px 2px 7px 2px rgba(211,209,209,1);
        }
        .table th, .table td {
            padding: 1rem!important;
            vertical-align: inherit;
        }
        @foreach($exists_chats as $chat)
             #span_exists_id_{{$chat->id}}:before{
            background:{{$chat->color}}!important;
        }
        @endforeach


        @foreach($new_chats as $admin)
             #span_new_id_{{$admin->id}}:before{
            background:{{$admin->color}}!important;
        }
        @endforeach
        /*@-moz-document url-prefix() {*/
        @media screen and (-webkit-min-device-pixel-ratio:0) {
            .emojionearea .emojionearea-editor {
                padding: 6px 24px 6px 12px !important;
            }
        }
        /*}*/

    </style>
@endsection
@section('content')
    @include('user.header')
    <div class="app-body">
        @include('user.sidebar')
        <main class="main">
            <div class="container-fluid main_container_fluid">
                <div class="card border-0">
                    <div class="row" style="    background-color: #f0f0f0;">
                        <div class="col-12 col-md-9 form-group input-group mb-3">
                            <input type="search" name="search" class="form-control " style="border-radius:0.5rem 0px 0px 0.5rem;border-right:none!important;" placeholder="Search Message">
                            <span style="border-radius: 0px 0.5rem 0.5rem 0px; background-color: #f2f2f2;border-left: none!important;width: 3.5625rem;height: 40px;border: 1px solid #ced4da;" class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true" style="color: #aab4bc;font-size: 1.3rem;margin-top: 0.8rem;margin-left: 1rem;"></i></span>
                        </div>

                        <div class="d-flex col-12 col-md-3 justify-content-md-end form-group">
                            <button class="btn btn_page" data-toggle="modal" data-target="#myModal_start_new_chat">Start New Chat</button>
                        </div>
                    </div>
                    <div class="card-block p-0">
                        <div class="table-responsive-md">
                            <table class="table">
                                <tbody>
                                @foreach($exists_chats as $chat)
                                    <tr style="border-bottom: 1px solid #e5e5e5;">
                                        <td class="text-center" style="width:7%;"><span id="span_exists_id_{{$chat->id}}" data-chat="{{$chat->short_name}}"></span></td>
                                        @if($chat->count_new_mess!=0)
                                            <td><p class="m-0"><b>{{$chat->full_name}}</b><div style="display: flex;position: absolute;" class="inform"><span class="msg_point" style="top: -1.8rem;right: 0rem;color: white;">{{$chat->count_of_new_messages}}</span></div>
                                        @else
                                            <td><p onclick='location.href="/panel/user/chat/{{$chat->id}}"' style="cursor: pointer;" class="m-0"><b>{{$chat->full_name}}</b></p>
                                                @endif

                                                @if(!empty($chat->message))
                                                    <p class="m-0">{{$chat->time}}</p>
                                                    <p class="m-0">{{substr($chat->message,0,50).'...'}}</p>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width:10%;">
                                                <button onclick='location.href="/panel/user/chat/{{$chat->id}}"' class="btn_green btn_submit"><img src="/public/img/admin/ico_msg.png" alt="" style="width:0.6875rem;height:0.6875rem;"></button>
                                                <button onclick="delete_chat({{$chat->id}})" href="#delete_chat" class="btn_gray btn_submit">
                                                    <img src="/public/img/admin/ico_delete.png" alt="" style="width:0.6875rem;height:0.6875rem;"></button>
                                            </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal_start_new_chat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div style="border-bottom: none!important;background-color: #f7f7f7;" class="modal-header RalewaySemiBold">
                                <h4 style="font-size: 1.125rem;" class="modal-title" id="myModalLabel">Start new Chat with...</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding:0!important;">
                                @if($have_new_chats==1)
                                    <table class="table" style="font-size:1.125rem;">
                                        <tbody>
                                        @foreach($new_chats as $admin)
                                            <tr style="border-top: 0.0625rem solid #e5e5e5;">
                                                <td class="text-center" style="width:7%;"><span id="span_new_id_{{$admin->users_id}}" data-startchat="{{$admin->short_name}}"></span></td>
                                                <td><p style="margin:0;"><b>{{$admin->full_name}}</b></p>
                                                    <p style="margin:0;font-size: 1rem;color: #787878;">{{$admin->type_role}}</p>
                                                </td>
                                                <td class="text-center" style="width:15%;">
                                                    <button onclick="create_chat('{{$admin->users_id}}','{{$admin->type_acc}}')" class="btn_page btn btn_submit" style="width:12.5rem;height:2.1875rem;">Start Chat</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-center" style="margin:10px;font-size: 1.4rem;color: #787878;">Available users/admins does not exists!</p>
                                    {{--<p>Available admins does not exists!</p>--}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection
@section('script')
    @include('template.script_user_template')
    <script src="/public/js/jquery.sweet-modal.js"></script>

    <script>
        @if (session('status'))
        sweet_modal('{{(session('status'))}}','warning',3000);
                @endif
        var token = '{{$token}}';
        $(document).ready(function () {
            $(".header_text").html('Messages');
        });

        function delete_chat(chat_id) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url: "/api/panel/admin/chat/delete",
                    type: "POST",
                    data: {
                        token: token,
                        chat_id: chat_id
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data);
                        if (data.success == true) {
                            sweet_modal('Success', 'success', 1000);
                            setTimeout(function () {
                                window.location = '/panel/user/messages';
                            }, 1000);
                        } else {
                            sweet_modal(data.message, 'error', 3000);
                        }
                        $(".btn_submit").removeAttr('disabled');
                    }, error: function (data) {
                        console.log(data);
                        sweet_modal('Something went wrong', 'error', 3000);
                        $(".btn_submit").removeAttr('disabled');
                    }
                })
            });
        }

        function create_chat(users_id_s,type_acc) {
            $.ajax({
                url:"/api/panel/admin/chat/create",
                type:"POST",
                data:{
                    token:token,
                    users_id_s:users_id_s,
                    type_acc:type_acc
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    $('button.close').click();
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/user/messages';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',3000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    $('button.close').click();
                    console.log(data);
                    sweet_modal('Something went wrong','error',3000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }
        function sweet_modal(text,type,time) {
            $.sweetModal({
                content: text,
                icon: type,
                timeout:time
            });
        }

        function search_query(word,response) {
            $.ajax({
                url: "/api/admin/chat/search",
                type:"POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                data: {
                    token:token,
                    text:word
                },
                success: function (data) {
                    console.log(data);
                    response(data.items);
                },error:function (data) {
                    console.log(data);
                }
            });
        }
        $( function() {

            $( "input[name='search']" ).autocomplete({
                minLength: 1,
                source: function( request, response ) {
                    search_query(request.term,response);
                },
                focus: function( event, ui ) {
                    return false;
                },
                select: function( event, ui ) {
                    window.location = '/panel/user/chat/'+ui.item.id;
                    console.log(ui);
                    return false;
                }
            })
        } );
    </script>
@endsection