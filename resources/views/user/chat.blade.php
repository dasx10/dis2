@extends('layout.user')
@section('head')
    @include('template.head_user_template')

    {{--<link href="/public/js/emoji/css/emoji.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="/public/css/emojionearea.min.css">
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
        .emojionearea.emojionearea-inline>.emojionearea-editor{
            overflow: auto!important;
            word-break: break-all;
            white-space: normal!important;
        }
        .text_wrapper {
            border: 1px solid #ccc;
        }
        .text {
            outline: none;
            min-height:34px;
        }
    </style>
@endsection
@section('content')
    @include('user.header')
    <div class="app-body">
        @include('user.sidebar')
        <main class="main">
            <div class="container-fluid main_container_fluid">
                <div class="card box-shadow">
                    <div class="card-header" style="padding-top: 0.625rem;padding-bottom: 0.9375rem;padding-right: 0.625rem;padding-left: 1.25rem;border-radius: 0">
                        <h5 class="d-flex align-items-center" style="margin-bottom: 0;padding-top: 0.625rem;font-size: 1.125rem;">
                            <div class="row" style="width: 100%;">
                                <div class="col-10 d-flex align-items-center"><button onclick='location.href="/panel/admin/messages"' class="btn_back d-flex align-items-center"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button>
                                    <a href="/panel/user/messages" style="color:#4c6897;">All messages</a> <span style="padding-right:5px;padding-left:5px;">|</span> <span>Chat</span></div>
                                <div class="col-2">
                                    <button class="btn delete-msg d-none btn-delete btn_submit" onclick="remove_messages()"> Delete </button>
                                    <button class="btn_orange edit-msg" style="padding: 0.5rem 0.6rem;float:right;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button>
                                    <button class="btn btn-success save_message d-none" style="width: 5.5rem;height: 1.875rem;padding:0;float:right;">Save</button>
                                </div>
                            </div>
                        </h5>
                    </div>
                    <div class="card-block chat-box" id="chat-box" style="padding:15px!important;overflow-x: hidden;">
                        @foreach($messages as $message)
                            @if($message->users_to==$admin_id)
                                @if($message->type_message=='text')
                                    <div class="row form-group message_id" data-id="{{$message->id}}">
                                        <div class="col-1 d-flex justify-content-center align-items-center question">
                                            {{--<img class="img-circle" src="/public/img/admin/img_message.png" alt="" style="width:4.125rem;height:4.125rem;">--}}
                                            <span class="chat_hide" data-chat="{{$message->short_name}}"></span>
                                        </div>
                                        <div class="col-9 chat-text">
                                            <div class="card-block-msg">
                                                <p class="m-0" style="font-size: 1.25rem;"><b>{{$message->full_name}}</b></p>
                                                <p class="m-0" style="font-size: 1rem;color: #787878;">{{$message->time}}</p>
                                                <p class="m-0" style="font-size: 1rem;">{{$message->message}}</p>
                                            </div>
                                        </div>
                                        <div class="col-2-new d-flex justify-content-center align-items-center">
                                            <label class="delete_input m-0 d-none">
                                                <input type="checkbox" hidden class="select_input" data-message-id="{{$message->id}}" onclick="check_message(this)">
                                                <span class="span_selected"></span>
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="row form-group message_id" data-id="{{$message->id}}">
                                        <div class="col-1 d-flex justify-content-center align-items-center question">
                                            {{--<img class="img-circle" src="/public/img/admin/img_message.png" alt="" style="width:4.125rem;height:4.125rem;">--}}
                                            <span class="chat_hide" data-chat="{{$message->short_name}}"></span>
                                        </div>
                                        <div class="col-9 chat-text">
                                            <div class="card-block-msg">
                                                <p class="m-0" style="font-size: 1.25rem;"><b>{{$message->full_name}}</b></p>
                                                <p class="m-0" style="font-size: 1rem;color: #787878;">{{$message->time}}</p>
                                                <p class="m-0"><strong><a href="{{$message->message}}"><i class="fas fa-cloud-download-alt"></i></a><span>File: {{$message->message}}</span></strong></p>
                                            </div>
                                        </div>
                                        <div class="col-2-new d-flex justify-content-center align-items-center">
                                            <label class="delete_input m-0 d-none">
                                                <input type="checkbox" hidden class="select_input" data-message-id="{{$message->id}}" onclick="check_message(this)">
                                                <span class="span_selected"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @else
                                @if($message->type_message=='text')
                                    <div class="row d-flex flex-row-reverse form-group message_id" data-id="{{$message->id}}">
                                        <div class="col-1 d-flex justify-content-center align-items-center answer">
                                            <span class="chat_hide">{{$message->time}}</span>
                                        </div>
                                        <div class="col-9 chat-text">
                                            <div class="card-block-msg">
                                                <p class="m-0 chat_visible" style="font-size: 1rem;color: #787878;">{{$message->time}}</p>
                                                <p class="m-0" style="font-size: 1rem;">{{htmlspecialchars_decode($message->message)}}</p>
                                            </div>
                                        </div>
                                        <div class="col-2-new d-flex justify-content-center align-items-center">
                                            <label class="delete_input m-0 d-none">
                                                <input type="checkbox" hidden class="select_input" data-message-id="{{$message->id}}" onclick="check_message(this)">
                                                <span class="span_selected"></span>
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="row d-flex flex-row-reverse form-group message_id" data-id="{{$message->id}}">
                                        <div class="col-1 d-flex justify-content-center align-items-center answer">
                                            <span class="chat_hide">{{$message->time}}</span>
                                        </div>
                                        <div class="col-9 chat-text">
                                            <div class="card-block-msg">
                                                <p class="m-0 chat_visible" style="font-size: 1rem;color: #787878;">{{$message->time}}</p>
                                                <p class="m-0"><strong><a href="{{$message->message}}"><i class="fas fa-cloud-download-alt"></i></a><span>File: {{str_replace('http://dis.yobibyte.in.ua/public/chat_files/','',$message->message)}}</span></strong></p>
                                            </div>
                                        </div>
                                        <div class="col-2-new d-flex justify-content-center align-items-center">
                                            <label class="delete_input m-0 d-none">
                                                <input type="checkbox" hidden class="select_input" data-message-id="{{$message->id}}" onclick="check_message(this)">
                                                <span class="span_selected"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="row card-block panel-footer" style="background: #e4e8f0;margin-right: 0px;margin-left: 0px;bottom:0;width:100%;">
                        <div class="col-11 col-11-chat p-0">
                            <div  onresize="" id="emojionearea2"></div>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center" style="padding-right: 0;padding-left: 7px;">
                            <input onchange="upload_file(this)" type="file" name="chat-file[]" id="chat-file" style="width: 0.1px;height: 0.1px;opacity: 0;overflow: hidden;position: absolute;z-index: -1;">
                            <label class="mb-0" for="chat-file"><img src="/public/img/admin/ico_skrepka.png" alt="" style="cursor: pointer;width: 0.875rem;height: 2.3125rem;"></label>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('script')
    @include('template.script_user_template')
    {{--<script src="/public/js/emoji/js/config.js"></script>--}}
    {{--<script src="/public/js/emoji/js/util.js"></script>--}}
    {{--<script src="/public/js/emoji/js/jquery.emojiarea.js"></script>--}}
    {{--<script src="/public/js/emoji/js/emoji-picker.js"></script>--}}
    <script src="/public/js/emojionearea.min.js"></script>
    <script>

        var array_ids_to_delete = [];

        function remove_messages() {
            $.ajax({
                url:"/api/admin/chat/delete_messages",
                type:"POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                data:{
                    token:token,
                    array_ids_to_delete:array_ids_to_delete
                },
                dataType: 'JSON',
                success:function (data) {
//                    console.log(data);
                },error:function (data) {
//                    console.log(data);
                }
            })
        }

        function append_to_array_ids(val) {
            var medium_array_ids_to_delete = [];
            if(array_ids_to_delete.indexOf( val ) != -1){
                for(var k in array_ids_to_delete){
                    if(array_ids_to_delete[k] != val){
                        medium_array_ids_to_delete.push(array_ids_to_delete[k]);
                    }
                }
                array_ids_to_delete = medium_array_ids_to_delete;
            }else{
                array_ids_to_delete.push(val);
            }
        }


        function check_message(btn) {
            if($(btn).prop('checked')){
                $(btn).parent().parent().parent().find('.chat-text').addClass('chat-text-active');
                $('.save_message').addClass('d-none');
            }else{
                $(btn).parent().parent().parent().find('.chat-text').removeClass('chat-text-active');
            }
            append_to_array_ids($(btn).attr('data-message-id'));
            var texts = $('.chat-text-active');
            $('.delete-msg').toggleClass('d-none', texts.length == 0);
            $('.save_message').toggleClass('d-block', texts.length == 0);

        }

        $( ".delete-msg" ).click(function() {
            $('.chat-text-active').parents(".message_id").remove();
            if($('.chat-text-active').parents(".message_id").remove()){
                $( ".delete-msg" ).addClass('d-none');
                $('.save_message').removeClass('d-none');
            }
        });
        $( ".edit-msg" ).click(function() {
            $('.delete_input').removeClass('d-none');
            $('.edit-msg').addClass('d-none');
            $('.save_message').removeClass('d-none');
        });
        $( ".save_message" ).click(function() {
            $('.delete_input').addClass('d-none');
            $('.edit-msg').removeClass('d-none');
            $('.save_message').addClass('d-none');
            $('.save_message').removeClass('d-block');
        });


        var chat_id = '{{$messages->chat_id}}';
        var admin_from = '{{$messages->users_from}}';
        var admin_to = '{{$messages->users_to}}';
        var token = '{{$token}}';
        setTimeout(function () {
            var objDiv = document.getElementById("chat-box");
            objDiv.scrollTop = objDiv.scrollHeight;
        },500);


        @if($exists==0)
        setTimeout(function () {
            $('.emojionearea-editor').html('Your conversation partner left the chat!');
        },300);
        $('.panel-footer').css('pointer-events','none');
        @endif

        function sweet_modal(text,type,time) {
            $.sweetModal({
                content: text,
                icon: type,
                timeout:time
            });
        }
        @if($exists!=0)
        setInterval(function () {
            get_message();
        },5000);
        @endif
        @if($exists!=0)
        setInterval(function () {
            resize_chat_block();
            //            var objDiv = document.getElementById("chat-box");
            //            objDiv.scrollTop = objDiv.scrollHeight;
        },300);
        @endif


        function upload_file(input) {
            var file = $(input)[0].files[0];
            var formData = new FormData();

            formData.append("file", file);
            formData.append("token", token);
            formData.append("chat_room_id", chat_id);
            formData.append("users_from", admin_from);
            formData.append("users_to", admin_to);
            formData.append("type_message", 'file');
            $.ajax({
                url:"/api/admin/chat/send_message",
                type:"POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                data:formData,
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success:function (data) {
//                    console.log(data);
                    if(data.success==true){
                        append_messgae('file', data);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    var objDiv = document.getElementById("chat-box");
                    objDiv.scrollTop = objDiv.scrollHeight;
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
//                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }
        function get_message() {
            var last_message = 0;
            var message_length = $('.message_id').length;
            if(message_length!=0){
                var div = $('.message_id')[message_length-1];
                last_message = $(div).attr('data-id');
                $.ajax({
                    url:"/api/admin/chat/get_messages",
                    type:"POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        '_token': '{{ csrf_token() }}'
                    },
                    data:{
                        last_message:last_message,
                        chat_room_id:chat_id
                    },
                    dataType: 'JSON',
                    success:function (data) {
                        console.log(data);
                        if(data.success==true){
                            if(data.messages){
                                for(var k in data.messages){
                                    var out = '';
                                    switch (data.messages[k].type_message){
                                        case 'text':
                                            out = '<div class="row form-group message_id" data-id="'+data.messages[k].id+'">\n' +
                                                '                        <div class="col-1 d-flex justify-content-center align-items-center question">\n' +
                                                '                            <span class="chat_hide" data-chat="'+data.ii+'"></span>\n' +
                                                '                        </div>\n' +
                                                '                        <div class="col-9 chat-text" onmousedown="isKeyPressed(event,this)">\n' +
                                                '                            <div class="card-block-msg">\n' +
                                                '                            <p class="m-0" style="font-size: 1.25rem;"><b>'+data.name+'</b></p>\n' +
                                                '                            <p class="m-0" style="font-size: 1rem;color: #787878;">'+data.messages[k].time+'</p>\n' +
                                                '                            <p class="m-0" style="font-size: 1rem;">'+data.messages[k].message+'</p>\n' +
                                                '                            </div>\n' +
                                                '                        <div class="col-2-new d-flex justify-content-center align-items-center">\n' +
                                                '                            <label class="delete_input m-0 d-none">\n' +
                                                '                            <input type="checkbox" hidden class="select_input" data-message-id="'+data.messages[k].id+'" onclick="check_message(this)">\n' +
                                                '                            <span class="span_selected"></span>\n' +
                                                '                            </label>\n' +
                                                '                        </div>\n' +
                                                '                        </div>\n' +
                                                '                    </div>';
                                            $(".chat-box").append(out);
                                            break;

                                        case '':

                                            break;
                                    }
                                    var objDiv = document.getElementById("chat-box");
                                    objDiv.scrollTop = objDiv.scrollHeight;
                                }
                            }
                        }
                        $(".btn_submit").removeAttr('disabled');
                    },error:function (data) {
//                        console.log(data);
                    }
                })
            }
        }

        function ajax_send_message(text,type_message) {
            $.ajax({
                url:"/api/admin/chat/send_message",
                type:"POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                data:{
                    token:token,
                    chat_room_id:chat_id,
                    users_from:admin_from,
                    users_to:admin_to,
                    message:text,
                    type_message:'text'
                },
                dataType: 'JSON',
                success:function (data) {
//                    console.log(data);
                    if(data.success==true){
                        var out = '';
                        append_messgae('text',data);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    var objDiv = document.getElementById("chat-box");
                    objDiv.scrollTop = objDiv.scrollHeight;
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
//                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }

        function append_messgae(type_message,data) {
            switch (type_message){
                case 'text':
                    var out = '<div class="row d-flex flex-row-reverse form-group message_id" data-id="'+data.message_id+'">\n' +
                        '                                    <div class="col-1 d-flex justify-content-center align-items-center answer">\n' +
                        '                                        <span class="chat_hide">'+data.time+'</span>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="col-9 chat-text" onmousedown="isKeyPressed(event,this)">\n' +
                        '                                        <div class="card-block-msg">\n' +
                        '                                            <p class="m-0 chat_visible" style="font-size: 1rem;color: #787878;">'+data.time+'</p>\n' +
                        '                                            <p class="m-0" style="font-size: 1rem;">'+data.message+'</p>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="col-2-new d-flex justify-content-center align-items-center">\n' +
                        '                                       <label class="delete_input m-0 d-none">\n' +
                        '                                       <input type="checkbox" hidden class="select_input" data-message-id="'+data.message_id+'" onclick="check_message(this)">\n' +
                        '                                       <span class="span_selected"></span>\n' +
                        '                                       </label>\n' +
                        '                                    </div>\n' +
                        '                                </div>';
                    $(".chat-box").append(out);
                    break;

                case 'file':
                    var message = data.message;
                    var out = '<div class="row d-flex flex-row-reverse form-group message_id" data-id="'+data.message_id+'">\n' +
                        '                                    <div class="col-1 d-flex justify-content-center align-items-center answer">\n' +
                        '                                        <span class="chat_hide">'+data.time+'</span>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="col-9 chat-text" onmousedown="isKeyPressed(event,this)">\n' +
                        '                                        <div class="card-block-msg">\n' +
                        '                                            <p class="m-0 chat_visible" style="font-size: 1rem;color: #787878;">'+data.time+'</p>\n' +
                        '                                            <p class="m-0"><strong><a href="'+message+'"><i class="fas fa-cloud-download-alt"></i></a><span>File: '+message.replace('http://dis.yobibyte.in.ua/public/chat_files/','')+'</span></strong></p>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="col-2-new d-flex justify-content-center align-items-center">\n' +
                        '                                      <label class="delete_input m-0 d-none">\n' +
                        '                                      <input type="checkbox" hidden class="select_input" data-message-id="'+data.message_id+'" onclick="check_message(this)">\n' +
                        '                                      <span class="span_selected"></span>\n' +
                        '                                      </label>\n' +
                        '                                    </div>\n' +
                        '                                </div>';
                    $(".chat-box").append(out);
                    break;
            }
        }
        function send_message(e,event) {
            @if($exists!=0)
            event.preventDefault();
            if (event.which == 13) {
                if(event.shiftKey){
                    //                    alert('You pressed enter+shift!');
                    //                    $(e).height($(e).height()+20);
                }else {
                    event.preventDefault();
                    var text = $(e).text();
                    var full_text = $(e).html();
                    if(text!='') {
                        //                        alert('You pressed enter!');
                        $(e).html('');
                        ajax_send_message(full_text,'text');
                        //                        $(e).height('3rem');
                    }
                }
            }
            //            if(event.which == 46 || event.which == 8){
            //                var height = $(e).height();
            //                if(height>30.3125){
            //                    $(e).height($(e).height()-20);
            //                }
            //            }
            @endif
        }
        $(document).ready(function () {
            resize_chat_block();
        });
        $(window).resize(function() {
            resize_chat_block();
        });

        function resize_chat_block() {
            var myHeight = document.documentElement.clientHeight;
            var head = $(".app-header").height();
            var card_header = $('.card-header').height();
            var footer = $('.panel-footer').height();
            var block_height = myHeight - head - footer - card_header -70;
//            console.log(footer);
            $('.chat-box').css('height',block_height+'px');
        }
        // $('.panel-footer').resize(function () {
        //     alert(1);
        // })
        $(document).ready(function () {
            $("#emojionearea2").emojioneArea({
                pickerPosition: "top",
                tonesStyle: "radio"
            });
            $(".header_text").html('Messages');
//            console.log($('.emoji-wysiwyg-editor'));
        });
        $('.check_space').blur(function(){
            $(this).val($.trim($(this).val()));
        });
    </script>
@endsection