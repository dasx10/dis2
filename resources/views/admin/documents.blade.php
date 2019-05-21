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
                <div class="card-header " style="padding-top: 0.9375rem;padding-bottom: 0.9375rem;padding-right: 0.625rem;padding-left: 1.25rem;">
                    <h5 class="d-flex align-items-center" style="margin-bottom: 0;font-size:1.125rem;">DOCUMENTS
                        @if(!in_array($admin_role,['finance','opm']))
                            <button onclick="set_name()" data-toggle="modal" data-target="#myModal_documents" class="btn_blue d-flex align-items-center"><img src="/public/img/admin/ico_plus.png" alt="" style="width:0.9375rem;height:0.9375rem;"></button>
                        @endif
                    </h5>
                </div>
                <div class="card-block">
                    <div class="table-responsive-lg">
                    <table class="table table-striped" style="font-size:1.125rem;" id="table_document_adm">
                        <thead>
                        {{--<th data-orderable="false" class="text-center RalewayMedium" style="width:3%;cursor:pointer;">#</th>--}}
                        <th class="RalewaySemiBold" style="cursor:pointer;">Title</th>
                        <th class="RalewaySemiBold" style="cursor:pointer;">Last modified by</th>
                        <th class="text-center RalewaySemiBold" style="cursor:pointer;">Date</th>
                        <th class="text-center RalewaySemiBold" style="cursor:pointer;">Category</th>
                        <th data-orderable="false" class="text-center RalewaySemiBold" style="cursor: default;">Action</th>
                        </thead>
                        <tbody class="all_items">
                        @foreach($documents as $document)
                            <tr class="item item{{$document->admins_documents_id}}">
                                {{--<td class="text-center RalewayRegular itemid">{{$i}}</td>--}}
                                <td class="RalewayMedium">{{$document->title}}</td>
                                <td class="RalewayRegular "><span class="itememail{{$document->admins_documents_id}}" style="color:#4c6897;text-decoration:underline;">{{$document->email}}</span></td>
                                <td class="text-center RalewayRegular itemdate{{$document->admins_documents_id}}">{{date('j M Y',strtotime($document->updated_at))}}</td>
                                <td class="text-center RalewayRegular">{{$document->category}}</td>
                                <td class="text-center">
                                    <button onclick="edit_modal({{$document->admins_documents_id}})" class="btn_orange fix-btn-table" style="padding:6px;" data-toggle="modal" data-target="#myModal_documents_edit"><img src="/public/img/admin/ico_reload.png" alt="" style="width: 16px;height: 14px;"></button>
                                    <button onclick="download(this)" href="{{$document->url}}"  class="btn_green fix-btn-table itemlink{{$document->admins_documents_id}}" ><img src="/public/img/admin/ico_download.png" alt="" ></button>
                                    @if($admin_role=='super_admin' || $admin_role=='admin')
                                    <button onclick="delete_document('{{$document->admins_documents_id}}')" class="btn_gray">
                                        <img src="/public/img/admin/ico_delete.png" alt=""></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal_documents" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">UPLOAD NEW DOCUMENT</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form name="upload" class="create">
                    <div class="modal-body">
                        <div class="form-group" style="display: flex;">
                            <span class="ico_input"><img src="/public/img/admin/doc.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;margin-top: 0.8375rem;width: 1.4375rem;height: 1.5625rem;"></span>
                            <input maxlength="35" type="text" name="title" class="form-control addon check_space check_letter" placeholder="Document Title" required>
                        </div>
                        <div class="form-group" style="display: flex;cursor: pointer;">
                            <div style="width: 2.875rem;height: 3.6875rem;" class="ico_input"><img style="margin-top: 1.5rem;width: 1.4375rem;height: 0.5625rem;margin-right: 0.55rem;margin-left: 0.6125rem;" src="/public/img/admin/PDF.png" alt=""></div>
                            <input accept="application/pdf" type="file" name="myfile"  class="inputfile inputfile-6" required data-multiple-caption="{count} files selected">
                            <label  class="form-control addon" style="margin-bottom:0px;    width: 84%;">
                                <span style="font-size:1.125rem;width: 100%;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach file (PDF only!)</span>
                            </label>
                            <div class="d-flex align-items-center" style="border:0.125rem solid #aab4bc;border-radius: 0.25rem;margin-left: 0.375rem;background: #f2f2f2;cursor:pointer;"><strong style="width: 3.6rem;height: 3.44rem;color: black;text-align: center;font-size: 1.75rem;">...</strong></div>
                        </div>
                        <div class="form-group">
                            <span class="ico_input"><img src="/public/img/admin/category.png" alt="" style="margin-right: 0.55rem;margin-left: 0.6125rem;margin-top: 1.25rem;width: 1.375rem;height: 0.9375rem;"></span>
                            <div class="styled-select">
                                <div class="dropdown" style="width:100%;">
                                    <button style="display: flex" class="form-control dropdown-toggle dropdown-edit addon category_doc" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Category
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-edit" aria-labelledby="dropdownMenuButton">
                                        @foreach($categories as $category)
                                            <div class="name_category required_category" style="position: relative"><a onclick="category_name_doc(this)" class="dropdown-item" href="#">{{$category->name}}</a></div>
                                        @endforeach
                                        {{--<div class="name_category required_category" style="position: relative"><a onclick="category_name_doc(this)" class="dropdown-item" href="#">Marketing</a></div>--}}
                                        {{--<div class="name_category required_category" style="position: relative"><a onclick="category_name_doc(this)" class="dropdown-item" href="#">Customer Support</a></div>--}}
                                        <div class="name_category other_category" style="position: relative"><a onclick="category_name_doc(this)" class="dropdown-item" href="#">Other</a></div>
                                    </div>
                                </div>
                                {{--<select name="category" onchange="category_test(this)" class="form-control addon" required>--}}
                                    {{--<option disabled selected value="">Select Category</option>--}}
                                    {{--<option value="Sales">Sales</option>--}}
                                    {{--<option value="Marketing">Marketing</option>--}}
                                    {{--<option value="Customer Support">Customer Support</option>--}}
                                    {{--<option value="Other">Other</option>--}}
                                {{--</select>--}}
                            </div>
                        </div>
                        <div class="form-group d-none" id="other_category">
                            <span class="ico_input"><img src="/public/img/admin/doc.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;margin-top: 0.8375rem;width: 1.4375rem;height: 1.5625rem;"></span>
                            <input maxlength="25" name="category_name" type="text"  class="form-control addon check_space check_letter input_other_category" placeholder="Name Category" required>
                        </div>
                    </div>
                        <input type="hidden" name="token" value="{{$token}}">
                    <div class="modal-footer justify-content-center">
                        <input type="submit" class="btn_page " value="Upload">
                        <button type="button" class="btn_page_orange" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal_documents_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel2">UPDATE DOCUMENT</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="re-upload">
                        <div class="modal-body">
                            <div class="form-group" style="display: flex;cursor: pointer;">
                                <div style="width: 2.875rem;height: 3.6875rem;" class="ico_input"><img style="margin-top: 1.5rem;width: 1.4375rem;height: 0.5625rem;margin-right: 0.55rem;margin-left: 0.6125rem;" src="/public/img/admin/PDF.png" alt=""></div>
                                <input accept="application/pdf" type="file" name="myfileedit"  class="inputfile inputfile-6" required data-multiple-caption="{count} files selected">
                                <label  class="form-control addon" style="margin-bottom:0px;width: 84%;">
                                    <span style="font-size:1.125rem;width: 100%;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach file (PDF only!)</span>
                                </label>
                                <div class="d-flex align-items-center" style="border:0.125rem solid #aab4bc;border-radius: 0.25rem;margin-left: 0.375rem;background: #f2f2f2;cursor:pointer;"><strong style="width: 3.6rem;height: 3.44rem;color: black;text-align: center;font-size: 1.75rem;">...</strong></div>
                            </div>
                        </div>
                        <input type="hidden" name="token_edit" value="{{$token}}">
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page btn_submit" value="Update">
                            <button type="button" class="btn_page_orange" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" id="modal_documents_progress" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center body_progress" style="padding: 15px!important">

                    </div>
                </div>
            </div>
            <button type="button" class="btn_page_orange" data-dismiss="modal" style="display: none">Cancel</button>
        </div>
    </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function category_name_doc(a) {
            $('input[name="category"]').val($(a).html());
            $('.category_doc').html($(a).html());
        }
        $( ".other_category" ).click(function() {
            $( "#other_category" ).removeClass('d-none');
            $('input[name="category_name"]').attr('required','required');
        });
        $( ".required_category" ).click(function() {
            $( "#other_category" ).addClass('d-none');
            $(".input_other_category").val('')
            $('input[name="category_name"]').removeAttr('required');
        });
        // function category_test(select) {
        //     var value =  $(select).val();
        //     switch (value){
        //         case 'Other':
        //            alert('1');
        //         break;
        //         default:
        //             break;
        //     }
        // }
        $(document).ready(function() {
            $('#table_document_adm').DataTable({
                responsive: true,
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
        function set_name() {
            $('input[name="title"]').val('');
            $('form.create').attr('novalidate','novalidate');
        }

        function downloadURI(uri) {
            var link = document.createElement("a");
//                  link.download = name;
            link.href = uri;
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            console.log(link);
            document.body.removeChild(link);
            delete link;
        }

        function download(btn) {
            downloadURI($(btn).attr('href'));
        }
        $(document).ready(function () {
            $(".header_text").html('Documents');
        });
        var edit_id_doc;
        function edit_modal(id) {
            edit_id_doc = id;
            $("#myModal_documents_edit").modal();
        }

        $('form.re-upload').on('submit',function(e){
            e.preventDefault();
            var input = $('input[name="myfileedit"]');
            var file = input.prop('files')[0];
            console.log(file);
            if (file) {
                reupload(file);
            }
            return false;
        });

        function reupload(file){
            var token = $('input[name="token_edit"]').val();
            var fd = new FormData();
            fd.append("afile", file);
            fd.append("token", token);
            fd.append("documents_id", edit_id_doc);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/admin/reupload_file', true);

            xhr.upload.onprogress = function(e) {
                $(".body_progress").html((event.loaded/1000000).toFixed(3) + 'mb / ' + (event.total/1000000).toFixed(3)+' mb');
            };
            xhr.onload = function() {
                console.log(this.response);
                var resp = JSON.parse(this.response);
                console.log(resp);
                if (resp.success == true) {
                    $(".btn_page_orange").click();
                    sweet_modal('Success','success',1000);
                    setTimeout(function () {
                        window.location = '/panel/admin/documents';
                    },1000);
//                    $('.itememail'+edit_id_doc).html(resp.last_email);
//                    $('.itemdate'+edit_id_doc).html(resp.date);
//                    $('.itemlink'+edit_id_doc).attr('href',resp.filename);
                }else{
                    $(".btn_page_orange").click();
                    sweet_modal(resp.message,'error',2000);
                    console.log("error " + this.status);
                }
            };
            xhr.send(fd);
            $(".btn_page_orange").click();
//            $("#modal_documents_progress").modal();
        }


        function delete_document(id) {
            var token = $('input[name="token_edit"]').val();
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url:"/api/admin/delete/documents",
                    type:"POST",
                    data:{'documents_id':id,'token':token},
                    dataType: 'JSON',
                    success:function (data) {
                        console.log(data);
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/documents';
                        },1000);
//                        $('.item'+id).remove();
                        update_item_id();
                    },error:function(data){
                        console.log(data);
                        sweet_modal('Something went wrong','error',1000);
                    }

                })
            });
        }
        $('form.create').on('submit',function(e){
            $('form.create').removeAttr('novalidate');
            e.preventDefault();
            var input = $('input[name="myfile"]');
            var file = input.prop('files')[0];
//            console.log(file);
            if (file) {
                upload(file);
            }
            return false;
        });
        function upload(file) {
            var fd = new FormData();
            fd.append("afile", file);
            fd.append("token", $('input[name="token"]').val());
            fd.append("title", $('input[name="title"]').val());
            fd.append("category", $('select[name="category"]').val());
            fd.append("category_name", $('input[name="category_name"]').val());

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/admin/upload_file', true);

            xhr.upload.onprogress = function(e) {
                $(".body_progress").html((event.loaded/1000000).toFixed(3) + 'mb / ' + (event.total/1000000).toFixed(3)+' mb');
            };
            xhr.onload = function() {
                console.log(this.response);
                var resp = JSON.parse(this.response);
                console.log(resp);
                if (resp.success == true) {
                    $(".btn_page_orange").click();
                    sweet_modal('Success','success',1000);
                    setTimeout(function () {
                        window.location = '/panel/admin/documents';
                    },1000);
//                    append_file(resp);
//                    update_item_id();
                }else{
                    $(".btn_page_orange").click();
                    sweet_modal(resp.message,'error',2000);
                    console.log("error " + this.status);
                }
            };
            xhr.send(fd);
            $(".btn_page_orange").click();
//            $("#modal_documents_progress").modal();
        }

        function sweet_modal(text,type,time) {
            $.sweetModal({
                content: text,
                icon: type,
                timeout:time
            });
        }

        function append_file(data) {
            var html = '<tr class="item item'+data.documents_id+'">' +
                '                            <td class="text-center RalewayRegular itemid">1</td>' +
                '                            <td class="RalewayMedium">'+data.title+'</td>' +
                '                            <td class="RalewayRegular"><span class="itememail'+data.documents_id+'" style="color:#4c6897;text-decoration:underline;">'+data.last_email+'</span></td>' +
                '                            <td class="text-center RalewayRegular itemdate'+data.documents_id+'">'+data.date+'</td>' +
                '                            <td class="text-center RalewayRegular">'+data.category+'</td>' +
                '                            <td class="text-center">' +
                '                                <button onclick="edit_modal('+data.documents_id+')" class="btn_orange fix-btn-table" style="padding:6px;" data-toggle="modal" data-target="#myModal_documents_edit"><img src="/public/img/admin/ico_reload.png" alt="" style="width: 16px;height: 14px;"></button>' +
                '                                <button onclick="download(this)" href="'+data.filename+' " download class="btn_green itemlink fix-btn-table '+data.documents_id+'" ><img src="/public/img/admin/ico_download.png" alt=""></button>' +
                '                                <button onclick="delete_document('+data.documents_id+')" class="btn_gray "><img src="/public/img/admin/ico_delete.png" alt=""></button>' +
                '                            </td>' +
                '                        </tr>';
            $('.all_items').append(html);
        }
        function update_item_id() {
            var i =1;
            $(".itemid").each(function () {
                $(this).html(i);
                i++;
            })
        }

        $( function( $, window, document, undefined )
        {
            alertFile();
        });

        function alertFile() {
            $( '.inputfile' ).each( function()
            {
                var $input	 = $( this ),
                    $label	 = $input.next( 'label' ),
                    labelVal = $label.html();

                $input.change(function(e)
                {
                    var fileName = '';

                    if( this.files && this.files.length > 1 ) {
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    } else if( e.target.value ) {
                        fileName = e.target.value.split( '\\' ).pop();
                    }

                    if( fileName ) {

                        $label.find( 'span' ).html( fileName );
                    } else {
                        $label.html( labelVal );
                    }
                });

                // Firefox bug fix
                $input
                    .one( 'focus', function(){ $input.addClass( 'has-focus' ); })
                    .one( 'blur', function(){ $input.removeClass( 'has-focus' ); });
            });
        }


        $('.check_space').blur(function(){
            $(this).val($.trim($(this).val()));
        });

        $(document).ready(function(){
            $('.check_letter').keypress(validateLetter);
        });
        function validateLetter(event) {
            var key = window.event ? event.keyCode : event.which;
            if (event.keyCode === 8 || event.keyCode === 32) {
                return true;
            } else if ( (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key >= 48 && key <= 57) ){
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection