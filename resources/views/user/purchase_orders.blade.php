@extends('layout.user')
@section('head')
@include('template.head_user_template')
<link rel="stylesheet" href="/public/css/jquery.webui-popover.css">
<style>
  #p-order{
    border-bottom: 2px solid #fff;
  }
</style>
@endsection
@section('content')
@include('user.header')
<div class="app-body">
  @include('user.sidebar')
  <main class="main">
    <div class="main_container_fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <p class="m-0 text-center"> Purchase Order</p>
            </div>
            <div class="card-body">
              <form class="purchase_order">
                <div style="font-family:RalewayLight;" class="row m-0">
                  <div class="col-lg-8 palka3">
                    <div class="row">

                      <div class="col-lg-4">
                        <div class="row">
                          <div class="col-lg-2 p-0"><b>  From:</b> </div>
                          <div class="col-lg-10"><p>Company Name: {{$users_data->company_name}}</p>
                            <p>Country: <span class="special_color"> {{$users_data->country}} </span></p>
                            <p> Preferred Packaging Style: <b>No Pallets</b> </p>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <p>Contact person: {{$users_data->contact_name}}</p>
                        <p>Email: <span class="special_color"> {{$users_data->email}} </span> </p>
                      </div>
                      <div class="col-lg-4">
                        <p>Cell Phone: <b>{{$users_data->phone_number}}</b></p>
                        <p>Office Phone: <b>{{$users_data->office_phone}}</b></p>
                        <p></p>
                      </div>
                    </div>

                  </div>
                  <div class="col-lg-4">
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-6"><b>Date:</b> </div>
                      <div class="col-lg-8 col-md-8 col-6"><p> {{date('M j, o')}}</p></div>
                      <div class="col-lg-4 col-md-4 col-6"><b>Your PO No:</b></div>
                      <div class="col-lg-8 col-md-8 col-6 form-group"><input required name="po_num" class="form-control check_number" placeholder="Please Fill" type="text"></div>
                      <div class="col-lg-4 col-md-4 col-6"><b>Dis Ref:</b></div>
                        @if(empty($basket_data[0]))
                      <div class="col-lg-8 col-md-8 col-6"><p> <input required disabled name="dis_ref" class="form-control" value="" type="text"></p></div>
                        @else
                            <?php
                                $c_n_expl = explode(' ',$users_data->company_name);
                                $code = '';
                                foreach ($c_n_expl as $item) {
                                    $code.= ucfirst($item[0]);
                                }
                                $dis_ref = $code.'-';
                                $p_n_exp = explode(' ',$basket_data[0]->product_name);
                                foreach ($p_n_exp as $item) {
                                    $dis_ref.=ucfirst($item[0]);
                                }
                                $dis_ref.=date('ny');

                            ?>
                                <input type="hidden" value="{{$dis_ref}}" name="dis_ref">
                            <div class="col-lg-8 col-md-8 col-6"><p> <input required disabled name="dis_ref1" class="form-control" value="{{$dis_ref}}" type="text"></p></div>
                        @endif
                    </div>
                  </div>
                </div>
                <div class="row m-0">
                    <div class="col-lg-8"><div class="row"><div class="col-lg-4"><div class="row"><div class="col-lg-2 p-0"><b style="font-family:RalewayLight;"> NIF: </b></div> <div class="col-lg-10"><span >{{$users_data->nif}}</span> </div></div></div></div></div>
                    <div class="col-lg-8">
                    <div class="row m-0">
                        <div class="col-lg-12">
                            <p class="text-center RalewayRegular text-uppercase">Order details</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-6 text-right"><b style="position: relative; top:0.5rem;"> Destination Port: </b></div>
                        <div class="col-lg-3 col-md-6 col-6 form-group"><input required name="pod" placeholder="Destination Port" class="form-control" type="text"></div>
                        <div class="col-lg-3 mb-3 col-md-6 col-6 text-right"><b style="position: relative; top:0.5rem;"> Region: </b></div>
                        <div class="col-lg-3 col-md-6 col-6 form-group">
                            <select name="region" onchange="update_freight(this)" class="form-control" required>
                                <option value="Select region" disabled>Select region</option>
                                @foreach($price_components as $component)
                                    @if(!in_array($component->type,['insurance','pallet_price']))
                                        <option value="{{$component->value}}">{{$component->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 mb-3 col-md-6 col-6 text-right"><b style="position: relative; top:0.5rem;"> Container size: </b></div>
                        <div class="col-lg-3 col-md-6 col-6 form-group">
                            <select name="container_size" disabled onchange="update_container(this)" class="form-control container_size" required>
                                <option selected class="select_container" value="Select container size" disabled>Select container size</option>
                                <option value="20GP Max volume 28CBM">20GP Max volume 28CBM</option>
                                <option value="40GP Max volume 56 CBM">40GP Max volume 56 CBM</option>
                                <option value="40HQ Max volume 66 CBM">40HQ Max volume 66 CBM</option>
                                <option value="LCL">LCL</option>
                                <option value="Air">Air</option>
                            </select>
                        </div>
                    </div>
                </div>
                  <div class="col-lg-12">
                    <table style="font-family:RalewayMedium;" class="table table-responsive table-striped">
                      <thead>
                        <tr>
                          <th style="width:188px;" scope="col">Item</th>
                          <th class="text-center" style="width:332px;" scope="col">Specification</th>
                          <th class="text-center" style="width:252px;" scope="col">Packaging Type</th>
                          <th class="text-center" style="width:344px;" scope="col">Pallet/No Pallet</th>
                            <th class="text-center">Quantity</th>
                          <th class="text-center" style="width:222px;" scope="col">Unit Price</th>
                          <th class="text-center" style="width:187px;" scope="col">Sub Total Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $total_price = $fuel = 0;
                      ?>
                      @foreach($basket_data as $key=>$product)
                        <?php
                            $fuel = $total_price +=$product->amount;
                        ?>
                        <tr>
                            <td><img class="cursor-p " src="/public/img/deleted.png" alt="" onclick="delete_prod_from_cart('{{$product->basket_id}}')"> {{$product->product_name}}</td>
                            <td class="text-center"><?php echo $product->specification ?></td>
                            <td class="text-center">{{str_replace("type", "", $product->packaging_type_name)}}</td>
                            <td class="text-center">
                                @if($product->pallet_type == 'nopallet')
                                    No Pallet
                                @else
                                    Pallet
                                @endif
                            </td>
                            <td class="text-center">{{$product->quantity_val}}</td>
                            <td class="text-center">${{$product->unit_price}}</td>
                            <td class="text-center">${{$product->amount}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row m-0 m-t-10">
                  <div class="col-lg-9">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header"><p class="text-center m-0">  Related Products</p></div>
                            <div class="card-body">
                                <div style="font-family:RalewayLight;" class="row">
                                    <?php
                                    $i=0;
                                    ?>
                                    @foreach($products_data as $product)
                                        <div class="col-lg-3 col-md-3 text-center">
                                            <p onclick="window.location='/panel/user/products/overview/{{$product->id}}'"><u>{{$product->product_name}}</u></p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                      <div class="row m-0">

                          <div class="col-lg-3 mb-3 col-md-6 col-6 text-right"><b style="position: relative; top:0.5rem;"> Payment terms: </b></div>
                          <div class="col-lg-3 col-md-6 col-6 form-group">
                              <select name="payment_terms" class="form-control" required>
                                  <option value="Select payment terms" disabled>Select payment terms</option>
                                  <option value="L/C at sight">L/C at sight</option>
                                  <option value="L/C 60">L/C 60</option>
                                  <option value="L/C 90">L/C 90</option>
                                  <option value="TT">TT</option>
                                  <option value="TT 60">TT 60</option>
                                  <option value="TT 90">TT 90</option>
                                  <option value="TT 120 ">TT 120 </option>
                              </select>
                          </div>
                        <div class="col-lg-3 mb-3 col-md-6 col-6 text-right"><b style="position: relative; top:0.5rem;"> Other Instructions: </b></div>
                        <div class="col-lg-3 col-md-6 col-6 form-group"><input name="other_instructions" placeholder="Other Instructions" class="form-control" type="text"></div>

                      </div>

                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg- mb-1 col-md-6 col-6 text-right"><p><b> FOB Subtotal </b></p></div>
                      <div class="col-lg-6 col-md-6 col-6"><p>  ${{$total_price}}</p></div>
                      <div class="col-lg-6 mb-1 col-md-6 col-6 text-right"><p><b> Freight charges: </b></p></div>
                      <div class="col-lg-6 col-md-6 col-6"><p class="freight_amount">  ${{$p_c['south_east_asia']}}</p></div>
                      <div class="col-lg-6 mb-1  col-md-6 col-6 text-right"><p class="special_color"><u> Insurance </u><img class="insurance " src="/public/img/insurance.png" alt=""> </p></div>
                      <div class="col-lg-6 col-md-6 col-6">

                          ${{round($total_price*$p_c['insurance'],2)}}
                          <?php
                              $insurance = round($total_price*$p_c['insurance'],2);
                              $fuel+=$p_c['south_east_asia'];
                            $fuel+=round($total_price*$p_c['insurance'],2);
                          ?>
                        {{--<label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">--}}
                          {{--<input type="checkbox" class="custom-control-input">--}}
                            {{--<span class="custom-control-indicator"></span>--}}
                        {{--</label>--}}
                      </div>
                      <div class="col-lg-6 col-md-6 mb-1 col-6 text-right"><p><b> HST: </b></p></div>
                        @if($users_data->regione == 'North America')
                            <div class="col-lg-6 col-md-6 col-6"><p class="hst-val">---</p></div>
                            <?php
                                $hst = round($total_price*0.13,2);
                               //$fuel+=$hst;
                            ?>
                        @else
                      <div class="col-lg-6 col-md-6 col-6"><p>---</p></div>
                            <?php
                            $hst = '---';
                            //$fuel+=$hst;
                            ?>
                        @endif
                      <div class="col-lg-6 col-md-6  mb-1 col-6 text-right"><p><b> Total Amount: </b></p></div>
                      <div class="col-lg-6 col-md-6 col-6"><p class="total_amount"> ${{$fuel}}</p></div>
                        <div class="col-lg-6 mb-1 col-md-6 col-6 pr-0"><b style="position: relative; top:0.5rem;"> Point payment: </b></div>
                        <div class="col-lg-6 col-md-6 col-6 form-group"><input onkeyup="handle_change(this)" onchange="point_payment(this)" name="pay_with_points" placeholder="Min: 0 Max: " min="0" max="" class="form-control pay_with_points" type="number"></div>

                        <div class="col-lg-12 col-md-12  mb-1 col-12 text-center" style="text-decoration: underline"> Total amount only for reference </div>
                        {{--<div class="col-lg-6 col-md-6 col-6"><p> ${{$fuel}}</p></div>--}}

                        <input type="hidden" name="total_amount" value="{{$fuel}}">
                        <input type="hidden" name="f_v_proc" value="{{$f_v_proc}}">
                    </div>
                  </div>
                </div>
                <div class="row m-0 m-t-20">
                  <div class="col-lg-3">
                    <div class="row" style="font-family: RalewayMedium">
                      <div class="col-lg-12 text-center"> <p style="font-size:24px;">  <b> Shipment stats </b></p> </div>
                      <div class="col-lg-6 col-md-6 col-6 pl-0 text-right"><p>Loaded volume:</p></div>
                      <div class="col-lg-6 col-md-6 col-6"><p class="loaded_volume_val">{{$pallets_count}} (pcs)</p></div>
                        <div class="col-lg-6 col-md-6 col-6 pl-0 text-right"><p>Loaded quantity:</p></div>
                        <div class="col-lg-6 col-md-6 col-6"><p class="loaded_quantity"> pcs</p></div>
                      <div class="col-lg-6 col-md-6 col-6 pl-0 text-right"><p>Loaded weight:</p></div>
                        @if($count_g<2)
                      <div class="col-lg-6 col-md-6 col-6"><p class="loaded_weight_val"> pcs</p></div>
                        @else
                            <div class="col-lg-6 col-md-6 col-6"><p class="loaded_weight_val">{{$count_g}} pcs</p></div>
                        @endif
                        <div class="col-lg-6 col-md-6 col-6 pl-0 text-right"><p>Remaining volume:</p></div>
                        <div class="col-lg-6 col-md-6 col-6"><p class="remaining_volume_val"> (pcs)</p></div>

                    </div>
                    <hr class="w-75">
                    <p style="font-family:RalewayItalic;color:#888888;" class="text-center">*this is for estimation only</p>
                  </div>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="car">
                                <img src="/public/img/truck.png"/>
                                @if($count_g<2)
                                  <div class="progress">
                                    <div class="line" style="color: #fff;font-size: 3vw; ">
                                        <p style="position: absolute;left: 48%;color: black;top:21%;" class="text-center m-0">{{$f_v_proc}}%</p>

                                    </div>
                                  </div>
                                @else
                                    <div class="progress">
                                        <div class="line" style="width: 100%!important;color: #fff;font-size: 3vw; ">
                                            <p style="left: 40%;color: black;top:10%;" class="text-center m-0"><p class="text-car" style="font-size: 5.4vw;color:black;text-align:center;">x{{$count_g}}</p></p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12 text-center">  <button class="btn btn-success btn_submit submit_po">  Submit PO</button></div>
                        </div>
                      </div>
                  </div>

                </div>
                <input type="hidden" name="fob_subtotal" value="{{$total_price}}">
                <input type="hidden" name="freight_charges" value="0">
                <input type="hidden" name="insurance" value="{{round($total_price*$p_c['insurance'],2)}}">
                @if($users_data->regione == 'North America')
                    <input type="hidden" name="hst" value="{{round($total_price*0.13,2)}}">
                @endif
                <input type="hidden" name="token" value="{{$token}}">
              </form>
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
<script src="/public/js/jquery.webui-popover.js"></script>
 <script type="text/javascript">
     $( document ).ready(function() {
         containerSize();
     });
     // $(window).on('load', function () {
     //     containerSize();
     // });
     function containerSize() {
         if($('input[name="dis_ref"]').val()==''){
             $('.container_size').attr("disabled","disabled");
         }
         else{
             $('.container_size').removeAttr("disabled");
         }
     }
     var round_points = parseInt('{{floor($fuel/200)}}');
     var points_count = parseInt('{{$points_users}}');
     var total_amount = '{{$fuel}}';

     function update_container(select) {
         var pallet_count = parseInt('{{$pallets_count}}');
         var capacity_car = 0;
         switch ($(select).val()){
             case  '20GP Max volume 28CBM':
                 capacity_car = 10;
                break;

             case  '40GP Max volume 56 CBM':
                 capacity_car = 21;
                break;

             case  '40HQ Max volume 66 CBM':
                 capacity_car = 21;
                break;
             default:

                 break;

         }
         if(capacity_car!=0) {
             var count_cars = Math.ceil(pallet_count / capacity_car);
             var remaining_pcs = capacity_car*count_cars - pallet_count;

             var procent = Math.round((((capacity_car-remaining_pcs)*100)/capacity_car),2);


             $('.loaded_quantity').html(pallet_count+' pcs');
             $('.remaining_volume_val').html(remaining_pcs + ' (pcs)');
             if (count_cars < 2) {
                 $('.loaded_weight_val').html(pallet_count+' pcs');
                 $('.progress').html('<div class="line" style="color: #fff;font-size: 3vw; ">\n' +
                     '                                        <p style="position: absolute;left: 48%;color: black;top:21%;" class="text-center m-0">' + procent + '%</p>\n' +
                     '\n' +
                     '                                    </div>');
                 $('.car .progress .line').css('width', procent + '%');
             } else {
                 $('.loaded_weight_val').html(pallet_count + ' pcs');
                 $('.progress').html('<div class="line" style="width: 100%!important;color: #fff;font-size: 3vw; ">\n' +
                     '                                            <p style="left: 40%;color: black;top:10%;" class="text-center m-0"><p class="text-car" style="font-size: 5.4vw;color:black;text-align:center;">x' + count_cars + '</p></p>\n' +
                     '                                        </div>');
                 $('.car .progress .line').css('width', procent + '%');
             }
         }else{
             $('.loaded_quantity').html('pcs');
             $('.car .progress .line').css('width',  '0%');
             $('.car .progress .line p').html('');
             $('.loaded_weight_val').html('pcs');
             $('.remaining_volume_val').html('(pcs)');
         }
     }

     function handle_change(input) {
         if ($(input).val() < 0) $(input).val('');
         if ($(input).val() > round_points) $(input).val('');
//         point_payment(input);
     }
     function point_payment(input) {
         var with_points = (parseFloat(total_amount)-($(input).val()*200)).toFixed(2);
         $(".total_amount").html('$'+with_points);
     }

     function update_freight(select) {
         var full_price = 0;
         var name = $(select).find('option:selected').text();
         var sub_total = parseFloat('{{$total_price}}');
         var charge = parseFloat($(select).val());
         var insurance = parseFloat('{{$insurance}}');
         var hst = parseFloat('{{$hst}}');
         console.log(sub_total);
         console.log(charge);
         console.log(insurance);
         console.log(hst);

         full_price = sub_total+charge+insurance;
         $('.hst-val').html('---');
         if(name === 'North America') {
             full_price+=hst;
             $('.hst-val').html('$'+hst);
         }
         console.log(full_price);
         $('.freight_amount').html('$'+charge);
         $('input[name="total_amount"]').val(full_price);
         $('.total_amount').html('$'+full_price);
     }

     $(document).ready(function(){
         $('.check_number').keypress(validateNumber);

         if(points_count-(points_count-round_points)>0){
             var count = points_count-(points_count-round_points);
             $(".pay_with_points").attr('max', count);
             $(".pay_with_points").attr('placeholder', 'Max: ' + count);
         }else {
             $(".pay_with_points").attr('disabled', 'disabled');
             $(".pay_with_points").attr('max', '0');
             $(".pay_with_points").attr('placeholder', 'Max: 0');
         }
     });

    @if(empty($basket_data))
        $('.submit_po').attr('disabled','disabled');
    @endif

   $('form.purchase_order').on('submit',function(e){
       e.preventDefault();
       $(".btn_submit").attr('disabled','disabled');
       $.ajax({
           url:"/api/orders/purchase",
           type:"POST",
           data:$(this).serialize(),
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
                       window.location = '/panel/user/current-orders';
                   },1000);
               }else{
                   sweet_modal(data.message,'error',1000);
               }
               $(".btn_submit").removeAttr('disabled');
           },error:function (data) {
               console.log(data);
               sweet_modal('Something went wrong','error',1000);
               $(".btn_submit").removeAttr('disabled');
           }
       })
   });

     function delete_prod_from_cart(id) {
         $.ajax({
             url:"/api/user/product/delete_from_cart",
             type:"POST",
             data:{
                 token: '{{$token}}',
                 cart_id:id
             },
             headers: {
                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                 '_token' : '{{ csrf_token() }}'
             },
             dataType: 'JSON',
             success:function (data) {
                 console.log(data);
                 if(data.success==true){
                     sweet_modal('Success','success',1000);
                     setTimeout(function () {
                         window.location = '/panel/user/purchase-orders';
                     },1000);
                 }else{
                     sweet_modal(data.message,'error',1000);
                 }
                 $(".btn_submit").removeAttr('disabled');
             },error:function (data) {
                 console.log(data);
                 sweet_modal('Something went wrong','error',1000);
                 $(".btn_submit").removeAttr('disabled');
             }
         })
     }

    @if($count_g<2)
        $('.car .progress .line').css('width','{{$f_v_proc}}%');
    @endif


   function validateNumber(event) {
       var key = window.event ? event.keyCode : event.which;
       if (event.keyCode === 8 || event.keyCode === 32) {
           return true;
       } else if ( key < 48 || key > 57 ) {
           return false;
       } else {
           return true;
       }
   }

    // $('.insurance').webuiPopover({placement:'bottom',content:'<div class="text-center"><p class="m-0">Text</p></div>'});
 </script>
@endsection
