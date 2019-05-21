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
                <div class="card-header" style="padding-top: 0.9375rem;padding-bottom: 0.9375rem;border-radius: 0">
                    <h5 class="d-flex align-items-center" style="margin-bottom: 0;font-size: 1.125rem;">ADMINS<button onclick='location.href="/panel/admin/admins/add"' class="btn_blue d-flex align-items-center"><img src="/public/img/admin/ico_plus.png" alt="" style="width:0.9375rem;height:0.9375rem;"></button></h5>
                </div>
                <div class="card-block">
                    <div class="table-responsive-md">
                    <table class="table table-striped" style="font-size:1.125rem;" id="table_adm">
                        <thead>
                        {{--<th data-orderable="false" class="text-center RalewayMedium" style="width:3%;cursor:default;">#</th>--}}
                        <th class="RalewaySemiBold" style="width:20%;cursor:pointer;">Name</th>
                        <th class="RalewaySemiBold" style="width:20%;cursor:pointer;">Email</th>
                        <th class="text-center RalewaySemiBold" style="width:25%;cursor:pointer;">Role</th>
                        <th data-orderable="false" class="text-center RalewaySemiBold" style="width:20%;cursor:default;">Action</th>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                {{--<td class="text-center RalewayRegular">{{$i}}</td>--}}
                                <td class="RalewayMedium" style="text-transform: capitalize">{{$admin->name}}</td>
                                <td class="width_td RalewayRegular" style="text-decoration:underline;color: #4c6897;">{{$admin->email}}</td>
                                <td class="text-center RalewayRegular"><?php if($admin->type=='OPM'){echo 'Operation manager';}else{echo $admin->type;}?></td>
                                <td class="text-center">
                                    <button onclick='location.href="/panel/admin/admins/edit/{{$admin->id}}"' class="btn_orange fix-btn-table"><img src="/public/img/admin/ico_edit.png" alt=""></button>
                                    <button onclick="delete_admin('{{$admin->id}}','{{$token}}')" class="btn_gray">
                                        <img src="/public/img/admin/ico_delete.png" alt="" ></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_adm').DataTable({
                "aaSorting": [[1,'asc']],
                "language": {
                    "zeroRecords": "There are no products to list",
                    "paginate": {
                        "next": ">",
                        "previous": "<"
                    }
                },
                "lengthMenu": [15],
                "pagingType": "simple_numbers"
            });
        } );

        function delete_admin(id,token) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url:"/api/admin/delete",
                    type:"POST",
                    data:{'admins_id':id,'token':token},
                    dataType: 'JSON',
                    success:function (data) {
                        console.log(data);
                        if(data.success==true) {
                            sweet_modal('Success!','success',1000);
                            setTimeout(function () {
                                window.location = '/panel/admin/admins';
                            },1000);
                        }else{
                            sweet_modal(data.message,'error',2000);
                        }
                    },error:function(data){
                        console.log(data);
                        sweet_modal('Something went wrong','error',1000);
                    }

                })
            });
        }
        function sweet_modal(text,type,time) {
            $.sweetModal({
                content: text,
                icon: type,
                timeout:time
            });
        }
        $(document).ready(function () {
            $(".header_text").html('Admins');
        });
    </script>
@endsection