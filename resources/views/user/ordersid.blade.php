@extends('layout.admin')
@section('head')
    @include('template.head_user_template')
@endsection
@section('content')
    @include('user.header')
    <div class="app-body">
        @include('user.sidebar')
        <main class="main">
            <div class="container-fluid main_container_fluid">
                <div class="card box-shadow wrapper">
                    <div class="main-content">
                        <div class="card-header" style="padding-top: 0.9375rem;padding-bottom: 0.9375rem;border-radius: 0">
                            <h5 class="d-flex align-items-center" style="margin-bottom: 0;font-size: 1.125rem;">
                                <?php
                                    if(!empty($_GET['return'])){
                                        $ret = 'archives';
                                        $name = 'Archives';
                                    }else{
                                        $ret = 'current-orders';
                                        $name = 'ORDERS';
                                    }
                                ?>
                                <button onclick='location.href="/panel/user/{{$ret}}/"' class="btn_back d-flex align-items-center"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button>
                                <a href="/panel/user/{{$ret}}/" style="color:#4c6897;">{{$name}}</a> <span style="padding-right:5px;padding-left:5px;">|</span> <span>View</span></h5>
                        </div>
                        <div class="card-block">
                            <div class="row" style="font-size: 13px;">
                                <div class="col-12 col-xl-3 align-items-center" style="display: inline-grid;">
                                    <div class=" d-flex col-12  RalewayMedium align-items-center" style="font-size: 1.2rem;"><b>Order Ref {{$orders_data->dis_ref}}</b></div>
                                </div>
                                <div class="col-12 col-xl-3 align-items-center" style="display: inline-grid;">
                                    <div class=" d-flex col-12  RalewayMedium align-items-center" style=""><b style="margin-right:5px;">Status:</b>  {{ucfirst($orders_data->status)}}</div>
                                    <div class=" d-flex col-12  RalewayMedium align-items-center" style=""><b style="margin-right:5px;">Purchase Order Date: </b>  {{date('d/m/Y',strtotime($orders_data->created_at))}}</div>
                                </div>
                                <div class="col-12 col-xl-3 align-items-center" style="display: inline-grid;">
                                    <div class="row">
                                        <div class=" d-flex col-12  RalewayMedium align-items-center"><b style="    margin-right: 0.3125rem;">POL:</b>
                                            <input style="background: transparent;" maxlength="16" disabled class="border-none"  type="text" value="{{(!empty($orders_data->pol))?$orders_data->pol:'-'}}">
                                        </div>
                                        <div class=" d-flex col-12  RalewayMedium align-items-center"><b style="    margin-right: 0.3125rem;">POD:</b>
                                            <input style="background: transparent;" maxlength="16" disabled  class="border-none" type="text" value="{{(!empty($orders_data->pod))?$orders_data->pod:'-'}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-3 align-items-center" style="display: inline-grid;">
                                    <div class="row">
                                        <div class=" d-flex col-12  RalewayMedium align-items-center"><b style="    margin-right: 0.3125rem;">ETD:</b>
                                            <input style="background: transparent;" type="text" id="etd" disabled value="{{(!empty($orders_data->etd))?$orders_data->etd:'-'}}" class="border-none" >
                                        </div>
                                        <div class=" d-flex col-12  RalewayMedium align-items-center"><b style="margin-right:0.3125rem;">ETA:</b>
                                            <input style="background: transparent;" type="text" id="eta" disabled value="{{(!empty($orders_data->eta))?$orders_data->eta:'-'}}" class="border-none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top:0.5rem;margin-bottom:0.5rem;">
                            <table class="table table-responsive" style="font-size:1rem;">
                                <thead style="font-family: RalewaySemiBold;">
                                {{--<th style="width:1%;" class="text-center">SN</th>--}}
                                <th style="width: 25.7%" class="">Product Name</th>
                                <th style="width:25%;">Specification</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Amount</th>

                                </thead>
                                <tbody>
                                @foreach($products_data as $product)
                                    <tr class="tr_color_one">
                                        <td class=" RalewayRegular">{{$product->products_name}}</td>
                                        <td class="RalewayLight">{{$product->products_specification}}</td>
                                        <td class="text-center RalewayLight">{{$product->quantity_val}}</td>
                                        <td class="text-center RalewayMedium">$ {{$product->products_unit_price}}</td>
                                        <td class="text-center RalewayMedium">$@if(!empty($product->quantity_val))
                                                {{$product->products_unit_price*$product->quantity_val}}
                                            @else
                                                {{$product->products_unit_price}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
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
                            </table >
                        </div>
                    </div>
                </div>
        </main>
        <div class="modal fade" id="myModal_proforma_invoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title " id="myModalLabel">Proforma Invoice</h4>
                        <button type="button" class="close modal_hide" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body " style="padding-top:1.5625rem;">

                        <img class="img-circle" style="width:4.75rem;height:4.75rem;" src="/public/img/admin/pdf_ico.png" alt=""><span class="align-self-center RalewayMedium modal_src" style="margin-left: 0.9375rem;font-size:1rem;">C:/Documents/Orders/Order_ProformaInvoice.pdf</span>

                    </div>
                    <div class="modal-footer justify-content-center">
                        {{--<button onclick="delete_doc(this)"  type="button" class="btn_page doc_id" style="background:#445d88;border-bottom: 0.2em solid #3c5277;">Delete</button>--}}
                        <button onclick="download_file(this)" type="button" class="btn_page_orange btn_download" style="background-color:#ffb74d;">View</button>
                    </div>
                </div>
            </div>
        </div>
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
                                <span style="font-size:1.125rem;width: auto;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach file (PDF only!)</span>
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
                                <input required type="text" name="title" placeholder="Category Title" class="form-control addon">
                            </div>
                            <div class="form-group" style="display: flex; margin-bottom:0;">
                                <div style="width: 2.875rem;height: 3.6875rem;" class="ico_input"><img style="margin-top: 1.5rem;width: 1.4375rem;height: 0.5625rem;margin-right: 0.55rem;margin-left: 0.6125rem;" src="/public/img/admin/PDF.png" alt=""></div>
                                <input accept="application/pdf" type="file" name="file"  class="inputfile inputfile-6" required data-multiple-caption="{count} files selected">
                                <label  class="form-control addon" style="margin-bottom:0px;">
                                    <span style="font-size:1.125rem;width: auto;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach file (PDF only!)</span>
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
    <script>
        $(document).ready(function () {
            $(".header_text").html('Orders');
        });

        function modal_show(btn) {
            $('.modal-title').html($(btn).attr('data-name'));
            $('.doc_id').attr('data-id',$(btn).attr('data-id'));
            $('.modal_src').html($(btn).attr('data-src'));
            $('.btn_download').attr('data-src',$(btn).attr('data-src'));
        }

        function delete_doc(btn) {
            $.ajax({
                url:"/api/order/category/delete",
                type:"POST",
                data:{doc_id:$(btn).attr('data-id')},
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


        $('form.category_create').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var form = $('form.category_create')[0];
            var formData = new FormData(form);
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

        });
        function arrived(id) {
            $.ajax({
                url:"/api/orders/arrived/confirm",
                type:"POST",
                data:{orders_id:id},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
//		            console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
//                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
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
        $(function(){
            $('#etd').datetime({
                format:  'M/dd/yyyy hh:mm a',
                locale: 'en',
                datetime: '09/26/2018 06:00 PM',
                // datetime: Date.now(),
            })
            $('#eta').datetime({
                format:  'M/dd/yyyy hh:mm a',
                locale: 'en',
                datetime: '09/26/2019 12:00 AM',
                // datetime: Date.now(),
            })

        })
    </script>
@endsection