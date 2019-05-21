@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
@endsection
@section('content')
    @include('admin.header')
<div class="app-body">
    @include('admin.sidebar')
    <main class="main">
        <div class="container-fluid main_container_fluid">
            <div class="card box-shadow">
                <table class="table" style="font-size:1.125rem;">
                    <tbody>
                    @foreach($notifications as $notification)
                        <tr style="border-bottom: 0.0625rem solid #e5e5e5;">
                            <td class="text-center" style="width:7%;">
                                <img class="img-circle" src="/public/img/admin/ico_notif.png" alt="" style="width:3.125rem;height:3.125rem;">
                            </td>
                            <td>
                                <p class="m-0"><b>{{$notification->title}}:</b> <a style="color: #333" href="{{$notification->src}}">{{$notification->message}}</a></p>
                            </td>
                            <td>
                                <p class="m-0" style="color:#b8b8b8;">{{$notification->time}}</p>
                            </td>
                            @if($admin_role == 'super_admin')
                                <td class="text-center">
                                    <button onclick="delete_notification('{{$notification->id}}')" class="btn_gray">
                                        <img src="/public/img/admin/ico_delete.png" alt=""></button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

@endsection
@section('script')
    @include('template.script_admin_template')
    <script>
        $(document).ready(function () {
            $(".header_text").html('Notifications');
        });

        function delete_notification(id) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url: "/api/admin/notification/delete",
                    type: "POST",
                    data: {
                        notification_id: id,
                        token: '{{\App\Model\Sessions::get_token()}}'
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        '_token': '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data);
                        if (data.success == true) {
                            sweet_modal('Success', 'success', 1000);
                            setTimeout(function () {
                                window.location = '/panel/admin/notifications';
                            }, 1000);
                        } else {
                            sweet_modal(data.message, 'error', 1000);
                        }
                        $(".btn_submit").removeAttr('disabled');
                    }, error: function (data) {
                        console.log(data);
                        sweet_modal('Something went wrong', 'error', 1000);
                        $(".btn_submit").removeAttr('disabled');
                    }
                })
            })
        }
    </script>
@endsection