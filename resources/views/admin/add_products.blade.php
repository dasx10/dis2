@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
    <link rel="stylesheet" href="/public/css/jquery.sweet-modal.css">
    <style>
        #cke_descr{
            width:100%;
            border: 0.125rem solid #aab4bc;
            font-family: 'RalewayRegular';
            font-size: 1.125rem;
            border-radius: 0.5rem;
            color: #a3a3a3;
        }
        .cke_inner{
            border-radius: 0.5rem!important;
        }
        #cke_1_contents{
            border-radius: 0.5rem!important;
            height: 150px!important;
        }
        #cke_1_top{
            display: none;
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
                <div class="card-header" style="padding-top:0.9375rem;padding-bottom: 0.9375rem;border-radius: 0">
                    <h5 class="d-flex align-items-center" style="margin-bottom: 0;font-size: 1.125rem;">
                        <button onclick='location.href="/panel/admin/catalog"' class="btn_back d-flex align-items-center"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button>
                        <a href="/panel/admin/catalog" style="color:#4c6897;">Catalogue</a> <span style="padding-right:5px;padding-left:5px;">|</span> <span>Add new product</span></h5>
                </div>
                <div class="card-block">
                    <form class="addProd">
                        <div class="row">
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="col  form-group" style="margin-bottom: .97rem;">
                                    <input maxlength="75" type="text" name="product_name" class="itemeach form-control check_space" placeholder="*Product Name" required>
                                </div>
                                <div class="col  form-group" style="margin-bottom: .97rem;">
                                    <input type="text" name="product_code" class="itemeach form-control check_space" placeholder="*Product Code (Capital letters of product name)" required>
                                </div>
                                <div class="col  form-group">
                                    <input type="file"   name="photo_files[]" accept="image/png, image/jpeg" id="photo_files" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple required/>
                                    <label class="form-control required-input"  for="photo_files"><span style="font-size: 1.125rem;padding-left: 0.75rem;padding-top: 0.9375rem;">*Product Photo (browse)</span> <strong>...</strong></label>
                                    {{--<input type="file" accept="image/png, image/jpeg" name="photo_files" id="photo_files" data-multiple-caption="{count} files selected" multiple required>--}}
                                </div>
                                <div class="col  form-group" style="margin-bottom: .97rem;">
                                    <input type="text" name="specification" class="itemeach form-control check_space" placeholder="*Specification" required>
                                </div>
                                <div class="col  form-group" style="margin-bottom: .97rem;">
                                    <input onkeyup="check_cas(this)" type="text" name="cas" class="itemeach form-control check_space" placeholder="*CAS" required>
                                </div>
                                <div class="col  form-group">
                                    <div class="dropdown" style="width:100%;">
                                        <button style="display: flex" class="form-control dropdown-toggle dropdown-edit select_name_category" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            *Category
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-edit" aria-labelledby="dropdownMenuButton">
                                            @foreach($categories as $category)
                                                <div class="name_category" style="position: relative"><a onclick="set_category(this)" class="dropdown-item dropdown-catalog" href="#{{$category->title}}">{{$category->title}}</a><span class="dropdown-delete-item" onclick="delete_category('{{$category->id}}')">Delete</span></div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col form-group d-flex align-items-center">
                                    <span class="d-flex align-items-center" style="font-size:1.125rem;">
                                        <a data-toggle="modal" data-target="#addmore_category" href=""  class="btn_blue d-flex align-items-center" style="margin-right:0.625rem;background:#56be60;"><i class="fa fa-plus"></i></a>Add category</span>
                                </div>
                                <div class="col form-group">
                                    <div class="dropdown" style="width:100%;">
                                        <button style="display: flex" class="form-control dropdown-toggle dropdown-edit select_name_brand" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            *Brand
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-edit" aria-labelledby="dropdownMenuButton">
                                            @foreach($brands as $brand)
                                                <div class="name_brand" style="position: relative"><a onclick="set_brand(this)" class="dropdown-item dropdown-catalog" href="#{{$brand->title}}">{{$brand->title}}</a><span class="dropdown-delete-item" onclick="delete_brand('{{$brand->id}}')">Delete</span></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col form-group d-flex align-items-center">
                                    <span class="d-flex align-items-center" style="font-size:1.125rem;">
                                        <a data-toggle="modal" data-target="#addmore_brand" href=""  class="btn_blue d-flex align-items-center" style="margin-right:0.625rem;background:#56be60;"><i class="fa fa-plus"></i></a>Add brand</span>
                                </div>
                                <div class="col form-group">
                                    <div class="dropdown" style="width:100%;">
                                        <button style="display: flex" class="form-control dropdown-toggle dropdown-edit select_class_brand" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            *Shipping Class
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-edit" aria-labelledby="dropdownMenuButton">
                                                <div class="name_brand" style="position: relative">
                                                    <a onclick="setClass('Class 1')" class="dropdown-item dropdown-catalog" >Class 1</a>
                                                    <a onclick="setClass('Class 2')" class="dropdown-item dropdown-catalog" >Class 2</a>
                                                    <a onclick="setClass('Class 3')" class="dropdown-item dropdown-catalog">Class 3</a>
                                                    <a onclick="setClass('Class 4')" class="dropdown-item dropdown-catalog" >Class 4</a>
                                                    <a onclick="setClass('Class 5')" class="dropdown-item dropdown-catalog" >Class 5</a>
                                                    <a onclick="setClass('Class 6')" class="dropdown-item dropdown-catalog" >Class 6</a>
                                                    <a onclick="setClass('Class 7')" class="dropdown-item dropdown-catalog" >Class 7</a>
                                                    <a onclick="setClass('Class 8')" class="dropdown-item dropdown-catalog" >Class 8</a>
                                                    <a onclick="setClass('Class 9')" class="dropdown-item dropdown-catalog" >Class 9</a>
                                                    <a onclick="setClass('Class 10')" class="dropdown-item dropdown-catalog" >Class 10</a>
                                                    <a onclick="setClass('N/A')" class="dropdown-item dropdown-catalog" >N/A</a>
                                                </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="shipping_class" class="itemeach">
                                    {{--<input type="text" name="shipping_class" class="itemeach form-control" placeholder="Shipping Class">--}}
                                </div>
                                <div class="col form-group">
                                    <input required type="text" name="type_of_packaging1" class="itemeach form-control check_space" placeholder="*Type of the Packaging 1">
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="return requiredInput1(this);" onchange="return requiredInput1(this);" name="type_of_packaging2" class="itemeach form-control check_space" placeholder="Type of the packaging 2">
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="return requiredInput2(this);" onchange="return requiredInput2(this);" name="type_of_packaging3" class="itemeach form-control check_space" placeholder="Type of the packaging 3">
                                </div>
                                {{--<div class="col  form-group">--}}
                                    {{--<input type="text" name="type_of_packaging1_price" class="itemeach form-control check_space" placeholder="*Type of the packaging 1 Price">--}}
                                {{--</div>--}}
                                {{--<div class="col  form-group">--}}
                                    {{--<input type="text" name="type_of_packaging2_price" class="itemeach form-control check_space" placeholder="Type of the packaging 2 Price">--}}
                                {{--</div>--}}
                                {{--<div class="col  form-group">--}}
                                    {{--<input type="text" name="type_of_packaging3_price" class="itemeach form-control check_space" placeholder="Type of the packaging 3 Price">--}}
                                {{--</div>--}}
                                <div class="col form-group">
                                    <div class="dropdown" style="width:100%;">
                                        <button style="display: flex" class="form-control dropdown-toggle dropdown-edit select_p_wp_brand" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            *Pallet/Without pallet
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-edit" aria-labelledby="dropdownMenuButton">
                                            <div class="name_brand" style="position: relative">
                                                {{--<a onclick="setPalletWPallet('Pallet/Without pallet')" class="dropdown-item dropdown-catalog">Pallet/Without pallet</a>--}}
                                                <a onclick="setPalletWPallet('Pallet')" class="dropdown-item dropdown-catalog">Pallet</a>
                                                <a onclick="setPalletWPallet('Without pallet')" class="dropdown-item dropdown-catalog">Without pallet</a>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<input type="text" name="shipping_class" class="itemeach form-control" placeholder="Shipping Class">--}}
                                </div>

                                {{--<div class="col  form-group">--}}
                                    <input type="hidden" name="pallet_without_pallet" class="itemeach form-control check_space" placeholder="*Pallet /Without pallet">
                                {{--</div>--}}


                                <div class="col  form-group">
                                    <input type="text" onkeyup="return check(this);" onchange="return check(this);" required name="pallet_capacity_for_packaging_type_1" class="itemeach form-control check_space pallet_capacity" placeholder="*Pallet capacity of packaging 1">
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="return check(this);" onchange="return check(this);" name="pallet_capacity_for_packaging_type_2" class="itemeach form-control check_space pallet_capacity" placeholder="Pallet capacity of packaging 2">
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="return check(this);" onchange="return check(this);" name="pallet_capacity_for_packaging_type_3" class="itemeach form-control check_space pallet_capacity" placeholder="Pallet capacity of packaging 3">
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="validateWHL(this)" onchange="return validateWHL(this);" name="lwh_pallet" class="itemeach form-control check_space" placeholder="*Pallet L*W*H (m)">
                                </div>

                                {{--<div class="col  form-group">--}}
                                    {{--<input maxlength="15" type="text" name="price_prod_plus_packaging1"  class="itemeach form-control check_space" placeholder="*Price of the product + packaging 1" required onkeyup="return check(this);" onchange="return check(this);">--}}
                                {{--</div>--}}
                                {{--<div class="col  form-group">--}}
                                    {{--<input maxlength="15" type="text" name="price_prod_plus_packaging2"  class="itemeach form-control check_space" placeholder="Price of the product + packaging 2" onkeyup="return check(this);" onchange="return check(this);">--}}
                                {{--</div>--}}
                                {{--<div class="col  form-group">--}}
                                    {{--<input maxlength="15" type="text" name="price_prod_plus_packaging3"  class="itemeach form-control check_space" placeholder="Price of the product + packaging 3" onkeyup="return check(this);" onchange="return check(this);">--}}
                                {{--</div>--}}
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_1_1"  class="itemeach form-control check_space" placeholder="*MOQ 1 for the packaging 1" required onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_1_2"  class="itemeach form-control check_space" placeholder="MOQ 1 for the packaging 2"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_1_3"  class="itemeach form-control check_space" placeholder="MOQ 1 for the packaging 3"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_2_1"  class="itemeach form-control check_space" placeholder="*MOQ 2 for the packaging 1" required onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_2_2"  class="itemeach form-control check_space" placeholder="MOQ 2 for the packaging 2"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_2_3"  class="itemeach form-control check_space" placeholder="MOQ 2 for the packaging 3"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_3_1"  class="itemeach form-control check_space" placeholder="*MOQ 3 for the packaging 1" required onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_3_2"  class="itemeach form-control check_space" placeholder="MOQ 3 for the packaging 2"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="moc_3_3"  class="itemeach form-control check_space" placeholder="MOQ 3 for the packaging 3"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="price_prod_plus_packaging1"  class="itemeach form-control check_space" placeholder="*Price of Product - Pack 1 MOQ1" required onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name=""  class="itemeach form-control check_space" placeholder="Price of Product - Pack 2 MOQ1"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name=""  class="itemeach form-control check_space" placeholder="Price of Product - Pack 3 MOQ1"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="price_prod_plus_packaging2"  class="itemeach form-control check_space" placeholder="*Price of Product - Pack 1 MOQ2" required  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name=""  class="itemeach form-control check_space" placeholder="Price of Product - Pack 2 MOQ2"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name=""  class="itemeach form-control check_space" placeholder="Price of Product - Pack 3 MOQ2"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name="price_prod_plus_packaging3"  class="itemeach form-control check_space" placeholder="*Price of Product - Pack 1 MOQ3" required  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name=""  class="itemeach form-control check_space" placeholder="Price of Product - Pack 2 MOQ3"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col  form-group">
                                    <input maxlength="15" type="text" name=""  class="itemeach form-control check_space" placeholder="Price of Product - Pack 3 MOQ3"  onkeyup="return check(this);" onchange="return check(this);">
                                </div>
                                <div class="col form-group">
                                    <p style="color:red;font-size: 1.5rem;font-family:RalewayItalic;">*required fields</p>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="col  form-group">
                                    <input type="text" onkeyup="validateWHL(this)" name="lwh_packaging1_wp"  class="itemeach form-control check_space" placeholder="*L * W * H of the packaging 1 (m)" required >
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="validateWHL(this)" name="lwh_packaging1_p"  class="itemeach form-control check_space" placeholder="L * W * H of the packaging 1 on pallet (m)" >
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="validateWHL(this)" name="lwh_packaging2_wp"  class="itemeach form-control check_space" placeholder="L * W * H of the packaging 2 (m)"  >
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="validateWHL(this)" onchange="return validateWHL(this);" name="lwh_packaging2_p"  class="itemeach form-control check_space" placeholder="L * W * H of the packaging 2 on pallet (m)" >
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="validateWHL(this)" onchange="return validateWHL(this);" name="lwh_packaging3_wp"  class="itemeach form-control check_space" placeholder="L * W * H of the packaging 3 (m)" >
                                </div>
                                <div class="col  form-group">
                                    <input type="text" onkeyup="validateWHL(this)" onchange="return validateWHL(this);" name="lwh_packaging3_p"  class="itemeach form-control check_space" placeholder="L * W * H of the packaging 3 on pallet (m)" >
                                </div>
                                <div class="col form-group">
                                    <input type="text" onkeyup="return check(this);" onchange="return check(this);" name="packaging_net1" class="itemeach form-control check_space" required placeholder="*Packaging 1 Net Weight">
                                </div>
                                <div class="col form-group">
                                    <input type="text" onkeyup="return check(this);" onchange="return check(this);" name="packaging_net2" class="itemeach form-control check_space" placeholder="Packaging 2 Net Weight">
                                </div>
                                <div class="col form-group">
                                    <input type="text" onkeyup="return check(this);" onchange="return check(this);" name="packaging_net3" class="itemeach form-control check_space" placeholder="Packaging 3 Net Weight">
                                </div>
                                <div class="col form-group">
                                    <input type="text" onkeyup="return check(this);" onchange="return check(this);" name="pallet_weight" class="itemeach form-control check_space" placeholder="Pallet Weight">
                                </div>
                                <div class="col form-group">
                                    <input type="text"  name="loading_port" class="itemeach form-control check_space" placeholder="*Loading Port 1" required>
                                </div>
                                {{--<div class="col form-group">--}}
                                    {{--<input type="text"  name="loading_port2" class="itemeach form-control check_space" placeholder="Loading Port 2">--}}
                                {{--</div>--}}
                                {{--<div class="col form-group">--}}
                                    {{--<input type="text"  name="loading_port3" class="itemeach form-control check_space" placeholder="Loading Port 3">--}}
                                {{--</div>--}}
                                <div class="col form-group">
                                    <input type="text" name="restrictions" class="itemeach form-control check_space" placeholder="Restrictions">
                                </div>
                                <div class="col form-group" style="margin-bottom: .5rem;position:relative;">
                                    <textarea class="itemeach form-control"  name="descr" id="descr" cols="20" rows="7" required style="height:150px; resize: none;"></textarea>
                                    <span class="fixed_description">*Aplication</span>
                                </div>
                                <div class="col form-group">
                                    <input type="text" name="fcl" class="itemeach form-control check_space" placeholder="Information of FCL quantity (with/without pallet) ">
                                </div>
                                {{--<input type="hidden" name="descr">--}}
                                <div class="col form-group" style="margin-bottom: .9rem;">
                                    <p style="margin:0;font-size: 1.125rem" class="RalewayRegular">*Related Documents</p>
                                </div>
                                <input type="hidden" class="itemeach" name="token" value="{{$token}}">
                                <input type="hidden" class="itemeach" name="category" value="">
                                <input type="hidden" class="itemeach" name="brand" value="">
                                <div class="col form-group">
                                    <input type="file"  name="pdf_file_tds[]" accept=".tds" class="inputfile inputfile-6 doc_files_tds doc_files" data-multiple-caption="{count} files selected"/>
                                    <label class="form-control">
                                        <span style="font-size: 1.125rem;padding-left: 0.75rem;padding-top: 0.9375rem;">TDS files only</span>
                                        <strong>...</strong>
                                    </label>
                                </div>
                                <div class="col form-group">
                                    <input type="file"  name="pdf_file_msds[]" accept=".msds" class="inputfile inputfile-6 doc_files_msds doc_files" data-multiple-caption="{count} files selected"/>
                                    <label class="form-control">
                                        <span style="font-size: 1.125rem;padding-left: 0.75rem;padding-top: 0.9375rem;">MSDS files only</span>
                                        <strong>...</strong>
                                    </label>
                                </div>
                                <div class="doc_block">

                                </div>
                                <div class="col form-group d-flex align-items-center">
                                    <span class="d-flex align-items-center" style="font-size:1.125rem;"><a href="#addmore" onclick="add_more_doc()" class="btn_blue d-flex align-items-center" style="margin-right:0.625rem;background:#56be60;"><i class="fa fa-plus"></i></a>Add more documents</span>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn_page btn_submit"><span>Add new</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <button style="display:none;" class="modal_show" data-toggle="modal" data-target="#modal_documents_progress"></button>
        <button style="display:none;" class="modal_hide" data-dismiss="modal"></button>
        <div class="modal " id="modal_documents_progress" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center body_progress" style="padding: 15px!important">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addmore_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">ADD NEW CATEGORY</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="createCategory123">
                        <div class="modal-body">
                            <div class="form-group">
                                <input required type="text" name="title" class="form-control" placeholder="Name category">
                            </div>
                        </div>
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page " value="Add">
                            <button type="button" class="btn_page_orange" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addmore_brand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">ADD NEW BRAND</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="createBrand">
                        <div class="modal-body">
                            <div class="form-group">
                                <input required type="text" name="title" class="form-control" placeholder="Name brand">
                            </div>
                        </div>
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page " value="Add">
                            <button type="button" class="btn_page_orange" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script src="/public/js/jquery.sweet-modal.js"></script>
    <script src="/public/ckeditor/ckeditor.js"></script>
    <script>
        {{--$('select[name="country"]').val('{{$products_data->country}}');--}}
        {{--$('select[name="regione"]').val('{{$products_data->regione}}');--}}

        // setInterval(function () {
        //     if ($('input[name="pallet_capacity_for_packaging_type_1"]').is(':hover') ||
        //         $('input[name="pallet_capacity_for_packaging_type_2"]').is(':hover') ||
        //         $('input[name="pallet_capacity_for_packaging_type_3"]').is(':hover')) {
        //         moq_pack_type_1();
        //         moq_pack_type_2();
        //         moq_pack_type_3();
        //     }
        // },200);
        //
        //
        //
        // function moq_pack_type_1() {
        //     var Z,res;
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_1"]').val()!=''){
        //         Z = 10/parseFloat($('input[name="pallet_capacity_for_packaging_type_1"]').val());
        //         $('input[name="moc_1_1"]').val(Z);
        //     }
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_2"]').val()!=''){
        //         Z = 10/parseFloat($('input[name="pallet_capacity_for_packaging_type_2"]').val());
        //         $('input[name="moc_1_2"]').val(Z);
        //     }
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_3"]').val()!=''){
        //         Z = 10/parseFloat($('input[name="pallet_capacity_for_packaging_type_3"]').val());
        //         $('input[name="moc_1_3"]').val(Z);
        //     }
        // }
        //
        // function moq_pack_type_2() {
        //     var Z,res;
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_1"]').val()!=''){
        //         Z = 20/parseFloat($('input[name="pallet_capacity_for_packaging_type_1"]').val());
        //         $('input[name="moc_2_1"]').val(Z);
        //     }
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_2"]').val()!=''){
        //         Z = 20/parseFloat($('input[name="pallet_capacity_for_packaging_type_2"]').val());
        //         $('input[name="moc_2_2"]').val(Z);
        //     }
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_3"]').val()!=''){
        //         Z = 20/parseFloat($('input[name="pallet_capacity_for_packaging_type_3"]').val());
        //         $('input[name="moc_2_3"]').val(Z);
        //     }
        // }
        //
        // function moq_pack_type_3() {
        //     var Z,res;
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_1"]').val()!=''){
        //         Z = 40/parseFloat($('input[name="pallet_capacity_for_packaging_type_1"]').val());
        //         $('input[name="moc_3_1"]').val(Z);
        //     }
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_2"]').val()!=''){
        //         Z = 40/parseFloat($('input[name="pallet_capacity_for_packaging_type_2"]').val());
        //         $('input[name="moc_3_2"]').val(Z);
        //     }
        //
        //     if($('input[name="pallet_capacity_for_packaging_type_3"]').val()!=''){
        //         Z = 40/parseFloat($('input[name="pallet_capacity_for_packaging_type_3"]').val());
        //         $('input[name="moc_3_3"]').val(Z);
        //     }
        //
        // }


        function delete_brand(id) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url: "/api/admin/brand/delete",
                    type: "POST",
                    data: {item: id,token:'{{$token}}'},
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
                                window.location = '/panel/admin/add-products';
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

        function delete_category(id) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url: "/api/admin/category/delete",
                    type: "POST",
                    data: {item: id,token:'{{$token}}'},
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
                                window.location = '/panel/admin/add-products';
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

        function set_brand(a) {
            $('input[name="brand"]').val($(a).html());
            $('.select_name_brand').html($(a).html());
        }

        function setPalletWPallet(a){
            $('.select_p_wp_brand').html(a);
            $('input[name="pallet_without_pallet"]').val(a);
            if($('input[name="pallet_without_pallet"]').val()=='Without pallet'){
                $('input[name="pallet_capacity_for_packaging_type_1"]').removeAttr('required');
                $('input[name="lwh_packaging1_p"]').removeAttr('required');
                // $('input[name="lwh_pallet"]').removeAttr('required');
                $('input[name="pallet_weight"]').removeAttr('required');
            }
            else{
                $('input[name="pallet_capacity_for_packaging_type_1"]').attr("required", "true");
                $('input[name="lwh_packaging1_p"]').attr("required", "true");
                // $('input[name="lwh_pallet"]').attr("required","true");
                $('input[name="pallet_weight"]').attr("required","true");
            }
        }
        function  requiredInput1() {
            if($('input[name="type_of_packaging2"]').val()!=''){
                if($('input[name="pallet_without_pallet"]').val()=='Pallet'){
                    $('input[name="lwh_packaging2_p"]').attr("required","true");
                }
                else{
                    $('input[name="pallet_capacity_for_packaging_type_2"]').attr("required","true");
                    $('input[name="moc_1_2"]').attr("required","true");
                    $('input[name="moc_2_2"]').attr("required","true");
                    $('input[name="moc_3_2"]').attr("required","true");
                    $('input[name="packaging_net2"]').attr("required","true");
                    $('input[name="lwh_packaging2_wp"]').attr("required","true");
                }
            }
            else{
                $('input[name="pallet_capacity_for_packaging_type_2"]').removeAttr("required");
                $('input[name="moc_1_2"]').removeAttr("required");
                $('input[name="moc_2_2"]').removeAttr("required");
                $('input[name="moc_3_2"]').removeAttr("required");
                $('input[name="packaging_net2"]').removeAttr("required");
                $('input[name="lwh_packaging2_wp"]').removeAttr("required");
                $('input[name="lwh_packaging2_p"]').removeAttr("required");
            }
        }
        function  requiredInput2() {
            if($('input[name="type_of_packaging3"]').val()!=''){
                if($('input[name="pallet_without_pallet"]').val()=='Pallet'){
                    $('input[name="lwh_packaging3_p"]').attr("required","true");
                }
                else {
                    $('input[name="pallet_capacity_for_packaging_type_3"]').attr("required","true");
                    $('input[name="moc_1_3"]').attr("required","true");
                    $('input[name="moc_2_3"]').attr("required","true");
                    $('input[name="moc_3_3"]').attr("required","true");
                    $('input[name="packaging_net3"]').attr("required","true");
                    $('input[name="lwh_packaging3_wp"]').attr("required","true");
                }
            }
            else{
                $('input[name="pallet_capacity_for_packaging_type_3"]').removeAttr("required");
                $('input[name="moc_1_3"]').removeAttr("required");
                $('input[name="moc_2_3"]').removeAttr("required");
                $('input[name="moc_3_3"]').removeAttr("required");
                $('input[name="packaging_net3"]').removeAttr("required");
                $('input[name="lwh_packaging3_wp"]').removeAttr("required");
            }
        }

        function setClass(a) {
            $('.select_class_brand').html(a);
            $('input[name="shipping_class"]').val(a);
        }

        function set_category(a) {
            $('input[name="category"]').val($(a).html());
            $('.select_name_category').html($(a).html());
        }

        $(function(){
            $(".btn_submit").click(function(){
                var $fileUpload = $("#photo_files");
                if (parseInt($fileUpload.get(0).files.length)>4){
                    alert("You can only upload a maximum of 4 files");
                }
            });
        });
        $(document).ready(function () {
            $(".header_text").html('Catalogue');
        });
        function add_more_doc() {
            var html = '<div class="col form-group">\n' +
                '                                    <input required type="file"  name="pdf_file[]" accept="application/pdf" class="inputfile inputfile-6 doc_files" data-multiple-caption="{count} files selected" required/>\n' +
                '                                    <label class="form-control"  for="pdf_file"><span style="font-size: 1.125rem;padding-left: 0.75rem;padding-top: 0.9375rem;">PDF files only</span> <strong>...</strong></label>\n' +                '                      \n' +
                '                                </div>';
            $(".doc_block").append(html);
           alertFile();
        }

        function sweet_modal(text,type,time) {
            $.sweetModal({
                content: text,
                icon: type,
                timeout:time
            });
        }

        $('form.createBrand').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url: "/api/admin/brand/add",
                type: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success: function (data) {
                    $('.btn_page_orange').click();
                    console.log(data);
                    if (data.success == true) {
                        sweet_modal('Success', 'success', 1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/add-products';
                        }, 1000);
                    } else {
                        sweet_modal(data.message, 'error', 1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                }, error: function (data) {
                    $('.btn_page_orange').click();
                    console.log(data);
                    sweet_modal('Something went wrong', 'error', 1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        });

        $('form.createCategory123').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url: "/api/admin/category/add",
                type: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success: function (data) {
                    $('.btn_page_orange').click();
                    console.log(data);
                    if (data.success == true) {
                        sweet_modal('Success', 'success', 1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/add-products';
                        }, 1000);
                    } else {
                        sweet_modal(data.message, 'error', 1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                }, error: function (data) {
                    $('.btn_page_orange').click();
                    console.log(data);
                    sweet_modal('Something went wrong', 'error', 1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        });


        $('form.addProd').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/admin/add_product', true);
            xhr.onload = function() {
                console.log(this.response);
                var resp = JSON.parse(this.response);
                $(".btn_submit").removeAttr('disabled');
                if (resp.success == true) {
//                    $(".modal_hide").click();
                    sweet_modal('Success','success',1000);
                    setTimeout(function () {
                        window.location = '/panel/admin/catalog';
                    },1000);
                }else{
//                    $(".modal_hide").click();
                    $('.btn_submit').removeAttr('disabled');
                    sweet_modal(resp.message,'error',2000);
                }
            };
            xhr.upload.onprogress = function(e) {
                $(".body_progress").html((event.loaded/1000000).toFixed(3) + 'mb / ' + (event.total/1000000).toFixed(3)+' mb');
            };
            var fd = new FormData();
//            console.log($('input[name="photo_files"]')[0].files);
            jQuery.each(jQuery('input[name="photo_files[]"]')[0].files, function(i, file) {
                fd.append('photo_files[]', file);
            });
            $(".doc_files").each(function () {
                jQuery.each(this.files, function(i, file2) {
                    fd.append('doc_files[]', file2);
                });
            });
            $(".itemeach").each(function () {
                fd.append($(this).attr('name'), $(this).val());
            });
            fd.append('descr',CKEDITOR.instances['descr'].getData());
            if($('input[name="brand"]').val()=='' || $('input[name="category"]').val()==''){
                sweet_modal('Select brand or category!','error',3000);
                $('.btn_submit').removeAttr('disabled');
            }else {
//                $(".modal_show").click();
                fd.append('brand', $('input[name="brand"]').val());
                fd.append('category', $('input[name="category"]').val());
                xhr.send(fd);
            }
        });


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

        function check(input) {
            input.value = input.value.replace(/[^0-9\.]/gi, '');
        };
        function check_cas(input) {
            input.value = input.value.replace(/[^0-9\-]/gi, '');
        };
        $('.check_space').blur(function(){
            $(this).val($.trim($(this).val()));
        });

        CKEDITOR.replace( 'descr');

        function validateWHL(input) {
            var value = $(input).val();
            var re = /[^0-9\*\.]/gi;
            if (re.test(value)) {
                value = value.replace(re, '');
                $(input).val(value);
            }
        }

    </script>
@endsection
