@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
    <link rel="stylesheet" href="/public/css/admin/w3-style.css">
    <style>
        .s-t{
            height: 2.6875rem!important;
            -webkit-appearance: menulist!important;
        }
    </style>
@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
    @include('admin.sidebar')
    <main class="main">
        <div class="container-fluid main_container_fluid">
            <div class="card box-shadow">
                <div class="card-header"
                     style="padding-top: 0.9375rem;padding-bottom: 0.9375rem;border-radius: 0;">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h5 class="d-flex align-items-center" style="margin-bottom: 0;font-size: 1.125rem;">
                                <button onclick='location.href="/panel/admin/catalog"' class="btn_back d-flex align-items-center"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button>
                                <a href="/panel/admin/catalog" style="color:#4c6897;">Catalogue </a><span style="padding-right:5px;padding-left:5px;">|</span><span> {{$data['product_name']}}</span></h5>
                        </div>
                        @if(in_array($admin_role,['admin','super_admin','purchase']))
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            <button onclick='location.href="/panel/admin/product/edit/{{$data['id']}}"' class="btn_orange"><img src="/public/img/admin/ico_edit.png" alt=""></button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-12 col-xl-3">
                            <div class="w3-content">
                                @foreach($data['photos'] as $photo)
                                    <img class="mySlides" src="{{$photo->filename}}"  style="width: 100%;height:100%;margin: 0px auto;display: block; border:1px solid #d1d1d1;">
                                @endforeach

                                <div class="w3-row-padding w3-section">
                                    <?$i=1;?>
                                    @foreach($data['photos'] as $photo)
                                        <div class="w3-col s3 text-center">
                                            <img class="demo w3-opacity w3-hover-opacity-off img-slider" src="{{$photo->filename}}"  onclick="currentDiv('{{$i}}')">
                                        </div>
                                    <?$i++;?>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h3><b>{{$data['product_name']}}</b> <span style="font-size: 1.125rem">{{$data['specification']}}</span> </h3>
                            {{--<p class="m-0" style="font-size:1.125rem;color:#646464;">Specification {{$data->specification}}</p>--}}
                            {{--<p class="m-0" style="font-size:1.125rem;color:#646464;">Specification</p>--}}
                            <p style="font-size:1.125rem;color:#646464;margin-bottom: 3rem;">{{$data['category']}} / by <span style="color:#4c6897;">{{$data['brand']}}</span></p>
                            {{--<div class="price" style="position: relative; display: inline-block;margin-right: 0.9375rem;margin-left: -0.625rem;">--}}
                                {{--<img src="/public/img/admin/back_price.png" alt="" style="width: 11.25rem;height: 4rem;">--}}
                                {{--<span style="position: absolute;font-size: 1.875rem;left: 2.5rem;top: 0.6rem;"><b><span style="color:#4c6897;">$</span>{{$data['price']}}</span></b>--}}
                            {{--</div>--}}
                            {{--<p class="stock" style="display: inline-block;color:#646464;font-size:1.25rem;">--}}
                                {{--In Stock: <b style="color:black;">{{$data['in_stock']}}</b>--}}
                            {{--</p>--}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-4 col-lg d-flex align-content-between flex-wrap form-group">
                                            <div class="row">
                                                <div class="col-12 d-flex align-items-end" style="color:#d9d9d9;font-size: 0.875rem;margin-bottom: 0.5rem;">Packaging Type</div>
                                                <div class="col-12 d-flex align-items-end">
                                                    <select onchange="update_quantity(this)" class="form-control s-t type_val">
                                                        @if(!empty($data->type_of_packaging1))
                                                            <option selected value="type1">{{$data->type_of_packaging1}}</option>
                                                        @endif
                                                        @if(!empty($data->type_of_packaging2)  && !empty($data->moc_1_2) && !empty($data->moc_2_2) && !empty($data->moc_3_2))
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

                                        <div class="col-sm-4 col-lg d-flex align-content-between flex-wrap form-group">
                                            <div class="row">
                                                <div class="col-12 d-flex align-items-end" style="color:#d9d9d9;font-size: 0.875rem;margin-bottom: 0.5rem;">Quantity</div>
                                                <div class="col-12 d-flex align-items-end moq_block">
                                                    <select onchange="update_price()" class="form-control s-t q_val">
                                                        @for($i=$data->moc_1_1;$i<=$data->moc_3_1;$i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-lg d-flex align-content-between flex-wrap form-group">
                                            <div class="row">
                                                <div class="col-12 d-flex align-items-end" style="color:#d9d9d9;font-size: 0.875rem;margin-bottom: 0.5rem;">Price</div>
                                                <div class="col-12 d-flex align-items-end">$<span class="final_price"></span></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-lg d-flex align-content-between flex-wrap form-group">
                                            <div class="row">
                                                <div class="col-12 d-flex align-items-end" style="color:#d9d9d9;font-size: 0.875rem;margin-bottom: 0.5rem;">Status</div>
                                                <div class="col-12 d-flex align-items-end"><?php
                                                    if($data->in_stock == 1)  echo 'In Stock';
                                                    if($data->pre_order == 1)  echo 'Pre-Order';
                                                    if($data->active == 1)  echo 'Available';
                                                    if($data->in_stock == 0 && $data->pre_order == 0 && $data->active == 0) echo 'Unavailable';
                                                ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p style="margin:10px 0px; font-size:14px" class="RalewayRegular"><?php echo $data['descr']?></p>
                            <p style="margin:10px 0px; font-size:14px" class="RalewayRegular">FCL: {{$data->fcl}}</p>
                        </div>
                    </div>

                    <p style="margin-top: 10px;"><img src="/public/img/admin/ico_info.png" alt=""><span style="padding-left:8px;">Related Documents</span></p>
                    <hr>
                    <div class="row">
                        @if(in_array($admin_role,['super_admin','admin','customer_service','purchase','purchase_assistant']))
                            @foreach($data->documents as $key=>$document)
                                <div class="col-lg-6 col-12 ">
                                    <div class="download-doc">
                                        <a class="special_color" href="{{$document->filename}}" download><img class="img-fluid" src="/public/img/pdf-download.png" alt="">
                                            <?php
                                                $link_explode = explode('/',$document->filename);
                                                $last_item = $link_explode[count($link_explode)-1];
                                                $explode_dot = explode('.',$last_item);
                                            ?>
                                            {{$explode_dot[0]}}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script>
        var selected_type = '';
        var pallet_count_global = 0;
        var quantity_glob = 0;
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

                $('.final_price').html(parseFloat(final_price.toFixed(2)));
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
        $(document).ready(function () {
            $(".header_text").html('Catalogue');
        });
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
    </script>
@endsection