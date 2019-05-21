@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
    @include('admin.sidebar')
    <main class="main">
        <div class="container-fluid main_container_fluid">
            <div class="card box-shadow wrapper">
<div class="main-content">
                <div class="card-header" style="padding-top: 0.9375rem;padding-bottom: 0.9375rem;border-radius: 0">
                    <h5 class="d-flex align-items-center" style="margin-bottom: 0;font-size: 1.125rem;">
                        <div class="row" style="width: 100%;">
                            <div class="col-6 d-flex align-items-center">
                                <button onclick='location.href="/panel/admin/orders"' class="btn_back d-flex align-items-center"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button>
                                <a href="/panel/admin/orders" style="color:#4c6897;">ORDERS</a> <span style="padding-right:5px;padding-left:5px;">|</span> <span>View</span>
                            </div>
                            @if($role!='purchase_assistant')
                                <div class="col-6 d-flex align-items-center justify-content-end">
                                    <span class="edit_btn_order_doc align-items-center" style="display: flex;height: 1.875rem;">
                                        <button class="btn_orange edit_order_doc_info d-flex align-items-center" style="line-height: normal;padding: 0.5rem 0.6rem;margin-right: 0.625rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button>
                                        <span>Edit info</span>
                                    </span>
                                    <button class="btn btn-success save save_order_doc_info btn_submit" onclick="save_orders_data()" style="padding: 0px;width: 3.5rem;height: 1.875rem;"> Save </button>
                                </div>
                            @endif
                        </div>
                    </h5>
                </div>

                <div class="card-block">
                    <div class="row">
                        <div class="col-12 col-xl align-items-center" style="display: inline-grid;">
                            <div class="row">
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size: 1.5rem;"><b>Order Ref {{$orders_data->dis_ref}}</b></div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-3 align-items-center" style="display: inline-grid;">
                            <div class="row">
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="margin-right:5px;">Status:</b> {{ucfirst($orders_data->status)}}</div>
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="margin-right:5px;">Purchase Order Date: </b>  {{date('m/d/Y',strtotime($orders_data->created_at))}}</div>
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="margin-right:5px;">BL Number:</b><input style="width: auto!important;" type="text"class="edit_doc_inf bl_number_val" disabled value="{{(!empty($orders_data->bl_number))?$orders_data->bl_number:'-'}}"> </div>
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="margin-right:5px;">Shipping Company:</b> <input style="width: auto!important;" type="text" class="edit_doc_inf shipping_company_val" disabled value="{{(!empty($orders_data->shipping_company))?$orders_data->shipping_company:'-'}}"></div>
                            </div>
                        </div>


                        <div class="col-12 col-xl-2 align-items-center" style="display: inline-grid;">
                            <div class="row">
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="    margin-right: 0.3125rem;">POL:</b>
                                    <input maxlength="16" class="edit_doc_inf pol_val"  disabled type="text" value="{{(!empty($orders_data->pol))?$orders_data->pol:'-'}}">
                                </div>
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="    margin-right: 0.3125rem;font-size: 1.07rem;">POD:</b>
                                    <input maxlength="16" class="edit_doc_inf pod_val" disabled type="text" value="{{(!empty($orders_data->pod))?$orders_data->pod:'-'}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl align-items-center" style="display: inline-grid;">
                            <div class="row">
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="    margin-right: 0.3125rem;font-size: 1.07rem;">ETD:</b>
                                    <input type="text"  class="edit_doc_inf etd_val" disabled value="{{(!empty($orders_data->etd))?$orders_data->etd:'-'}}">
                                </div>
                                <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="margin-right:0.3125rem;">ETA:</b>
                                    <input type="text" class="edit_doc_inf eta_val" disabled value="{{(!empty($orders_data->eta))?$orders_data->eta:'-'}}">
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-12 col-xl align-items-center" style="display: inline-grid;">--}}
                            {{--<div class="row">--}}
                                {{--<div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="    margin-right: 0.3125rem;font-size: 1.07rem;">BL Number:</b>--}}
                                    {{--<input type="text" class="edit_doc_inf bl_number_val" disabled value="{{(!empty($orders_data->bl_number))?$orders_data->bl_number:'-'}}">--}}
                                {{--</div>--}}
                                {{--<div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size:1.125rem;"><b style="margin-right:0.3125rem;">Shipping Company:</b>--}}
                                    {{--<input type="text" class="edit_doc_inf shipping_company_val" disabled value="{{(!empty($orders_data->shipping_company))?$orders_data->shipping_company:'-'}}">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        @if($role != 'purchase_assistant')
                        <div class="col-12 col-xl d-flex align-items-center justify-content-xl-end">
                            <div class="btn-group dropdown">
                                <button type="button" class="btn_page btn_orders RalewayMedium dropdown-toggle m-0" data-toggle="dropdown"  aria-expanded="false">
                                    Change order status
                                </button>
                                <div class="dropdown-menu dropdown_btn_order">
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Order Confirmed')" href="#">Order Confirmed</a>
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','In Production')" href="#">In Production</a>
                                    <a class="dropdown-item" style="padding-left: .7rem;" onclick="arrived('{{$orders_data->id}}','Ready to be shipped')" href="#">Ready to be shipped</a>
                                    <a class="dropdown-item" onclick="arrived_link('{{$orders_data->id}}','Shipped')" href="#">Shipped</a>
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Imminent arrival')" href="#">Imminent arrival</a>
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Discharged')" href="#">Discharged</a>
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Paid in Full')" href="#">Paid in Full</a>
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Paid Partially')" href="#">Paid Partially</a>
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Unpaid')" href="#">Unpaid</a>
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Cancelled')" href="#">Cancelled</a>
                                    <a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Arrived')" href="#">Arrived</a>
                                    {{--<a class="dropdown-item" onclick="arrived('{{$orders_data->id}}','Arrived')" href="#">Arrived</a>--}}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <hr>
                    <div class="table-responsive">
                    <table class="table" style="font-size:1.25rem;margin-bottom:1rem;" >
                        <thead style="font-family: RalewaySemiBold;">
                        {{--<th style="width:1%;" class="text-center">SN</th>--}}
                        <th style="width:25%;">Product Name</th>
                        <th style="width:25%;">Specification</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Amount</th>

                        </thead>
                        <tbody>
                        @foreach($products_data as $product)
                            <tr class="tr_color_one">
                                {{--<td style="font-family: RalewayMedium;" class="text-center">{{$key+1}}</td>--}}
                                <td class="RalewayRegular">{{$product->products_name}}</td>
                                <td class="RalewayLight">{{$product->products_specification}}</td>
                                <td class="text-center RalewayLight">{{$product->quantity_val}}</td>
                                <td class="text-center RalewayMedium">${{$product->products_unit_price}}</td>
                                <td class="text-center RalewayMedium">
                                    @if(!empty($product->quantity ) && !empty($product->products_unit_price))
                                        ${{$product->products_unit_price * $product->quantity}}
                                    @else
                                        ${{$product->products_unit_price}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            {{--<td></td>--}}
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center" style="position: relative;">Total: $<b>
                                    @if($orders_data->pay_with_points!=0 && $orders_data->pay_with_points>0)
                                        {{$orders_data->total_amount-$orders_data->pay_with_points*200}} <br>( {{$orders_data->pay_with_points}} points )
                                    @else
                                        {{$orders_data->total_amount}}
                                    @endif
                                </b> </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
                <div class="main-footer form-group">
                <div class="col d-flex justify-content-center flex-wrap">
                    @foreach($orders_categories as $category)
                            <button  data-toggle="modal" data-target="#myModal_proforma_invoice" onclick="modal_show(this)" data-type-files="{{$category->type_files}}" data-link="{{$category->link}}" data-name="{{$category->title}}" data-category-id="{{$category->id}}" data-files="{{$category->files}}" data-files-ids="{{$category->files_ids}}" class="btn_page btn_orders RalewayMedium">{{$category->title}}
                            <div class="inform"><span class="point_order">
                                    {{$category->files_count}}
                                </span></div></button>
                    @endforeach
                    <button class="btn_page_orange btn_orders RalewayMedium" data-toggle="modal" data-target="#myModal_other">+ OTHER</button>
                </div>
            </div>
            </div>

    </main>

        <div class="modal fade" id="myModal_proforma_invoice_link" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel1">Proforma Invoice</h4>
                        <button type="button" class="close modal_hide" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body modal_overview_body" style="text-align: center;padding-top:1.5625rem;">

                    </div>
                    <div class="modal-footer  modal_overview_btn">
                        <div class="row" style="width: 100%">
                            <div class="col-12 text-center">
                                <button onclick="save_link(this)" type="button" class="btn_page_orange btn_download" style="background:#445d88;border-bottom: 0.2em solid #3c5277;">Save</button>
                                <button type="button" class="btn_page_orange category_id" style="background-color:#ffb74d;" onclick="delete_category(this)"> Delete category</button>
                            </div>
                        </div>
                        {{--<button onclick="download_file(this)" type="button" class="btn_page_orange btn_download" style="background-color:#ffb74d;">View</button>--}}
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="myModal_proforma_invoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">Proforma Invoice</h4>
                        <button type="button" class="close modal_hide" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body modal_overview_body" style="text-align: center;padding-top:1.5625rem;">
                        {{--<div class="row">--}}

                        {{--</div>--}}
                            {{--<img class="img-circle" style="width:4rem;height:4rem;" src="/public/img/admin/pdf_ico.png" alt=""><span class="align-self-center RalewayMedium modal_src" style="margin-left: 0.9375rem;font-size:1rem;">C:/Documents/Orders/Order_ProformaInvoice.pdf</span>--}}

                    </div>
                    <div class="modal-footer  modal_overview_btn">
                        <div class="row" style="width: 100%">
                            <div class="col-12 text-center footer_btn">
                                {{--<button onclick="save_link(this)" type="button" class="btn_page_orange btn_download" style="background:#445d88;border-bottom: 0.2em solid #3c5277;">Save</button>--}}
                                {{--<button onclick="reupload_click(this)" type="button" class="btn_page_orange btn_download" style="background:#445d88;border-bottom: 0.2em solid #3c5277;">Upload</button>--}}
                                {{--<button type="button" class="btn_page_orange category_id" style="background-color:#ffb74d;" onclick="delete_category(this)"> Delete category</button>--}}
                            </div>
                        </div>
                        {{--<button onclick="download_file(this)" type="button" class="btn_page_orange btn_download" style="background-color:#ffb74d;">View</button>--}}
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" class="save_link">
        <input type="hidden" class="link2">
        <input type="file" accept=".jpeg,.jpg,.pdf,.xls,.xlsx,.docx,.doc" style="display: none" class="reupload_file" onchange="reupload_new_file(this)">
        <div class="modal fade" id="myModal_packing_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">Packing List</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body " style="padding-top:1.5625rem;">
                        <div class="form-group" style="display: flex; margin-bottom:0;">
                            <div style="width: 2.875rem;height: 3.6875rem;" class="ico_input"><img style="margin-top: 1.5rem;width: 1.4375rem;height: 0.5625rem;margin-right: 0.55rem;margin-left: 0.6125rem;" src="/public/img/admin/PDF.png" alt=""></div>
                            <input accept="application/pdf" type="file" name="myfile_list"  class="inputfile inputfile-6" required data-multiple-caption="{count} files selected">
                            <label  class="form-control addon" style="margin-bottom:0px;">
                                <span style="font-size:1.125rem;width: auto;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach file (PDF,Word,Excel,Jpeg)</span>
                            </label>
                            <div class="d-flex align-items-center" style="border:0.125rem solid #aab4bc;border-radius: 0.25rem;margin-left: 0.375rem;background: #f2f2f2;cursor:pointer;"><strong style="width: 3.6rem;height: 3.44rem;color: black;text-align: center;font-size: 1.75rem;">...</strong></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn_page" style="background:#445d88;border-bottom: 0.2em solid #3c5277;">Upload</button>
                        <button type="button" class="btn_page_orange" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal_other" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">Create New Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="category_create">
                        <div class="modal-body " style="padding-top:1.5625rem;">
                            <div class="form-group">
                                <span class="ico_input"><img src="/public/img/admin/doc.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;margin-top: 0.8375rem;width: 1.4375rem;height: 1.5625rem;"></span>
                                <input maxlength="26" required type="text" name="title" placeholder="Category Title" class="form-control addon check_space check_letter">
                            </div>
                            <div class="form-group" style="display: flex; margin-bottom:0;">
                                <div style="width: 2.875rem;height: 3.6875rem;" class="ico_input"><img style="margin-top: 1.5rem;width: 1.4375rem;height: 0.5625rem;margin-right: 0.55rem;margin-left: 0.6125rem;" src="/public/img/admin/PDF.png" alt=""></div>
                                <input accept=".jpeg,.jpg,.pdf,.xls,.xlsx,.docx,.doc" type="file" name="file"  class="inputfile inputfile-6" required data-multiple-caption="{count} files selected">
                                <label  class="form-control addon" style="margin-bottom:0px;">
                                    <span style="font-size:1.125rem;width: auto;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach file (PDF, Word, Excel, Jpeg)</span>
                                </label>
                                <div class="d-flex align-items-center" style="border:0.125rem solid #aab4bc;border-radius: 0.25rem;margin-left: 0.375rem;background: #f2f2f2;cursor:pointer;"><strong style="width: 3.6rem;height: 3.44rem;color: black;text-align: center;font-size: 1.75rem;">...</strong></div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn_page" style="background:#445d88;border-bottom: 0.2em solid #3c5277;">Create</button>
                            <button type="button" class="btn_page_orange btn_modal_hide" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                        </div>
                        <input type="hidden" name="orders_id" value="{{$orders_data->id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('template.script_user_template')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>--}}
    <script src="/public/js/datetime.js"></script>
    <script>
        var token = '{{$token}}';
        $('.edit_order_doc_info').click(function(){
            $('.save_order_doc_info').css("display", "initial");
            $('.edit_btn_order_doc').css("display", "none");
            $(".edit_doc_inf").removeAttr('disabled');
            $(".edit_doc_inf").addClass('edit_doc_inf_active');

        });
        $('.save_order_doc_info').click(function(){
            $('.edit_btn_order_doc').css("display", "flex");
            $('.save_order_doc_info').css("display", "none");
            $('.edit_doc_inf').attr('disabled','disabled');
            $(".edit_doc_inf").removeClass('edit_doc_inf_active');
        });
        $(function(){
            $('#etd').datetime({
                format:  'M/dd/yyyy',
                locale: 'en',
                datetime: '{{$orders_data->etd}}',
                // datetime: Date.now(),
            })
            $('#eta').datetime({
                format:  'M/dd/yyyy',
                locale: 'en',
                datetime: '{{$orders_data->eta}}',
                // datetime: Date.now(),
            })

        })
        $(document).ready(function () {
            $(".header_text").html('Orders');
        });
        $('select[name="status"]').val('{{$orders_data->status}}');

        function delete_category(btn) {
            $('.modal_hide').click();
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url:"/api/admin/orders/category/delete",
                    type:"POST",
                    data:{'cat_id':$(btn).attr('data-id')},
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        '_token': '{{ csrf_token() }}'
                    },
                    success:function (data) {
                        console.log(data);
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = location;
                        },1000);
                    },error:function(data){
                        console.log(data);
                        sweet_modal('Something went wrong','error',1000);
                    }

                })
            });
        }

        function modal_show_link(btn) {
            $('#myModalLabel1').html($(btn).attr('data-name'));
            $('.save_link').val($(btn).attr('data-category-id'));
            $('input[name="link"]').val($(btn).attr('data-link'));
        }
        
        function save_orders_data() {
            console.log($('.eta_val').val());
            $.ajax({
                url:"/api/order/info/save",
                type:"POST",
                data:{
                    token:'{{$token}}',
                    pol:$('.pol_val').val(),
                    pod:$('.pod_val').val(),
                    etd:$('.etd_val').val(),
                    eta:$('.eta_val').val(),
                    shipping_company:$('.shipping_company_val').val(),
                    bl_number:$('.bl_number_val').val(),
                    orders_id:'{{$orders_data->id}}'
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
//                    $('.modal_hide').click();
                    $('.modal_hide').click();
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/orders/documents/{{$orders_data->id}}';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    $('.modal_hide').click();
                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }

        function save_link() {
            $.ajax({
                url:"/api/order/category/create",
                type:"POST",
                data:{type: $('#myModalLabel').html(),data_id:$('.save_link').val(),link:$('.link2').attr('data-val')},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
//                    $('.modal_hide').click();
                    $('.modal_hide').click();
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/orders/documents/{{$orders_data->id}}';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    $('.modal_hide').click();
                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }

        function link_set(input) {
            $('.link2').attr('data-val',$(input).val());
        }

        function delete_link(i) {
            var id = $(i).attr('data-id');
            $.ajax({
                url:"/api/order/category/create",
                type:"POST",
                data:{type: 'Shipment Confirmation',data_id:id,link:null},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
//                    $('.modal_hide').click();
                    $('.modal_hide').click();
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/orders/documents/{{$orders_data->id}}';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    $('.modal_hide').click();
                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }

        function modal_show(btn) {
            $('.modal_overview_body').html('');
            $('#myModalLabel').html($(btn).attr('data-name'));
            if($(btn).attr('data-name') == 'Shipment Confirmation'){
                $('.modal_overview_body').html('                        <div class="col-12 form-group">\n' +
                    '                            <input type="text" onkeyup="link_set(this)" class="link1 form-control" placeholder="Link">\n' +
                    '                        </div>\n');
                $('.footer_btn').html('<button onclick="save_link(this)" type="button" class="btn_page_orange btn_download" style="margin: 10px;background:#445d88;border-bottom: 0.2em solid #3c5277;">Save link</button>\n' +
                    '                                <button onclick="reupload_click(this)" type="button" class="btn_page_orange btn_download" style="margin: 10px;;background:#445d88;border-bottom: 0.2em solid #3c5277;">Upload file</button>\n' +
                    '                                <button type="button" class="btn_page_orange category_id" style="background-color:#ffb74d;" onclick="delete_category(this)"> Delete category</button>');
            }else{
                $('.footer_btn').html(' <button onclick="reupload_click(this)" type="button" class="btn_page_orange btn_download" style="background:#445d88;border-bottom: 0.2em solid #3c5277;">Upload</button>\n' +
                    '                                <button type="button" class="btn_page_orange category_id" style="background-color:#ffb74d;" onclick="delete_category(this)"> Delete category</button>');
            }
            $('.save_link').val($(btn).attr('data-category-id'));
            $('.link1').val($(btn).attr('data-link'));
            var files = $(btn).attr('data-files');
            var ids = $(btn).attr('data-files-ids');
            var type_files = $(btn).attr('data-type-files');
            $('.category_id').attr('data-id',($(btn).attr('data-category-id')));
            if($(btn).attr('data-link')!=''){
                $('.modal_overview_body').append('<div class="container"><div class="row"><div class="col-2"></div><div class="col-8" style="overflow: hidden;padding-top: 15px;"><span class="align-self-center RalewayMedium modal_src" style="margin: 1rem;font-size:1.3rem;"><a href="'+$(btn).attr('data-link')+'" target="_blank">'+$(btn).attr('data-link')+'</a></span></div><div class="col-2" style="padding-top: 20px;"><i style="cursor: pointer;font-size: 1.3rem" data-id="'+$(btn).attr('data-category-id')+'" onclick="delete_link(this)" class="far fa-trash-alt"></i></div>');
                $('.modal_overview_body').append('</div></div>');
            }
            if(files){
                files = files.split(',');
                ids = ids.split(',');
                type_files = type_files.split(',');
                var i = 0;
                for(var k in files){
                    i++;
                    var file = files[k];
                    var file_url  = '{{asset('/public/file_a_claim/')}}/';
//                    file = file.slice(0,46);

                    var photo='/public/img/admin/pdf_ico.png';
                    switch (type_files[k]){
                        case 'pdf':
                            photo='/public/img/admin/pdf_ico.png';
                        break;
                        case 'jpeg':
                            photo='/public/img/picture.png';
                        break;
                        case 'jpg':
                            photo='/public/img/picture.png';
                        break;
                        case 'xlsx':
                            photo='/public/img/excel.png';
                        break;
                        case 'xls':
                            photo='/public/img/excel.png';
                        break;
                        case 'docx':
                            photo='/public/img/word.png';
                        break;
                        case 'doc':
                            photo='/public/img/word.png';
                        break;
                        case  'png':
                            photo='/public/img/picture.png';
                        break;
                        default:
                            photo='/public/img/admin/pdf_ico.png';
                        break;
                    }
                    if(i!=1){
                        $('.modal_overview_body').append('<br>');
                    }
                    $('.modal_overview_body').append('<div class="container"><div class="row"><div class="col-2"><img class="img-circle" style="margin: 5px 0px;width:4rem;height:4rem;" src="'+photo+'" alt="alt"></div><div class="col-8" style="overflow: hidden;padding-top: 15px;"><span class="align-self-center RalewayMedium modal_src" style="margin: 1rem;font-size:1.3rem;"><a href="'+file_url+file+'" download="'+files[k]+'">'+file+'</a></span></div><div class="col-2" style="padding-top: 20px;"><i style="cursor: pointer;font-size: 1.3rem" data-id="'+ids[k]+'" onclick="delete_file(this)" class="far fa-trash-alt"></i></div>');
                    $('.modal_overview_body').append('</div></div>');
                }
            }
//            $('.modal-title').html($(btn).attr('data-name'));
//            $('.doc_id').attr('data-id',$(btn).attr('data-id'));
//            $('.modal_src').html($(btn).attr('data-src'));
            $('.btn_download').attr('data-category-id',$(btn).attr('data-category-id'));
        }

        function reupload_click(btn) {
            $('.reupload_file').attr('data-category-id',$(btn).attr('data-category-id'));
            $('.reupload_file').click();
        }

        function delete_file(btn) {
            var id = $(btn).attr('data-id');
            $('.modal_hide').click();
            delete_el('file',id);
        }

        function reupload_new_file(file) {
            $(".btn_submit").attr('disabled','disabled');
            var formData = new FormData();
            var file_src = $(file)[0].files[0];
            formData.append('file',file_src);
            formData.append('cat_id',$(file).attr('data-category-id'));
            if(file_src){
                $('.modal_hide').click();
                upload_doc(formData);
            }else{
                sweet_modal('Please, select file!','error',3000);
            }
        }
        function delete_el(type,id) {
            $.ajax({
                url:"/api/order/category/delete",
                type:"POST",
                data:{type:type,data_id:id},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
//                    $('.modal_hide').click();
                    $('.modal_hide').click();
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/orders/documents/{{$orders_data->id}}';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    $('.modal_hide').click();
                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }

        function delete_doc(btn) {
            delete_el('category',$(btn).attr('data-id'));
        }

        function download_file(btn) {
            var src = $(btn).attr('data-src');
            downloadURI(src);
        }

        function downloadURI(uri) {
            var link = document.createElement("a");
//                  link.download = name;
            link.href = uri;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
        }

        function upload_doc(formData) {
            $.ajax({
                url:"/api/order/category/create",
                type:"POST",
                contentType: false,
                processData: false,
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    $('.btn_modal_hide').click();
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/orders/documents/{{$orders_data->id}}';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    $('.btn_modal_hide').click();
                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }


        $('form.category_create').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var form = $('form.category_create')[0];
            var formData = new FormData(form);
            upload_doc(formData);
        });


        function arrived(id,status) {
            $.sweetModal.confirm('Want to send a notification to email?', function() {
                    change_status(id,status,'yes','');
            },function () {
                    change_status(id,status,'no','');
                }
            );
        }

        function unarrived(id,status) {
            change_status(id,status,'no','');
        }
        function arrived_link(id,status) {
            $.sweetModal.prompt('Want to send a notification to email?', 'Insert the link of tracking', null, function(val) {
                if(val==undefined || val==''){
                    sweet_modal('Invalid parameter. Empty tracking link','error',3000);
                }else {
                    change_status(id, status, 'yes', val);
                }
            },function () {
                    change_status(id,status,'no','');
                }
            );
        }

        function change_status(id,status,send_email,tracking_link) {
            $.ajax({
                url:"/api/orders/change_status",
                type:"POST",
                data:{
                    orders_id:id,
                    status:status,
                    token:token,
                    sent_email:send_email,
                    tracking_link:tracking_link
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/orders/documents/{{$orders_data->id}}';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',3000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    console.log(data);
                    sweet_modal('Something went wrong','error',3000);
                    $(".btn_submit").removeAttr('disabled');
                }
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
        };
    </script>
@endsection