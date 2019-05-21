@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
    <style>
        .chk-all{
            border-radius: 0;
            width: 1.1875rem;
            height: 1.1875rem;
            border: 0.0625rem solid #c1c1c1;
            outline: none;
            box-sizing: border-box;
            display: inline-block;
            background: white;
        }
        .dropdown-item{
            width: 98%!important;
            margin-left: 1px;
        }
    </style>
@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
        @include('admin.sidebar')
        <main class="main">
            <div class="container-fluid main_container_fluid catalog-tabs">
                <ul class="nav nav-tabs" role="tablist" style="font-family: RalewaySemiBold;">
                    <li class="nav-item" style="margin-left: 0.4375rem;">
                        <a class="nav-link  nav_catalog products active" onclick="set_tab('products')" id="products-tab" href="#products" role="tab" data-toggle="tab">Products</a>
                    </li>
                    @if($admin_role!='purchase_assistant')
                        <li class="nav-item">
                            <a class="nav-link nav_catalog prizes" onclick="set_tab('prizes')" id="prizes-tab"  href="#prizes" role="tab" data-toggle="tab">Prizes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav_catalog prices" onclick="set_tab('prices')" id="prices-tab"  href="#prices" role="tab" data-toggle="tab">Price components</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav_catalog loading_ports" onclick="set_tab('loading_ports')" id="loading_ports-tab"  href="#loading_ports" role="tab" data-toggle="tab">Loading Ports</a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content bg-white box-shadow">
                    <div role="tabpanel" class="tab-pane fade" id="prices">
                        <div class="card">
                            <div class="card-header" style="padding-top:0.9375rem;padding-bottom: 0.9375rem;padding-right: 0.625rem;padding-left: 1.25rem;border-radius: 0;">
                                <form class="price_components">
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                            <div class="col text-center" style="margin-bottom: .9rem;">
                                                <p style="margin:0;font-size: 1.125rem" class="RalewayRegular text-center">*Pallet Price ($)</p>
                                            </div>
                                            <div class="col  form-group" style="margin-bottom: .97rem;">
                                                <input maxlength="75" type="text" name="pallet_price" value="{{$p_c['pallet_price']}}" class="itemeach form-control check_space" placeholder="*Pallet Price" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                            <div class="col text-center" style="margin-bottom: .9rem;">
                                                <p style="margin:0;font-size: 1.125rem" class="RalewayRegular text-center">*Insurance (%)</p>
                                            </div>
                                            <div class="col  form-group" style="margin-bottom: .97rem;">
                                                <input maxlength="75" type="text" name="insurance" value="{{$p_c['insurance']}}" class="itemeach form-control check_space" placeholder="*Insurance (%)" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                            <div class="col text-center" style="margin-bottom: .9rem;">
                                                <p style="margin:0;font-size: 1.125rem" class="RalewayRegular text-center">*Freight ($)</p>
                                            </div>
                                            @foreach($price_components as $component)
                                                @if(!in_array($component->type,['insurance','pallet_price']))
                                                    <div class="col  form-group" style="margin-bottom: .97rem;">
                                                        <input maxlength="75" type="text" name="{{$component->type}}" value="{{$component->value}}" class="itemeach form-control check_space" placeholder="*{{$component->title}}" required>
                                                        <a href="#remove" onclick="delete_region('{{$component->id}}')" style="color:#f15409;line-height: 40px;margin-left: 10px;">Remove</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn_page btn_submit"><span>Save</span></button>
                                        <button type="button" data-toggle="modal" data-target="#regione_add" class="btn_page_orange btn_orders btn_submit"><span>Add Region</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="prizes">
                        <div class="card">
                            <div class="card-header" style="padding-top:0.9375rem;padding-bottom: 0.9375rem;padding-right: 0.625rem;padding-left: 1.25rem;border-radius: 0;">
                                <div class="row">
                                        <div class="col">
                                            <h5 class="d-flex align-items-center" style="margin-bottom: 0; font-size: 1.125rem;">PRIZES
                                                @if($admin_role!='sales' && $admin_role!='purchase_assistant')
                                                    <button data-toggle="modal" data-target="#myModal_prize" class="btn_blue d-flex align-items-center"><img src="/public/img/admin/ico_plus.png" alt="" style="width:0.9375rem;height:0.9375rem;vertical-align: -1px;"></button>
                                                @endif
                                            </h5>
                                        </div>
                                    <div class="col-5" id="filter_global" style="max-width: 46.666667%;flex: 0 0 46.666667%;-webkit-flex: 0 0 46.666667%;">
                                        <form action="" method="GET" class="pull-xs-right search_prize_form" style="display:flex;">
                                            <input name="find_by_prize" value="<?php if(empty($_GET['find_by_prize'])){ echo '';} else {echo  $_GET['find_by_prize'];} ?>" type="search" id="global_filter_prize" placeholder="Search results: ..." class="form-control search global_filter" /><span id="search_btn_prize" style="float:right; background:#4c6897;border:0.0625rem solid #d7d7d7;border-left:none;width: 2.5rem;height: 2.0625rem;text-align:center;"><img
                                                       src="/public/img/admin/ico_search.png" alt="" style="width:1.125rem;height:1.125rem;vertical-align:-0.375rem;">
                                            </span>
                                            <input id="hide_search_prize" style="display: none;" type="submit" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block" style="padding-right:0;padding-left:0;">
                                <div class="table-responsive-md">
                                    <table class="table table-striped" id="mytable_prize">
                                        <thead>
                                        <tr>
                                            <th class="focus-none" style="width:1%!important;">
                                                <div class="d-flex align-items-center">
                                                    <div class="dropdown" style="width: 3.75rem;">
                                                        <input onclick="select_all_input_prize(this)" type="checkbox" name=g2 id="chk-all-prize" class="chk_prize chk_input_prize" style="position: absolute;top: 6px;left: 5px;width: 1.1875rem;height: 1.1875rem;border: 0.0625rem solid #c1c1c1;outline: none;box-sizing: border-box;display:none;background: white;">
                                                        <input hidden onclick="select_all_input_prize(this)" type="checkbox" name=g2 id="chk-all-prize" class="chk_prize chk_input_prize">
                                                        <span id="check_input_prize" class="span_selected" style="position: absolute;top: 6px;left: 5px;width: 1.1875rem;height: 1.1875rem;border: 0.0625rem solid #c1c1c1;outline: none;box-sizing: border-box;display: inline-block;background: white;"></span>
                                                        <label style="margin: 0px;margin-right: 2.375rem;padding-left: 1.775rem;background: #f7f7f7;padding-bottom: 0.125rem;padding-top: 0.375rem;padding-right: 0.375rem;border: 0.0625rem solid rgb(193, 193, 193);" id="dropdownMenuTableCatalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span style="margin-left: 0.3125rem;vertical-align: 0.1875rem;"><i class="fas fa-angle-down"></i></span></label>
                                                        @if(!in_array($admin_role,['sales','purchase','purchase_assistant']))
                                                            <div class="dropdown-menu dropdownMenuTableCatalog dropdown_prize" aria-labelledby="dropdownMenuTableCatalog">
                                                                <button class="dropdown-item" type="button" onclick="sel_del_prize()">Delete Selected</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </th>
                                            <th class="" style="width:3%;"></th>
                                            <th class="RalewaySemiBold focus-none" style="font-size:1.125rem;cursor:default;width: 15%;">Prize Title</th>
                                            <th class="RalewaySemiBold focus-none" style="font-size:1.125rem;cursor:default;">Description</th>
                                            <th class="text-center RalewaySemiBold focus-none" style="font-size:1.125rem;cursor:default;width:15%;">Points</th>
                                            <th class="text-center RalewaySemiBold focus-none" style="width:15%;font-size:1.125rem;cursor:default;">End Date</th>
                                            <th class="text-center RalewaySemiBold focus-none" style="width:15%;font-size:1.125rem;cursor:default;">Rate</th>
                                            @if($admin_role!='sales' && $admin_role!='purchase_assistant')
                                                <th class="focus-none" style="width:15%;"></th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($prizes as $prize)
                                            <tr class="itemprod itemprod">
                                                <td >
                                                    <label style="margin-bottom: 0;margin-left: 5px;">
                                                        <input type="checkbox" hidden class="selected_prize " data-id="{{$prize->id}}">
                                                        <span class="span_selected"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <img src="{{$prize->src}}" alt="" style="width: 5.5rem;height: 5.5rem;border: 0.0625rem solid #cacaca;">
                                                </td>
                                                <td class="RalewayMedium" style="font-size:1.375rem;color:#4c6897;" >
                                                    {{$prize->title}}
                                                </td>
                                                <td style="font-size:1.125rem;">
                                                    {{$prize->descr}}
                                                </td>
                                                <td class=" text-center RalewaySemiBold" style="font-size:1.25rem;">
                                                    <span style="color:#4c6897;">{{$prize->points}}</span>
                                                </td>
                                                <td class="text-center RalewayMedium">
                                                    {{$prize->end_date}}
                                                </td>
                                                <td class="text-center RalewayMedium">
                                                    {{$prize->rate}}
                                                </td>
                                                @if($admin_role!='sales' && $admin_role!='purchase_assistant')
                                                    <td class="text-center" style="font-size: 1.125rem;">
                                                        <button data-title="{{$prize->title}}" data-id="{{$prize->id}}" data-src="{{$prize->src}}" data-rate="{{$prize->rate}}" data-descr="{{$prize->descr}}" data-points="{{$prize->points}}" data-end-date="{{$prize->end_date}}" onclick="set_modal_data(this)" data-toggle="modal" data-target="#myModal_prize_edit" class="btn_orange fix-btn-table"><img src="/public/img/admin/ico_edit.png" alt=""></button>
                                                        @if($admin_role!='purchase')
                                                            <button onclick="delete_prize(['{{$prize->id}}'])" href="#delete" class="btn_gray" >
                                                            <img src="/public/img/admin/ico_delete.png" alt=""></button>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane tab_first" id="products">
                        <div class="card">
                            <div class="card-header" style="padding-top:0.9375rem;padding-bottom: 0.9375rem;padding-right: 0.625rem;padding-left: 1.25rem;border-radius: 0;">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="d-flex align-items-center" style="margin-bottom: 0; font-size: 1.125rem;">PRODUCTS
                                            @if(in_array($admin_role,['super_admin','purchase','customer_service','admin']))
                                                <button  onclick='location.href="/panel/admin/add-products"' class="btn_blue d-flex align-items-center"><img src="/public/img/admin/ico_plus.png" alt="" style="width:0.9375rem;height:0.9375rem;vertical-align: -1px;"></button>
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="col d-flex justify-content-end align-items-center">
                                        <span class="RalewaySemiBold" style="margin-right:10px;">XLS FILE</span>
                                        <button  class="btn_orange fix-btn-table"><img src="/public/img/admin/ico_plus.png" alt="" data-toggle="modal" data-target="#myModal_documents_xls"></button>
                                        <button onclick="window.location='/xls/get'" class="btn_green" ><img src="/public/img/admin/ico_download.png" alt="" ></button>
                                    </div>
                                    <div class="col-5" id="filter_global" style="max-width: 46.666667%;flex: 0 0 46.666667%;-webkit-flex: 0 0 46.666667%;">
                                        <form action="/panel/admin/catalog" method="GET" class="pull-xs-right search_cat" style="display:flex;">
                                            <input name="find_by" value="<?php if(empty($_GET['find_by'])){ echo '';} else {echo  $_GET['find_by'];} ?>" type="search" id="global_filter" placeholder="Search results: ..." class="form-control search global_filter" /><span id="search_btn_product" style="float:right; background:#4c6897;border:0.0625rem solid #d7d7d7;border-left:none;width: 2.5rem;height: 2.0625rem;text-align:center;"><img
                                                        src="/public/img/admin/ico_search.png" alt="" style="width:1.125rem;height:1.125rem;vertical-align:-0.375rem;"></span>
                                            <input id="hide_search_product" style="display: none;" type="submit" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block" style="padding-right:0;padding-left:0;">
                                @if($admin_role=='super_admin' || $admin_role=='purchase' || $admin_role=='sales' || $admin_role=='admin' || $admin_role=='customer_service')
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col fix-btn gr_btn" style="display:none;">
                                                        @if(!in_array($admin_role,['sales','admin','purchase','customer_service','purchase_assistant']))
                                                            <button class="btn_page RalewayMedium catalog-btn" style="background-color: #646464;border-bottom: 0.2em solid #585858;margin-right: 0.625rem;margin-bottom:1rem;" onclick="set_multi_status(0,2)">Delete Selected</button>
                                                        @endif
                                                        <button class="btn_page RalewayMedium catalog-btn" style="background-color: #ff0000;border-bottom: 0.2em solid #e00000;margin-right: 0.625rem;margin-bottom:1rem;" onclick="set_multi_status(0,0)">Mark as Inactive</button>
                                                        <button class="btn_page RalewayMedium catalog-btn" style="background-color: #838383;border-bottom: 0.2em solid #797979;margin-bottom:1rem;" onclick="set_multi_status(0,1)">Mark as Absent</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="table-responsive-md">
                                    <table cellspacing="0" class="table table-striped" id="mytable">
                                        <thead>
                                        <tr>
                                            <th data-orderable="false" class="focus-none" style="width:1%!important;">
                                                <div class="dropdown" style="width: 3.75rem;">
                                                    <input hidden onclick="select_all_input(this)" type="checkbox" name=g1 id="chk-all-product" class="chk-all chk_input_product input_1">
                                                    <span id="check_input_product" class="span_selected" style="position: absolute;top: 6px;left: 5px;width: 1.1875rem;height: 1.1875rem;border: 0.0625rem solid #c1c1c1;outline: none;box-sizing: border-box;display: inline-block;background: white;"></span>
                                                    <label style="margin: 0px;margin-right: 2.375rem;padding-left: 1.775rem;background: #f7f7f7;padding-bottom: 0.125rem;padding-top: 0.375rem;padding-right: 0.375rem;border: 0.0625rem solid rgb(193, 193, 193);" id="dropdownMenuTableCatalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span style="margin-left: 0.3125rem;vertical-align: 0.1875rem;"><i class="fas fa-angle-down"></i></span></label>
                                                    <div class="dropdown-menu dropdownMenuTableCatalog" aria-labelledby="dropdownMenuTableCatalog" style="transform: translate3d(0px, 28px, 0px)!important;">
                                                        <button class="dropdown-item" type="button" onclick="select_inactive()">Select Active</button>
                                                        <button class="dropdown-item" type="button" onclick="select_absent()">Select In Stock</button>
                                                    </div>
                                                </div>
                                            </th>
                                            <th class="focus-none" style="width:3%;"></th>
                                            <th class="RalewaySemiBold focus-none" style="font-size:1.125rem;cursor:pointer;width:500px;">Product Name</th>
                                            <th class="text-center RalewaySemiBold focus-none" style="font-size:1.125rem;cursor:pointer;">Brand</th>
                                            @if($admin_role=='super_admin' || $admin_role=='sales' || $admin_role=='purchase' || $admin_role=='customer_service')
                                                <th data-orderable="false" class="text-center RalewaySemiBold focus-none" style="font-size:1.125rem;cursor:default;">Mark as</th>
                                                @if(!in_array($admin_role,['sales','customer_service']))
                                            <th data-orderable="false" class="focus-none" style="width:15%;"></th>
                                                    @endif
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr class="itemprod itemprod{{$product->id}}">
                                                <td >
                                                    <label style="margin-bottom: 0;margin-left: 5px;">
                                                        <input type="checkbox" hidden class="selected_product input_1" data-id="{{$product->id}}">
                                                        <span class="span_selected"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <img src="{{$product->photo}}" alt="" style="width: 5.5rem;height: 5.5rem;border: 0.0625rem solid #cacaca;">
                                                </td>
                                                <td style="font-size:1.375rem;" >
                                                    <a href="/panel/admin/view-products/{{$product->id}}" class="RalewayRegular">{{$product->product_name}}</a>
                                                </td>
                                                <td class="text-center RalewaySemiBold" style="font-size:1.125rem;color:#4c6897;">
                                                    {{$product->brand}}
                                                </td>
                                                @if($admin_role=='super_admin' || $admin_role=='sales' || $admin_role=='admin' || $admin_role=='purchase' || $admin_role=='customer_service')
                                                    <td class=" text-center">
                                                        <div class="btn_actives{{$product->id}}">
                                                            @if($product['active']=='1')
                                                                <button data-id="{{$product->id}}" onclick="status_set(['{{$product->id}}'],'0','0')" style="margin-bottom: 0.3125rem;background-color: green!important" class="btn_inactive RalewayBold btn_submit">Available</button>
                                                            @else
                                                                <button data-id="{{$product->id}}" onclick="status_set(['{{$product->id}}'],'1','0')" style="margin-bottom: 0.3125rem;" class="btn_absent RalewayBold btn_submit">Available</button>
                                                            @endif
                                                        </div>
                                                        <div class="btn_absents{{$product->id}}">
                                                            @if($product->absent=='1')
                                                                <button data-id="{{$product->id}}" onclick="status_set(['{{$product->id}}'],'0','1')" style="margin-bottom: 0.3125rem;" class="btn_absent RalewayBold btn_submit">IN STOCK</button>
                                                            @else
                                                                <button data-id="{{$product->id}}" onclick="status_set(['{{$product->id}}'],'1','1')" style="margin-bottom: 0.3125rem;background-color: green!important" class="btn_absent RalewayBold btn_submit">IN STOCK</button>
                                                            @endif
                                                        </div>
                                                        <div class="btn_pre_order{{$product->id}}">
                                                            @if($product->pre_order=='1')
                                                                <button data-id="{{$product->id}}" onclick="status_set(['{{$product->id}}'],'0','2')" style="background-color: green!important" class="btn_absent RalewayBold btn_submit">Pre-Order</button>
                                                            @else
                                                                <button data-id="{{$product->id}}" onclick="status_set(['{{$product->id}}'],'1','2')" class="btn_absent RalewayBold btn_submit">Pre-Order</button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    @if(!in_array($admin_role,['sales','customer_service']))
                                                        <td class="text-center" style="font-size: 1.125rem;">
                                                            <button onclick='location.href="/panel/admin/product/edit/{{$product->id}}"' class="btn_orange fix-btn-table"><img src="/public/img/admin/ico_edit.png" alt=""></button>
                                                                @if(!in_array($admin_role,['admin','purchase']))
                                                                    <button href="#delete" onclick="delete_product(['{{$product->id}}'])" class="btn_gray">
                                                                    <img src="/public/img/admin/ico_delete.png" alt=""></button>
                                                                @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane tab_first" id="loading_ports">
                        <div class="card">
                            <div class="card-header" style="padding-top:0.9375rem;padding-bottom: 0.9375rem;padding-right: 0.625rem;padding-left: 1.25rem;border-radius: 0;">
                                <form class="loading_ports">
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col text-center" style="margin-bottom: .9rem;">
                                                <p style="margin:0;font-size: 1.125rem" class="RalewayRegular text-center">Loading Ports</p>
                                            </div>
                                            {{--@foreach($price_components as $component)--}}
                                                {{--@if(!in_array($component->type,['insurance','pallet_price']))--}}
                                                    {{--<div class="col  form-group" style="margin-bottom: .97rem;">--}}
                                                        {{--<input maxlength="75" type="text" name="{{$component->type}}" value="{{$component->value}}" class="itemeach form-control check_space" placeholder="*{{$component->title}}" required>--}}
                                                        {{--<a href="#remove" onclick="delete_region('{{$component->id}}')" style="color:#f15409;line-height: 40px;margin-left: 10px;">Remove</a>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn_page btn_submit"><span>Save</span></button>
                                        <button type="button" data-toggle="modal" data-target="#ports_add" class="btn_page_orange btn_orders btn_submit"><span>Add Loading Ports</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="modal fade" id="myModal_prize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">ADD NEW PRIZE</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form  class="createPrize">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-8 form-group" style="display: flex;padding-right: 6px;">
                                    <span class="ico_input d-flex align-items-center justify-content-center"><img src="/public/img/admin/ico_title.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;"></span>
                                    <input type="text" name="title"  class="form-control addon" placeholder="Prize Title" required>
                                </div>
                                <div class="col-4 pl-0">
                                    <input type="text" maxlength="6" required name="points" class="form-control" placeholder="*Points" onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group" style="display: flex;">
                                    <span class="ico_input d-flex align-items-center justify-content-center"><img src="/public/img/admin/ico_title.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;"></span>
                                    <input type="text" id="end_date" name="end_date"  class="form-control addon" placeholder="End date" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 form-group" style="display: flex;">
                                    <span class="ico_input d-flex align-items-center justify-content-center"><img src="/public/img/admin/ico_title.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;"></span>
                                    <input type="text" id="rate" name="rate"  class="form-control addon" placeholder="Rate" required>
                                </div>
                            </div>

                            <div class="form-group" style="display: flex;cursor: pointer;">
                                <div class="ico_input d-flex align-items-center justify-content-center"><img style="width: 1.6875rem;height: 1.375rem;margin-right: 0.45rem;margin-left: 0.5125rem;" src="/public/img/admin/ico_img.png" alt=""></div>
                                <input accept="image/png, image/jpeg" type="file"  name="myfile_img_prize"  class="inputfile inputfile-6" multiple required data-multiple-caption="{count} files selected">
                                <label  class="form-control addon" style="margin-bottom:0px;">
                                    <span style="font-size:1.125rem;width: auto;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach image</span>
                                </label>
                                <div class="d-flex align-items-center" style="border:0.125rem solid #aab4bc;border-radius: 0.25rem;margin-left: 0.375rem;background: #f2f2f2;cursor:pointer;"><strong style="width: 3.6rem;height: 3.44rem;color: black;text-align: center;font-size: 1.75rem;">...</strong></div>
                            </div>
                            <div class="form-group">
                                <span style="height: inherit;" class="ico_input d-flex align-items-center justify-content-center"><img src="/public/img/admin/doc.png" alt="" style="width: 1.4375rem;height: 1.5625rem;"></span>
                                <textarea name="descr" class="form-control form-textarea addon"  placeholder="Description"  required  cols="20" rows="4"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page btn_submit" value="Add Prize">
                            <button type="button" class="btn_page_orange btn_submit modal_hide" data-target="#myModal_prize" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal_prize_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">EDIT PRIZE</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="editPrize">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-8 form-group" style="display: flex;padding-right: 6px;">
                                    <span class="ico_input d-flex align-items-center justify-content-center"><img src="/public/img/admin/ico_title.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;"></span>
                                    <input type="text" name="title"  class="form-control addon title_modal" placeholder="Prize Title" required>
                                </div>
                                <div class="col-4 pl-0">
                                    <input type="text" required name="points" class="form-control points_modal" placeholder="*Points" onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group" style="display: flex;">
                                    <span class="ico_input d-flex align-items-center justify-content-center"><img src="/public/img/admin/ico_title.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;"></span>
                                    <input type="text" id="end_date_edit" name="end_date"  class="end_date_modal form-control addon" placeholder="End date" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group" style="display: flex;">
                                    <span class="ico_input d-flex align-items-center justify-content-center"><img src="/public/img/admin/ico_title.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;"></span>
                                    <input type="text" id="rate_edit" name="rate_modal"  class="rate_modal form-control addon" placeholder="Rate" required>
                                </div>
                            </div>
                            <input type="hidden" name="prize_id">
                            <div class="form-group" style="display: flex;cursor: pointer;">
                                <div class="ico_input d-flex align-items-center justify-content-center"><img style="width: 1.6875rem;height: 1.375rem;margin-right: 0.45rem;margin-left: 0.5125rem;" src="/public/img/admin/ico_img.png" alt=""></div>
                                <input accept="image/png, image/jpeg" type="file"  name="myfile_img_prize prize_modal"  class="inputfile inputfile-6" >
                                <label  class="form-control addon" style="margin-bottom:0px;">
                                    <span style="font-size:1.125rem;width: auto;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach image</span>
                                </label>
                                <div class="d-flex align-items-center" style="border:0.125rem solid #aab4bc;border-radius: 0.25rem;margin-left: 0.375rem;background: #f2f2f2;cursor:pointer;"><strong style="width: 3.6rem;height: 3.44rem;color: black;text-align: center;font-size: 1.75rem;">...</strong></div>
                            </div>
                            <div class="form-group">
                                <span style="height: inherit;" class="ico_input d-flex align-items-center justify-content-center"><img src="/public/img/admin/doc.png" alt="" style="width: 1.4375rem;height: 1.5625rem;"></span>
                                <textarea name="descr" class="form-control form-textarea addon descr_modal"  placeholder="Description"  required  cols="20" rows="4"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page btn_submit" value="Edit Prize">
                            <button type="button" class="btn_page_orange btn_submit modal_hide" data-target="#myModal_prize" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal_documents_xls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel2">DOWNLOAD FILE</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="xls_upload">
                        <div class="modal-body">
                            <div class="form-group" style="display: flex;cursor: pointer;">
                                {{--//accept=".xlsx .xls"--}}
                                <input type="hidden" name="token" value="{{$token}}">
                                <input  type="file" name="xls_file"  class="inputfile xls_file inputfile-6" required>
                                <label  class="form-control" style="margin-bottom:0px;">
                                    <span style="font-size:1.125rem;width: auto;display: inline-block;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;vertical-align: middle;font-weight: 100;padding-top: 0.9625rem;color: #a3a3a3;">Attach file</span>
                                </label>
                                <div class="d-flex align-items-center" style="border:0.125rem solid #aab4bc;border-radius: 0.25rem;margin-left: 0.375rem;background: #f2f2f2;cursor:pointer;"><strong style="width: 3.6rem;height: 3.44rem;color: black;text-align: center;font-size: 1.75rem;">...</strong></div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page btn_submit" value="Download">
                            <button type="button" class="btn_page_orange modal_hide2 btn_submit" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="regione_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel2">Create Regione</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="region_create">
                        <div class="modal-body">
                            <div class="form-group" style="display: flex;cursor: pointer;">
                                <input type="hidden" name="token" value="{{$token}}">
                                <input type="text" placeholder="Title" name="title" class="form-control" required>
                            </div>
                            <div class="form-group" style="display: flex;cursor: pointer;">
                                <input type="text" placeholder="Amount" name="value" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page btn_submit" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ports_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel2">Create Loading Ports</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="loading_ports_create">
                        <div class="modal-body">
                            <div class="form-group" style="display: flex;cursor: pointer;">
                                <input type="hidden" name="token" value="{{$token}}">
                                <input type="text" placeholder="Loading Ports" name="loading_ports_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page btn_submit" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button style="display:none;" class="modal_show" data-toggle="modal" data-target="#modal_documents_progress"></button>
    <button style="display:none;" class="modal_hide" data-dismiss="modal" data-target="#modal_documents_progress"></button>
    <div class="modal " id="modal_documents_progress" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center body_progress" style="padding: 15px!important">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="/public/js/datetime.js"></script>
    <script>
        function set_tab(id) {
            localStorage['tab_id'] = id;
        }
        $(document).ready(function () {
            if( localStorage['tab_id']!=undefined){
                $('.nav-link').removeClass('active');
                $('.tab-pane').removeClass('active');
                $('#'+localStorage['tab_id']).addClass('active');
                $('#'+localStorage['tab_id']).addClass('show');
                $('#'+localStorage['tab_id']+'-tab').addClass('active');
            }
        });

        function delete_region(id) {
            var token = '{{$token}}';
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url:"/api/admin/delete/region",
                    type:"POST",
                    data:{'id':id,'token':token},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        '_token' : '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success:function (data) {
                        console.log(data);
                        $('.chk-all').prop('checked',false);
                        $('.selected_product').prop('checked',false);
                        if(data.success==true) {
                            sweet_modal('Success', 'success', 1000);
                            setTimeout(function () {
                                window.location = '';
                            },1000);
                        }else{
                            sweet_modal(data.message, 'error', 2000);
                        }
                    },error:function(data){
                        sweet_modal('Something went wrong','error',1000);
                    }

                })
            });
        }

        $('.region_create').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url:"/api/admin/regione/create",
                type:"POST",
                data:formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                success:function (data) {
                    $('.close').click();
                    console.log(data);
                    $(".btn_submit").removeAttr('disabled');
                    if(data.success==true) {
                        sweet_modal('Success', 'success', 1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/catalog';
                        },1000);
                    }else{
                        sweet_modal(data.message, 'error', 3000);
                    }
                },error:function(data){
                    $('.close').click();
                    console.log(data);
                    $(".btn_submit").removeAttr('disabled');
                    sweet_modal('Something went wrong','error',3000);
                }

            })
        });


        $('.price_components').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url:"/api/admin/price_components/edit",
                type:"POST",
                data:formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                success:function (data) {
                    console.log(data);
                    $(".btn_submit").removeAttr('disabled');
                    if(data.success==true) {
                        sweet_modal('Success', 'success', 1000);
                    }else{
                        sweet_modal(data.message, 'error', 3000);
                    }
                },error:function(data){
                    $('.modal_hide').click();
                    console.log(data);
                    $(".btn_submit").removeAttr('disabled');
                    sweet_modal('Something went wrong','error',3000);
                }

            })
        });


        $('form.xls_upload').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url:"/api/admin/product/upload_xls",
                type:"POST",
                data:formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                success:function (data) {
                    console.log($('.xls_file').val());
                    $(".btn_submit").removeAttr('disabled');
                    if(data.success==true) {
                        console.log($('.xls_file').val());
                        $('.modal_hide2').click();
                        sweet_modal('Success', 'success', 1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/catalog';
                        },1000);
                    }else{
                        sweet_modal(data.message, 'error', 3000);
                    }
                },error:function(data){
                    console.log($('.xls_file').val());
                    $('.modal_hide').click();
                    console.log(data);
                    $(".btn_submit").removeAttr('disabled');
                    sweet_modal('Something went wrong','error',3000);
                }

            })
        });



        $(function(){
            $('#end_date').datetime({
                format:  'M/dd/yyyy',
                locale: 'en',
                // datetime: '09/24/2018'
                // datetime: Date.now(),
            })
            $('#end_date_edit').datetime({
                format:  'M/dd/yyyy',
                locale: 'en',
                // datetime: '09/24/2018'
                // datetime: Date.now(),
            })
        })

        @if(!empty($_GET['nav']) && $_GET['nav']=='prizes')
                $("#products").removeClass('active');
                $("#prizes").addClass('active');
                $("#prizes").removeClass('fade');
                $(".products").removeClass('active');
                $(".prizes").addClass('active');
        @endif
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            "non-empty-string-asc": function (str1, str2) {
                if(str1 == "")
                    return 1;
                if(str2 == "")
                    return -1;
                return ((str1 < str2) ? -1 : ((str1 > str2) ? 1 : 0));
            },

            "non-empty-string-desc": function (str1, str2) {
                if(str1 == "")
                    return 1;
                if(str2 == "")
                    return -1;
                return ((str1 < str2) ? 1 : ((str1 > str2) ? -1 : 0));
            }
        } );

        function set_modal_data(btn) {
            $('input[name="prize_id"]').val($(btn).attr('data-id'));
            $('.title_modal').val($(btn).attr('data-title'));
            $('.descr_modal').html($(btn).attr('data-descr'));
            $('.points_modal').val($(btn).attr('data-points'));
            $('.end_date_modal').val($(btn).attr('data-end-date'));
            $('.rate_modal').val($(btn).attr('data-rate'));
        }

        $('input').each(function () {
            $(this).prop('checked',false);
        })

        $(document).ready(function(){
            $("#global_filter_prize").keyup(function(){
                _this = this;

                $.each($("#mytable_prize tbody tr"), function() {
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }});
            });
        });
        $('form.search_prize_form').on('submit',function(e) {
            e.preventDefault();
        });

        $(document).ready(function(){
            $("#global_filter").keyup(function(){
                _this = this;

                $.each($("#mytable tbody tr"), function() {
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }});
            });
        });
        $('form.search_cat').on('submit',function(e) {
            e.preventDefault();
        });

        setInterval(function () {
            var i = 0;
            $('.input_1').each(function () {
                if($(this).prop('checked')) i++;
            });
            if(i>0) {
                $('.gr_btn').css('display','block')
            }else{
                $('.gr_btn').css('display','none')
            };
        },500);

        function select_all_input_prize(input) {
            if($(input).prop('checked')){
                select_all_prize();
            }else{
                unselect_all_prize();
            }
        }
        function select_all_input(input) {
            if($(input).prop('checked')){
                select_all();
            }else{
                unselect_all();
            }
        }
        $(document).ready(function () {
            $(".header_text").html('Catalogue');
        });

        function set_multi_status(value,type) {
            var array_id = [];

                $('.selected_product').each(function () {
                    if ($(this).prop('checked')) {
                        array_id.push($(this).attr('data-id'));
                    }
                });
            if(array_id.length!=0) {
                console.log(array_id);
                if (type == 0) {
                    status_set(array_id,0,0);
                } else if (type == 1) {
                    status_set(array_id,0,1);
                }else{
                    delete_product(array_id);
                }
            }else{
                console.log(array_id);
                sweet_modal('Please , select items! ', 'error', 2000);
            }
        }

        function status_set(products_id,value,type) {
            var token = '{{$token}}';
            console.log(value);
            if(type == 0){
                type = 'active';
            }else if(type == 1){
                type = 'absent';
            }else{
                type = 'pre_order';
            }
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/product/change_status",
                type:"POST",
                data:{products_id:products_id,token:token,type:type,value:value},
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                success:function (data) {
                    console.log(data);
                    $(".btn_submit").removeAttr('disabled');
                    if(data.success==true) {
                        sweet_modal('Success', 'success', 1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/catalog';
                        },1000);
                        $('.chk-all').prop('checked',false);
                        $('.selected_product').prop('checked',false);
                        var btn;
                        if(type=='active') {
                            if (value == '0') {
                                btn = '<button onclick="status_set([' + products_id + '],0,0)" style="margin-bottom: 0.3125rem;" class="btn_absent RalewayBold btn_submit">Available</button>';
                            } else {
                                btn = '<button onclick="status_set([' + products_id + '],1,0)" style="background-color: green!important" class="btn_inactive RalewayBold btn_submit">Available</button>';
                            }
                            for(var act_id in products_id) {
                                $('.btn_actives' + products_id[act_id]).html(btn);
                            }
                        }else if(type=='absent'){
                            if(value == '1') {
                                btn = '<button onclick="status_set(['+products_id+'],0,1)" style="\n' +
                                    '    margin-bottom: 0.3125rem;"  class="btn_absent RalewayBold btn_submit">IN STOCK</button>';
                            }else{
                                btn = '<button onclick="status_set(['+products_id+'],1,1)" style="\n' +
                                    '    margin-bottom: 0.3125rem;background-color: green!important" class="btn_absent RalewayBold btn_submit">IN STOCK</button>';
                            }
                            for(var abs_id in products_id) {
                                $('.btn_absents' + products_id[abs_id]).html(btn);
                            }
                        }else{
                            if(value == '1') {
                                btn = '<button onclick="status_set(['+products_id+'],0,2)"  style="background-color: green!important" class="btn_absent RalewayBold btn_submit">Pre-Order</button>';
                            }else{
                                btn = '<button onclick="status_set(['+products_id+'],1,2)" class="btn_absent RalewayBold btn_submit">Pre-Order</button>';
                            }
                            for(var abs_id in products_id) {
                                $('.btn_pre_order' + products_id[abs_id]).html(btn);
                            }
                        }
                    }else{
                        sweet_modal(data.message, 'error', 2000);
                    }
                },error:function(data){
                    console.log(data);
                    $(".btn_submit").removeAttr('disabled');
                    sweet_modal('Something went wrong','error',1000);
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

        function delete_product(array_id) {
            var token = '{{$token}}';
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url:"/api/admin/delete/product",
                    type:"POST",
                    data:{'products_id':array_id,'token':token},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        '_token' : '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success:function (data) {
                        console.log(data);
                        $('.chk-all').prop('checked',false);
                        $('.selected_product').prop('checked',false);
                        if(data.success==true) {
                            sweet_modal('Success', 'success', 1000);
                            setTimeout(function () {
                                window.location = location;
                            },1000);
                            for(var id in array_id) {
                                $('.itemprod' + array_id[id]).remove();
                            }
                        }else{
                            sweet_modal(data.message, 'error', 2000);
                        }
                    },error:function(data){
                        sweet_modal('Something went wrong','error',1000);
                    }

                })
            });
        }
        $(document).on('change', ".chk_input_product", function () {
            var $this = $(this), $chks = $($('[name="g1"]') ), $all = $chks.filter(".chk-all");

            if ($this.hasClass('chk-all')) {
                $chks.prop('checked', $this.prop('checked'));
            } else switch ($chks.filter(":checked").length) {
                case +$all.prop('checked'):
                    $all.prop('checked', false).prop('indeterminate', false);
                    break;
                case $chks.length - !!$this.prop('checked'):
                    $all.prop('checked', true).prop('indeterminate', false);
                    break;
                default:
                    $all.prop('indeterminate', true);
            }
        });
        $(document).on('change', ".chk_input_prize", function () {
            var $this_prize = $(this), $chks_prize = $($('[name="g2"]') ), $all_prize = $chks_prize.filter(".chk_prize");

            if ($this_prize.hasClass('chk_prize')) {
                $chks_prize.prop('checked', $this_prize.prop('checked'));
            } else switch ($chks_prize.filter(":checked").length) {
                case +$all_prize.prop('checked'):
                    $all_prize.prop('checked', false).prop('indeterminate', false);
                    break;
                case $chks_prize.length - !!$this_prize.prop('checked'):
                    $all_prize.prop('checked', true).prop('indeterminate', false);
                    break;
                default:
                    $all_prize.prop('indeterminate', true);
            }
        });


       function filterGlobal () {
           $('#mytable').DataTable().search(
               $('#global_filter').val()).draw();
       }
       $(document).ready(function() {
           $('#mytable').DataTable({
               responsive: true,
               "language": {
                   "zeroRecords": "There are no products to list",
                   "paginate": {
                       "next": ">",
                       "previous": "<"
                   }
               },
               "lengthMenu": [7],
               "pagingType": "simple_numbers"
           });
           $('input.global_filter').on( 'keyup click', function () {
               filterGlobal();
           } );

       } );
        
        function select_all() {
            $(".selected_product").each(function () {
                $(this).attr('checked','checked');
                $(this).prop('checked',true);
            })
        }
        function select_all_prize() {
            $(".selected_prize").each(function () {
                $(this).attr('checked','checked');
                $(this).prop('checked',true);
            })
        }

        function unselect_all() {
            $(".selected_product").each(function () {
                $(this).removeAttr('checked');
                $(this).prop('checked',false);
            });
        }
        function unselect_all_prize() {
            $(".selected_prize").each(function () {
                $(this).removeAttr('checked');
                $(this).prop('checked',false);
            });
        }

        function select_inactive() {
            $('.btn_inactive').each(function () {
                if($(this).html()!='ACTIVE'){
                    var id = $(this).attr('data-id');
                    $('.selected_product[data-id="'+id+'"]').attr('checked','checked');
                    $('.selected_product[data-id="'+id+'"]').prop('checked',true);
                }
            });
        }

        function select_absent() {
            $('.btn_absent').each(function () {
                if($(this).html()!='IN STOCK'){
                    var id = $(this).attr('data-id');
                    $('.selected_product[data-id="'+id+'"]').attr('checked','checked');
                    $('.selected_product[data-id="'+id+'"]').prop('checked',true);
                }
            });
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
        $('#check_input_prize').click(function(){
            $('#chk-all-prize').trigger('click');
            return false;
        });
        $('#check_input_product').click(function(){
            $('#chk-all-product').trigger('click');
            return false;
        });


        $('form.editPrize').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/admin/update_prize', true);
            xhr.onload = function() {
                console.log(this.response);
                var resp = JSON.parse(this.response);
                $(".btn_submit").removeAttr('disabled');
                if (resp.success == true) {
                    $('.modal_hide').click();
                    sweet_modal('Success','success',1000);
                    setTimeout(function () {
                        window.location = '/panel/admin/catalog?nav=prizes';
                    },1000);
                }else{
                    $(".modal_hide").click();
                    sweet_modal(resp.message,'error',2000);
                }
            };
            xhr.upload.onprogress = function(e) {
                $(".body_progress").html((event.loaded/1000000).toFixed(3) + 'mb / ' + (event.total/1000000).toFixed(3)+' mb');
            };
            var fd = new FormData();
            var file;
            if($('.editPrize input[type=file]')[0].files[0]){
                file = $('.editPrize input[type=file]')[0].files[0];
            }
            fd.append('prize_img', file);
            fd.append('descr', $('.descr_modal').val());
            fd.append('title', $('.title_modal').val());
            fd.append('points', $('.points_modal').val());
            fd.append('end_date', $('.end_date_modal').val());
            fd.append('rate', $('.rate_modal').val());
            fd.append('prize_id', $('input[name="prize_id"]').val());
            fd.append('token', '{{$token}}');
            xhr.send(fd);
            $(".btn_submit").attr('disabled','disabled');
        });


        $('form.createPrize').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/admin/add_prize', true);
            xhr.onload = function() {
                console.log(this.response);
                var resp = JSON.parse(this.response);
                $(".btn_submit").removeAttr('disabled');
                if (resp.success == true) {
                    $('.modal_hide').click();
                    sweet_modal('Success','success',1000);
                    setTimeout(function () {
                        window.location = '/panel/admin/catalog?nav=prizes';
                    },1000);
                }else{
                    $(".modal_hide").click();
                    sweet_modal(resp.message,'error',2000);
                }
            };
            xhr.upload.onprogress = function(e) {
                $(".body_progress").html((event.loaded/1000000).toFixed(3) + 'mb / ' + (event.total/1000000).toFixed(3)+' mb');
            };
            var fd = new FormData();
