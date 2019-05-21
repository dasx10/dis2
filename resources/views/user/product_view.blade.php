@extends('layout.user')
@section('head')
    @include('template.head_user_template')
    <link rel="stylesheet" href="/public/css/user/w3-style.css">
    <link rel="stylesheet" href="/public/css/jquery.webui-popover.css">
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: "|"!important;
        }
    </style>
@endsection
@section('content')
    @include('user.header')
    <div class="app-body">
        @include('user.sidebar')
        <main class="main" >
            <div class="main_container_fluid" style="font-family: RalewayRegular;">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div  class="card-header p-0">
                                <nav style="font-family: RalewaySemiBold;" aria-label="breadcrumb">
                                    <ol style="background-color: rgba(0, 0, 0, 0.03);" class="breadcrumb m-0">
                                        <?php
                                            $ret = 'products';
                                            $name = 'Products';
                                            if(!empty($_GET['return'])){
                                                $ret = 'archives';
                                                $name = 'Archives';
                                            }
                                        ?>
                                        <button onclick='location.href="/panel/user/products/"' class="btn_back d-flex align-items-center"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button>
                                        <a href="/panel/user/{{$ret}}/" style="color:#4c6897;">{{$name}}</a> <span style="padding-right:5px;padding-left:5px;">|</span> <span>{{$data->product_name}}</span>
                                    </ol>
                                </nav>
                            </div>
                            <div class="card-body">
                                <div class="row m-0">
                                    <div class="col-12 col-xl-4" >
                                        <div class="w3-content slider">
                                            @foreach($data->photos as $photo)
                                                    <img style="width: 18.75rem;height: 18.75rem;margin: 0px auto;display: block; border:1px solid #d1d1d1;" class="mySlides" src="{{$photo->filename}}">
                                            @endforeach
                                            <div class="w3-row-padding w3-section">
                                                @foreach($data->photos as $key=>$photo)
                                                    <div  class="w3-col s3">
                                                        <img class="demo img-slider w3-opacity w3-hover-opacity-off" src="{{$photo->filename}}" onclick="currentDiv('{{$key+1}}')">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h3 style="font-family:RalewayMedium;">{{$data->product_name}} <span style="font-size: 1.125rem">{{$data['specification']}}</span></h3>
                                        <h6 style="font-family: RalewayRegular;margin-bottom: 3rem;">{{$data->category}} / by <span style="color:#4c6897;">{{$data['brand']}}</span></h6>
                                        <div class="row">
                                                {{--@if($data->in_stock>0)--}}
                                                {{--<select class="quantity_val form-group form-control" style="padding: 10px;border-radius: 5px;margin-right:2rem;height:calc(3.25rem + 2px);width:220px;">--}}
                                                    {{--<option value="">Select Quantity</option>--}}
                                                    {{--@if($data->in_stock-$data->quantity_min>=0)--}}
                                                        {{--<option value="{{$data->quantity_min}}">{{$data->quantity_min}} Minimum Quantity</option>--}}
                                                    {{--@endif--}}
                                                    {{--@if($data->in_stock-$data->quantity_with_p>=0)--}}
                                                        {{--<option value="{{$data->quantity_with_p}}">{{$data->quantity_with_p}} Quantity per Container (With Pallet)</option>--}}
                                                    {{--@endif--}}
                                                    {{--@if($data->in_stock-$data->quantity_without_p>=0)--}}
                                                        {{--<option value="{{$data->quantity_without_p}}">{{$data->quantity_without_p}} Quantity per Container (Without Pallet)</option>--}}
                                                    {{--@endif--}}
                                                {{--</select>--}}
                                                {{--@endif--}}
                                                {{--@if($data->in_stock>0)--}}
                                                {{--<input placeholder="Enter quantity needed" min="{{$data->quantity_min}}" max="{{$data->in_stock}}" type="number" class="form-control q-needed quantity_val">--}}
                                                {{--@endif--}}


                                                {{--@if($data->in_stock>0)--}}
                                                    {{--<p style="display: inline-block;margin: 0; margin-top: 1rem;">In Stock: <span><b>{{$data->in_stock}}</b></span></p>--}}
                                                {{--@else--}}
                                                    {{--<p style="display: inline-block;margin: 0; margin-top: 1rem;font-size: 1.3rem">In Stock: <span><b>0</b></span></p>--}}
                                                {{--@endif--}}
                                            <div class="col-sm-4 col-lg d-flex align-content-between flex-wrap form-group">
                                                <div class="row">
                                                    <div class="col-12 d-flex align-items-end" style="color:#d9d9d9;font-size: 0.875rem;margin-bottom: 0.5rem;">Packaging Type</div>
                                                    <div class="col-12 d-flex align-items-end">
                                                        <select onchange="update_quantity(this)" class="form-control s-t type_val">
                                                            @if(!empty($data->type_of_packaging1))
                                                                <option selected value="type1">{{$data->type_of_packaging1}}</option>
                                                            @endif
                                                            @if(!empty($data->type_of_packaging2) && !empty($data->moc_1_2) && !empty($data->moc_2_2) && !empty($data->moc_3_2))
                                                                <option value="type2">{{$data->type_of_packaging2}}</option>
                                                            @endif
                                                            @if(!empty($data->type_of_packaging3) && !empty($data->moc_1_3) && !empty($data->moc_2_3) && !empty($data->moc_3_3))
                                                                <option value="type3">{{$data->type_of_packaging3}}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-lg d-flex align-content-between flex-wrap form-group">
                                                <div class="row">
                                                    <div class="col-12 d-flex align-items-end" style="color:#d9d9d9;font-size: 0.875rem;margin-bottom: 0.5rem;">Pallet/No Pallet</div>
                                                    <div class="col-12 d-flex align-items-end">
                                                        @if($data->pallet_without_pallet === 'Pallet')
                                                            <select onchange="update_price()" class="form-control s-t pal_np_val">
                                                                <option selected value="pallet">Pallet</option>
                                                            </select>
                                                        @elseif($data->pallet_without_pallet === 'Without pallet')
                                                            <select onchange="update_price()" class="form-control s-t pal_np_val">
                                                                <option selected value="nopallet">No Pallet</option>
                                                            </select>
                                                        @else
                                                            <select onchange="update_price()" class="form-control s-t pal_np_val">
                                                                <option value="pallet">Pallet</option>
                                                                <option selected value="nopallet">No Pallet</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-lg d-flex align-content-between flex-wrap form-group">
                                                <div class="row">
                                                    <div class="col-12 d-flex align-items-end" style="color:#d9d9d9;font-size: 0.875rem;margin-bottom: 0.5rem;">Quantity</div>
                                                    <div class="col-12 d-flex align-items-end moq_block">
                                                        <select onchange="update_price()" class="form-control s-t q_val ">
                                                            @for($i=$data->moc_1_1;$i<=$data->moc_3_1;$i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-lg d-flex align-items-center justify-content-center flex-wrap">
                                                <div class="row">
                                                    <img style="height:40px;" class="img-fluid" src="/public/img/label.png" alt=""><span style="position: absolute; font-size: 1.4rem;left: 55px;top: 20px; font-family: RalewaySemiBold"><span class="special_color">$</span><b class="final_price"></b></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-lg d-flex align-items-center flex-wrap">
                                                <div class="row">
                                                    <p style="margin: 0;margin-left: 1rem; margin-top: 0.5rem;font-size: 1rem"><span><b class="quantity"><?php
                                                                    if($data->in_stock == 1)  echo 'In Stock';
                                                                    if($data->pre_order == 1)  echo 'Pre-Order';
                                                                    if($data->active == 1)  echo 'Available';
                                                                    if($data->in_stock == 0 && $data->pre_order == 0 && $data->active == 0) echo 'Unavailable';
                                                                    ?></b></span></p>
                                                </div>
                                            </div>
                                            {{--<div class="" style="display: inline-block;position: relative; margin-right: 4.5rem;margin-bottom: 1rem;">--}}
                                                {{--<img style="height:50px;" class="img-fluid" src="/public/img/label.png" alt=""><span style="position: absolute; font-size: 1.4rem;left: 40px;top: 10px; font-family: RalewaySemiBold"><span class="special_color">$</span><b class="final_price"></b></span>--}}
                                                {{--<p style="margin: 0;margin-left: 1rem; margin-top: 0.5rem;font-size: 1.3rem">In Stock: <span><b class="quantity">{{$data->moc_1_1_p}}</b></span></p>--}}
                                            {{--</div>--}}
                                        </div>
                                        <p style="font-family: RalewayRegular;font-size: 1.1rem;"><?php echo $data->descr;?> </p>
                                        <p style="font-family: RalewayRegular;font-size: 1.1rem;">FCL: {{$data->fcl}}</p>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-12">
                                        <p style="font-family: RalewayMedium;font-size: 1.2rem;" class="document"><img class="relat-doc insurance" src="/public/img/relat-doc.png" alt="">Related Documents</p>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    @foreach($data->documents as $key=>$document)
                                        <div class="col-lg-6 col-12 ">
                                            <div class="download-doc">
                                                <a class="special_color" href="{{$document->filename}}" download><img class="img-fluid" src="/public/img/pdf-download.png" alt=""><?php
                                                    $link_explode = explode('/',$document->filename);
                                                    $last_item = $link_explode[count($link_explode)-1];
                                                    $explode_dot = explode('.',$last_item);
                                                    ?>
                                                    {{$explode_dot[0]}}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row m-0 add_to_cart" style="display: none">
                                    <div class="col text-center">
                                        <button style="padding-left: 5.625rem;padding-right: 5.625rem;" class="btn btn-success btn-add btn_submit" onclick="add_to_cart()">Add to Cart</button>
                                    </div>
                                </div>
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
    <script>

        var pallet_count_global = 0;
        var quantity_glob = 0;
        var selected_type = '';
        var packaging_name = {
            'type1' : '{{(!empty($data->type_of_packaging1))?$data->type_of_packaging1:'-'}}',
            'type2' : '{{(!empty($data->type_of_packaging2))?$data->type_of_packaging2:'-'}}',
            'type3': '{{(!empty($data->type_of_packaging3))?$data->type_of_packaging3:'-'}}'
        };
        var packaging_price = {
            'type1' : '{{(!empty($data->type_of_packaging1_price))?$data->type_of_packaging1_price:'0'}}',
            'type2' : '{{(!empty($data->type_of_packaging2_price))?$data->type_of_packaging2_price:'0'}}',
            'type3': '{{(!empty($data->type_of_packaging3_price))?$data->type_of_packaging3_price:'0'}}'
        };
        var pallet_capacity = {
            'type1':'{{(!empty($data->pallet_capacity_for_packaging_type_1))?$data->pallet_capacity_for_packaging_type_1:'0'}}',
            'type2':'{{(!empty($data->pallet_capacity_for_packaging_type_2))?$data->pallet_capacity_for_packaging_type_2:'0'}}',
            'type3':'{{(!empty($data->pallet_capacity_for_packaging_type_3))?$data->pallet_capacity_for_packaging_type_3:'0'}}'
        };

        var prices = {
            'type1':'{{(!empty($data->price_prod_plus_packaging1))?$data->price_prod_plus_packaging1:'0'}}',
            'type2':'{{(!empty($data->price_prod_plus_packaging2))?$data->price_prod_plus_packaging2:'0'}}',
            'type3':'{{(!empty($data->price_prod_plus_packaging3))?$data->price_prod_plus_packaging3:'0'}}'
        };

        var moqs = {
            'type1':{
                'q1':'{{(!empty($data->moq_1_1))?$data->moq_1_1:'0'}}',
                'q2':'{{(!empty($data->moq_2_1))?$data->moq_2_1:'0'}}',
                'q3':'{{(!empty($data->moq_3_1))?$data->moq_3_1:'0'}}'
            },
            'type2':{
                'q1':'{{(!empty($data->moq_1_2))?$data->moq_1_2:'0'}}',
                'q2':'{{(!empty($data->moq_2_2))?$data->moq_2_2:'0'}}',
                'q3':'{{(!empty($data->moq_3_2))?$data->moq_3_2:'0'}}'
            },
            'type3':{
                'q1':'{{(!empty($data->moq_1_3))?$data->moq_1_3:'0'}}',
                'q2':'{{(!empty($data->moq_2_3))?$data->moq_2_3:'0'}}',
                'q3':'{{(!empty($data->moq_3_3))?$data->moq_3_3:'0'}}'
            }
        };
        update_price();

        function update_price()
        {
            var pallet_count = 0;
            var final_price = 0;
            var pallet_price = parseFloat('{{$pallet_price}}');
            var type_packaging = $('.type_val').val();
            var pallet = $('.pal_np_val').val();
            var quantity = $('.q_val').val();
            quantity_glob = quantity;
            if (quantity>parseFloat(moqs[type_packaging]['q1']) && quantity<parseFloat(moqs[type_packaging]['q2'])){
                final_price+= parseFloat(prices['type1']) * quantity;
                selected_type = 'type1';
            }else if(quantity>=parseFloat(moqs[type_packaging]['q2']) && quantity<parseFloat(moqs[type_packaging]['q3'])){
                final_price+= parseFloat(prices['type2']) * quantity;
                selected_type = 'type2';
            }else{
                final_price+= parseFloat(prices['type3']) * quantity;
                selected_type = 'type3';
            }

            if (pallet == 'pallet' && (pallet_price!=0 || pallet_price!=undefined)) {
                pallet_count = Math.ceil(quantity/pallet_capacity[type_packaging]);
                pallet_count_global = pallet_count;
                final_price += pallet_count * pallet_price;
            }

            if(final_price!='' || final_price!=0 || final_price!='0' || final_price!=undefined){
                $('.final_price').html(final_price);
                $('.add_to_cart').css('display','block');
            }else{
                $('.add_to_cart').css('display','none');
            }
        }



        function update_quantity(type)
        {
            var html = '';
            switch ($(type).val()) {
                case 'type1':
                    html = '<select onchange="update_price()" class="form-control s-t q_val">\n';
                    @for($i=$data->moc_1_1;$i<=$data->moc_3_1;$i++)
                        html+='<option value="{{$i}}">{{$i}}</option>';
                    @endfor
                        html+='                                                    </select>';
                    $('.moq_block').html(html);
                    break;
                case 'type2':
                    html = '<select onchange="update_price()" class="form-control s-t q_val">\n';
                    @for($i=$data->moc_1_2;$i<=$data->moc_3_2;$i++)
                        html+='<option value="{{$i}}">{{$i}}</option>';
                    @endfor
                        html+='                                                    </select>';
                    $('.moq_block').html(html);
                    break;
                case 'type3':
                    html = '<select onchange="update_price()" class="form-control s-t q_val">\n';
                    @for($i=$data->moc_1_3;$i<=$data->moc_3_3;$i++)
                        html+='<option value="{{$i}}">{{$i}}</option>';
                    @endfor
                        html+='                                                    </select>';
                    $('.moq_block').html(html);
                    break;
            }
            $('.final_price').html('');
            update_price();
        }

        var slideIndex = 1;
        showDivs(slideIndex);


        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function currentDiv(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length}
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
            }
            x[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " w3-opacity-off";
        }

        function add_to_cart() {
            var products_id = '{{$data->id}}';
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/user/product/add_to_cart",
                type:"POST",
                data:{
                    token:'{{\App\Model\Sessions::get_token()}}',
                    quantity:$('.q_val').val(),
                    pallet_type:$('.pal_np_val').val(),
                    packaging_type:$('.type_val').val(),
                    packaging_type_name:packaging_name[$('.type_val').val()],
                    amount:$('.final_price').html(),
                    unit_price:prices[selected_type],
                    quantity_decr_key:pallet_count_global,
                    products_id:products_id,
                    quantity_val:quantity_glob
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',2000);
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

        function sweet_modal(text,type,time) {
            $.sweetModal({
                content: text,
                icon: type,
                timeout:time
            });
        }

    </script>
@endsection