//            console.log($('input[name="photo_files"]')[0].files);
            console.log($('input[name="myfile_img_prize"]')[0].files[0]);
            fd.append('prize_img', $('input[name="myfile_img_prize"]')[0].files[0]);
            fd.append('descr', $('textarea[name="descr"]').val());
            fd.append('title', $('input[name="title"]').val());
            fd.append('end_date', $('input[name="end_date"]').val());
            fd.append('points', $('input[name="points"]').val());
            fd.append('rate', $('input[name="rate"]').val());
            fd.append('token', '{{$token}}');
            xhr.send(fd);
            $(".btn_submit").attr('disabled','disabled');
        });

        function sel_del_prize() {
            var array_id = [];
            $('.selected_prize').each(function () {
                if($(this).prop('checked')) {
                    array_id.push($(this).attr('data-id'));
                }
            });
            delete_prize(array_id);
        }
        function delete_prize(array_id) {

            if(array_id.length==0) {
                sweet_modal('Please , select items! ', 'error', 3000);
            }else {
                var token = '{{$token}}';
                $.sweetModal.confirm('Are you sure you want to delete this?', function () {
                    $.ajax({
                        url: "/api/admin/delete/prize",
                        type: "POST",
                        data: {'prizes_id': array_id, 'token': token},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token' : '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            $('.selected_prize').prop('checked', false);
                            if (data.success == true) {
                                sweet_modal('Success', 'success', 1000);
                                setTimeout(function () {
                                    window.location = '/panel/admin/catalog';
                                },1000);
                            } else {
                                sweet_modal(data.message, 'error', 2000);
                            }
                        }, error: function (data) {
                            sweet_modal('Something went wrong', 'error', 1000);
                        }

                    })
                });
            }
        }
        $( "#search_btn_prize" ).click(function() {
            $( "#hide_search_prize" ).click();
        });
        $( "#search_btn_product" ).click(function() {
            $( "#hide_search_product" ).click();
        });
        function check(input) {
            input.value = input.value.replace(/[^\d]/g, '');
        };



    </script>
@endsection