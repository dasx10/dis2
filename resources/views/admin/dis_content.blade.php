@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
    <link rel="stylesheet" href="/public/css/admin/dropify.css">
    <link href="/public/css/admin/animate.css" rel="stylesheet">
    <style>
        .dropify-infos-message{
            display: none!important;
        }
        .dropify-wrapper:hover .dropify-clear{
            opacity: 0!important;
        }
    </style>
@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
        @include('admin.sidebar')
        <main class="main">
            <div class="container-fluid main_container_fluid catalog-tabs">
                <ul class="nav nav-tabs fixed-content-nav" role="tablist" style="font-family: RalewaySemiBold;">
                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set first_nav" data-href="home" href="#home1" role="tab" data-toggle="tab">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="our_brands" href="#our_brands1" role="tab" data-toggle="tab">Our brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_catalog nav_link_set" data-href="our_industries" href="#our_industries1" role="tab" data-toggle="tab">Our industries</a>
                    </li>
                    @foreach($all_industries as $key=>$industry)
                        <li class="nav-item">
                            <a class="nav-link nav_catalog nav_link_set" data-href="industry{{$key}}" href="#industry{{$key}}1" role="tab" data-toggle="tab">{{$industry->full_name}}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link nav_catalog nav_link_set" data-href="tailor_made_solutions" href="#tailor_made_solutions1" role="tab" data-toggle="tab">Tailor made solutions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_catalog nav_link_set" data-href="who_we_are" href="#who_we_are1" role="tab" data-toggle="tab">Who we are</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_catalog nav_link_set" data-href="join_us" href="#join_us1" role="tab" data-toggle="tab">Join us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_catalog nav_link_set" data-href="contact" href="#contact1" role="tab" data-toggle="tab">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_catalog nav_link_set" data-href="address" href="#address1" role="tab" data-toggle="tab">Address</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_catalog nav_link_set" data-href="navigations" href="#navigations1" role="tab" data-toggle="tab">Navigations</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane tab_first" id="home">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Slider</h3>
                                <div class="row draggablePanelList sliders_list">
                                    @foreach($main_slider as $slide_main)
                                        <div data-id="{{$slide_main->id}}" class="col-sm-12 col-md-6 col-xl-4 panel slider_item" style="margin-bottom:30px;position: relative">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file" accept="image/png, image/jpeg"  class="dropify" data-height="500" data-default-file="{{$slide_main->src}}" />
                                                </div>
                                                <textarea id="main_slider_{{$slide_main->id}}"  cols="30" rows="10">{{$slide_main->title}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_main_slide(this)" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_main_slide(this)" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit" style="width:15.3125rem;" onclick="add_new_slide()">Add new slide</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade " id="our_brands">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center">Description</h3>
                                <textarea id="brand_descr"  name="editor_1" cols="30" rows="10">{{$brand_descr->text}}</textarea>
                                <br>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Slider</h3>
                                <div class="row draggablePanelList brand_slider_list">
                                    @foreach($brand_slider as $slide_brand)
                                        <div data-id="{{$slide_brand->id}}" class="col-sm-12 col-md-6 col-xl-4 panel brand_slider_item" style="margin-bottom:30px;">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file" accept="image/png, image/jpeg"  class="dropify" data-height="500" data-default-file="{{$slide_brand->src}}" />
                                                </div>
                                                <textarea id="brand_slide_{{$slide_brand->id}}" cols="30" rows="10">{{$slide_brand->title}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_brand_slide(this)" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_brand_slide(this)" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button onclick="save_brand_description(this)" type="button" class="btn_page btn_submit" style="margin: 2px">Save description</button>
                                        <button onclick="add_new_brand_slide()"  type="button" class="btn_page_orange btn_submit" style="width:15.3125rem;">Add new slide</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="our_industries">
                        <div class="row">
                            <div class="col-12 form-group">
                                <button class="btn_orders btn_page" data-toggle="modal" data-target="#myModal_new_industry" style="margin:0;height: 2.6875rem;width: 10.9375rem;">Add new industry</button>
                            </div>
                        </div>
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Description</h3>
                                <div class="row">
                                    <div class="col" style="margin-bottom:20px;">
                                        <textarea id="industries_descr_noclick" rows="10" cols="80" style="border-radius:4px;">{{$ind_descr}}</textarea>
                                    </div>
                                </div>
                                <div class="row draggablePanelList industries_list2">
                                    @foreach($all_industries as $industr)
                                        <div data-id="{{$industr->id}}" class="col-sm-12 col-md-6 col-xl-4 panel industries_slider_item2" style="margin-bottom:30px;">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file" name="file" accept="image/png, image/jpeg"  class="dropify industries_photo_one" data-height="500" data-default-file="{{$industr->photo_url}}"/>
                                                </div>
                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>
                                                <div class="col form-group p-0">
                                                    <input type="file" name="our_industries_hover_image"  class="dropify industries_photo_two" data-height="500" data-default-file="{{$industr->photo_url_hover}}" />
                                                </div>
                                                <textarea class="industries_title2" id="industries2_title_{{$industr->id}}" rows="10" cols="80" style="border-radius:4px;">{{$industr->title}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_industry(this)" data-industry-id="{{$industr->id}}" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_industries_slide2(this)" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button onclick="save_industries_description2(this)" type="button" class="btn_page btn_submit" style="margin: 2px">Save description</button>
                                        {{--<button onclick="add_new_industries_slide2()"  type="button" class="btn_page_orange" style="width:15.3125rem;">Add new slide</button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($all_industries as $key=>$industry)
                        <div role="tabpanel" class="tab-pane fade" id="industry{{$key}}">
                            <div class="card box-shadow">
                                <div class="card-block">
                                    <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Description</h3>
                                    <div class="row">
                                        <div class="col" style="margin-bottom:20px;">
                                            <div class="col form-group p-0">
                                                <input type="file" accept="image/png, image/jpeg"  class="descr_photo_url_{{$key}} dropify industries_photo" data-height="500" data-default-file="{{$industry->descr_photo_url}}" />
                                            </div>
                                            <textarea id="industries_descr_{{$key}}" rows="10" cols="80" style="border-radius:4px;">{{$industry->descr}}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Content</h3>
                                    <div class="row draggablePanelList industries_list industries_list_{{$key}}">
                                        @foreach($industry->contents as $i_slide)
                                            <div data-id="{{$i_slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel industries_slider_item{{$key}}" style="margin-bottom:30px;">
                                                <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                                <div class="panel-draggable" >
                                                    <div class="col form-group p-0">
                                                        <input type="file" name="file" accept="image/png, image/jpeg"  class="file industry_slide_src_{{$i_slide->id}} dropify" data-height="500" data-default-file="{{$i_slide->src}}" />
                                                    </div>
                                                    <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>
                                                    <div class="col form-group p-0">
                                                        <input type="file" name="industries_hover_image"  class="industry_slide_src_hover_{{$i_slide->id}} file1 dropify" data-height="500" data-default-file="{{$i_slide->src_hover}}" />
                                                    </div>
                                                    <textarea class="industries_title" id="industry_slide_title_{{$i_slide->id}}"  cols="30" rows="10">{{$i_slide->title}}</textarea>
                                                    <h3 class="d-flex justify-content-center">Click content</h3>
                                                    <div class="col form-group p-0">
                                                        <input type="file" name="file1" accept="image/png, image/jpeg"  class="industry_slide_src1_{{$i_slide->id}} dropify" data-height="500"  data-default-file="{{$i_slide->src1}}"/>
                                                    </div>
                                                    <textarea class="industries_descr" id="industry_slide_descr_{{$i_slide->id}}" cols="30" rows="10">{{$i_slide->descr}}</textarea>
                                                    <br>
                                                    <input class="form-control industry_slide_link_{{$i_slide->id}}" value="{{$i_slide->link}}" name="link" type="text" placeholder="Link website">
                                                </div>
                                                <div style="text-align: center;margin-top: 10px;">
                                                    <button onclick="delete_industries_slide(this)" data-industry-slide-id="{{$i_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                    <button onclick="save_industries_slide(this)" data-industry-id="{{$industry->id}}" data-industry-slide-link="industry_slide_link_{{$i_slide->id}}" data-industry-slide-descr="industry_slide_descr_{{$i_slide->id}}" data-industry-slide-src1="industry_slide_src1_{{$i_slide->id}}" data-industry-slide-title="industry_slide_title_{{$i_slide->id}}" data-industry-slide-src-hover="industry_slide_src_hover_{{$i_slide->id}}" data-industry-slide-src="industry_slide_src_{{$i_slide->id}}" data-industy-slide-id="{{$i_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col  text-center">
                                            <button onclick="save_industries_description(this)" data-descr-name="industries_descr_{{$key}}" data-file-name="descr_photo_url_{{$key}}" data-industry-id="{{$industry->id}}" type="button" class="btn_page btn_submit" style="margin: 2px">Save description</button>
                                            <button onclick="add_new_industries_slide(this)" data-industry-id="{{$industry->id}}" data-block-name="industries_list_{{$key}}"  type="button" class="btn_page_orange btn_submit" style="width:15.3125rem;">Add new slide</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div role="tabpanel" class="tab-pane fade" id="tailor_made_solutions">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Description</h3>
                                <div class="row">
                                    <div class="col" style="margin-bottom:20px;">
                                        <textarea id="tailor_descr" rows="10" cols="80" style="border-radius:4px;">{{$tailor_descr->text}}</textarea>
                                    </div>
                                </div>
                                <br>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Content</h3>
                                <div class="row draggablePanelList tailor_list">
                                    @foreach($tailor_slider as $slide)
                                        <div data-id="{{$slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel tailor_slider_item" style="margin-bottom:30px;">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file" accept="image/png, image/jpeg"  class="file dropify" data-height="500" data-default-file="{{$slide->src}}" />
                                                </div>
                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>
                                                <div class="col form-group p-0">
                                                    <input type="file" name="tailor_made_solutions_hover_image"  class="file1 dropify" data-height="500" data-default-file="{{$slide->src_hover}}" />
                                                </div>
                                                <textarea class="tailor_title" id="tailor_title_{{$slide->id}}" cols="30" rows="10">{{$slide->title}}</textarea>
                                                <h3 class="d-flex justify-content-center">Hover content</h3>
                                                <textarea class="tailor_descr" id="tailor_descr_{{$slide->id}}" cols="30" rows="10">{{$slide->descr}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_tailor_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_tailor_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button onclick="save_tailor_description(this)" type="button" class="btn_page" style="margin: 2px">Save description</button>
                                        <button onclick="add_new_tailor_slide()"  type="button" class="btn_page_orange" style="width:15.3125rem;">Add new slide</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="who_we_are">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Description</h3>
                                <div class="row">
                                    <div class="col" style="margin-bottom:20px;">
                                        <textarea id="wwa_descr" rows="10" cols="80" style="border-radius:4px;">{{$www_descr_main->text}}</textarea>
                                    </div>
                                </div>
                                <br>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Learn more</h3>
                                <div class="row draggablePanelList">
                                    <div class="col-sm-12 col-md-12 col-xl-12 panel" style="margin-bottom:30px;">
                                        <div class="panel-draggable" >
                                            <div class="col form-group p-0">
                                                <input type="file" accept="image/png, image/jpeg"  class="dropify first_wwa" data-height="500" data-default-file="{{$first_text_wwa->src}}" />
                                            </div>

                                            <textarea id="first_text_wwa" cols="30" rows="10">{{$first_text_wwa->text}}</textarea>
                                            <br>
                                            <textarea id="second_text_wwa" cols="30" rows="10">{{$second_text_wwa->text}}</textarea>
                                            <br>
                                            <div class="col form-group p-0">
                                                <input type="file" accept="image/png, image/jpeg"  class="dropify second_wwa" data-height="500" data-default-file="{{$second_text_wwa->src}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button onclick="save_wwa_description(this)" type="button" class="btn_page" style="margin: 2px">Save all texts</button>
                                        {{--<button onclick="add_new_wwa_slide()"  type="button" class="btn_page_orange" style="width:15.3125rem;">Add new slide</button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="join_us">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Description</h3>
                                <div class="row">
                                    <div class="col" style="margin-bottom:20px;">
                                        <textarea id="join_descr" rows="10" cols="80" style="border-radius:4px;">{{$join_desc->text}}</textarea>
                                    </div>
                                </div>
                                <br>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Content</h3>
                                <div class="row draggablePanelList join_list">
                                    @foreach($join_slider as $slide)
                                        <div data-id="{{$slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel join_slider_item" style="margin-bottom:30px;">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file" accept="image/png, image/jpeg"  class="file dropify" data-height="500" data-default-file="{{$slide->src}}" />
                                                </div>
                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>
                                                <div class="col form-group p-0">
                                                    <input type="file" name="join_us_hover_image"  class="file1 dropify" data-height="500" data-default-file="{{$slide->src_hover}}" />
                                                </div>
                                                <textarea class="join_title" id="join_title_{{$slide->id}}" cols="30" rows="10">{{$slide->title}}</textarea>
                                                <h3 class="d-flex justify-content-center">Hover content</h3>
                                                <textarea class="join_descr" id="join_descr_{{$slide->id}}" cols="30" rows="10">{{$slide->descr}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_join_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_join_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button onclick="save_join_description(this)" type="button" class="btn_page" style="margin: 2px">Save description</button>
                                        <button onclick="add_new_join_slide()"  type="button" class="btn_page_orange" style="width:15.3125rem;">Add new slide</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="address">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Address</h3>
                                <div class="row draggablePanelList">
                                    <div class="col-sm-12 col-md-6 col-xl-3 panel" style="margin-bottom:30px;">
                                        <div class="panel-draggable" >
                                            <textarea id="address1" cols="30" rows="10">{{$address1->text}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-3 panel" style="margin-bottom:30px;">
                                        <div class="panel-draggable" >
                                            <textarea id="address2"  cols="30" rows="10">{{$address2->text}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-3 panel" style="margin-bottom:30px;">
                                        <div class="panel-draggable" >
                                            <textarea id="email" cols="30" rows="10">{{$email->text}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-3 panel" style="margin-bottom:30px;">
                                        <div class="panel-draggable" >
                                            <textarea id="linkedin" cols="30" rows="10">{{$linkedin->text}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page" style="width:15.3125rem;" onclick="save_addresss()">Save page</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="contact">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <form action="">
                                    <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Marker</h3>
                                    <h5>Offices markers:</h5>
                                    <div class="office_markers">
                                        @foreach($markers as $marker)
                                            @if($marker->type=='office')
                                                <div class="row form-group">
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->lat}}" name="lat" class="form-control check_space check_number" required type="text" placeholder="Latitude"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->lng}}" name="lng" class="form-control" required type="text" placeholder="Longitude"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->title}}" name="title" class="form-control" required type="text" placeholder="City"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->content}}" name="content" class="form-control" required type="text" placeholder="More info"></div>
                                                    <div class="col-12 text-center">
                                                        <button onclick="delete_office_marker(this)" data-marker-id="{{$marker->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                        <input type="button"  onclick="save_office_marker(this,1)" data-marker-id="{{$marker->id}}" class="btn_page btn_submit" value="Save" style="width:10.3125rem;margin: 2px">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12 text-center">
                                            <button onclick="add_office_marker('office_markers',1)" type="button" class="btn_page_orange" style="margin: 2px">Add new Office marker</button>
                                        </div>
                                    </div>
                                </form>
                                <form action="">
                                    <h5>Markets markers:</h5>
                                    <div class="market_markers">
                                        @foreach($markers as $marker)
                                            @if($marker->type=='market')
                                                <div class="row form-group">
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->lat}}" name="lat" class="form-control check_space check_number" required type="text" placeholder="Latitude"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->lng}}" name="lng" class="form-control" required type="text" placeholder="Longitude"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->title}}" name="title" class="form-control" required type="text" placeholder="City"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->content}}" name="content" class="form-control" required type="text" placeholder="More info"></div>
                                                    <div class="col-12 text-center">

                                                        <button onclick="delete_office_marker(this)" data-marker-id="{{$marker->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                        <input type="button"  onclick="save_office_marker(this,2)" data-marker-id="{{$marker->id}}" class="btn_page btn_submit" value="Save" style="width:10.3125rem;margin: 2px">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-12 text-center">
                                            <button onclick="add_office_marker('market_markers',2)" type="button" class="btn_page_orange" style="margin: 2px">Add new Market marker</button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <div class="row">
                                    <div class="col-12  text-center">
                                        <button onclick="save_contact_description(this)" type="button" class="btn_page">Save page</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="navigations">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Navigations</h3>
                                <div class="row draggablePanelList">
                                    <div class="col-12 col-lg-4 form-group" style="margin-bottom:30px;">
                                        <input class="form-control" name="navigations_type_1" value="{{$n_t_1->text}}">
                                    </div>
                                    <div class="col-12 col-lg-4 form-group" style="margin-bottom:30px;">
                                            <input class="form-control" name="navigations_type_2" value="{{$n_t_2->text}}">
                                    </div>
                                    <div class="col-12 col-lg-4 form-group" style="margin-bottom:30px;">
                                            <input class="form-control" name="navigations_type_3" value="{{$n_t_3->text}}">
                                    </div>
                                    <div class="col-12 col-lg-4 form-group" style="margin-bottom:30px;">
                                        <input class="form-control" name="navigations_type_4" value="{{$n_t_4->text}}">
                                    </div>
                                    <div class="col-12 col-lg-4 form-group" style="margin-bottom:30px;">
                                        <input class="form-control" name="navigations_type_5" value="{{$n_t_5->text}}">
                                    </div>
                                    <div class="col-12 col-lg-4 form-group" style="margin-bottom:30px;">
                                        <input class="form-control" name="navigations_type_6" value="{{$n_t_6->text}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page" style="width:15.3125rem;" onclick="save_navigations()">Save page</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
        <div class="modal fade" style="z-index: 999999;" id="myModal_new_industry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header RalewaySemiBold">
                        <h4 class="modal-title" id="myModalLabel">NEW INDUSTRY</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="create_new_industries">
                        <div class="modal-body">
                            <div class="form-group" style="display: flex;">
                                <span class="ico_input"><img src="/public/img/admin/doc.png" alt="" style="margin-left: 0.6125rem;margin-right: 0.425rem;margin-top: 0.8375rem;width: 1.4375rem;height: 1.5625rem;"></span>
                                <input maxlength="35" type="text" name="title" class="form-control addon check_space check_letter title_new_industries" placeholder="Industry Name" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <input type="submit" class="btn_page " value="Create">
                            <button type="button" class="btn_page_orange modal_hide" data-dismiss="modal" style="background-color:#ffb74d;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @include('template.script_admin_template')
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="/public/js/dropify.js"></script>
    <script src="/public/ckeditor/ckeditor.js"></script>
    <script>
        var token = '{{$token}}';
        $('header').css('z-index','100');

        $('.nav_link_set').on('click',function () {
            localStorage['tab_main'] = $(this).attr('data-href');
            window.location = location;
        });

        function add_office_marker(block,type) {
            $('.'+block).append('<div class="row form-group">\n' +
                '                                        <div class="col-12 col-lg-4 form-group"><input class="form-control check_space check_number" name="lat" required type="text" placeholder="Latitude"></div>\n' +
                '                                        <div class="col-12 col-lg-4 form-group"><input class="form-control" required type="text" name="lng" placeholder="Longitude"></div>\n' +
                '                                        <div class="col-12 col-lg-4 form-group"><input class="form-control" required type="text" name="title" placeholder="Title"></div>\n' +
                '                                        <div class="col-12 text-center">\n' +
                '                                            <button onclick="delete_office_marker(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                            <input type="button" onclick="save_office_marker(this,'+type+')" class="btn_page" value="Save" style="width:10.3125rem;margin: 2px">\n' +
                '                                        </div>\n' +
                '                                    </div>');
        }

        function save_office_marker(btn,num) {
            var type = 'market';
            if(num==1){
                type ='office';
            }
            var marker_id = '';
            if($(btn).attr('data-marker-id')){
                marker_id = $(btn).attr('data-marker-id');
            }
            var parent = $(btn).parent().parent();
            $.ajax({
                url:"/api/admin/page/markers/edit",
                type:"POST",
                data:{
                    token:token,
                    marker_id:marker_id,
                    type:type,
                    lat:$(parent).find('input[name="lat"]').val(),
                    lng:$(parent).find('input[name="lng"]').val(),
                    title:$(parent).find('input[name="title"]').val(),
                    content:$(parent).find('input[name="content"]').val()
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    $(btn).attr('data-marker-id',data.marker_id);
                    sweet_modal('Success','success',1000);
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })

        }
        
        function save_navigations() {
            save_n_t_1();
            save_n_t_2();
            save_n_t_3();
            save_n_t_4();
            save_n_t_5();
            save_n_t_6();
            sweet_modal('Success','success',1000);
        }

        function save_n_t_1() {
            var formData = new FormData();
            formData.append('text',$('input[name="navigations_type_1"]').val());
            formData.append('type','navigations_type_1');
            formData.append('token',token);
            save_content(formData);
        }
        function save_n_t_2() {
            var formData = new FormData();
            formData.append('text',$('input[name="navigations_type_2"]').val());
            formData.append('type','navigations_type_2');
            formData.append('token',token);
            save_content(formData);
        }
        function save_n_t_3() {
            var formData = new FormData();
            formData.append('text',$('input[name="navigations_type_3"]').val());
            formData.append('type','navigations_type_3');
            formData.append('token',token);
            save_content(formData);
        }
        function save_n_t_4() {
            var formData = new FormData();
            formData.append('text',$('input[name="navigations_type_4"]').val());
            formData.append('type','navigations_type_4');
            formData.append('token',token);
            save_content(formData);
        }
        function save_n_t_5() {
            var formData = new FormData();
            formData.append('text',$('input[name="navigations_type_5"]').val());
            formData.append('type','navigations_type_5');
            formData.append('token',token);
            save_content(formData);
        }
        function save_n_t_6() {
            var formData = new FormData();
            formData.append('text',$('input[name="navigations_type_6"]').val());
            formData.append('type','navigations_type_6');
            formData.append('token',token);
            save_content(formData);
        }

        function save_content(formData) {
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    console.log(data);
                    sweet_modal('Something went wrong','error',3000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        }

        function delete_office_marker(btn) {
            if($(btn).attr('data-marker-id')){
                $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                    $.ajax({
                        url: "/api/admin/page/marker/delete",
                        type: "POST",
                        data: {token:token,marker_id: $(btn).attr('data-marker-id')},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            if (data.success == true) {
                                $(btn).parent().parent().remove();
                                sweet_modal('Success', 'success', 1000);
                            } else {
                                sweet_modal(data.message, 'error', 3000);
                            }
                            $(".btn_submit").removeAttr('disabled');
                        }, error: function (data) {
                            console.log(data);
                            sweet_modal('Something went wrong', 'error', 3000);
                            $(".btn_submit").removeAttr('disabled');
                        }
                    })
                })
            }else{
                $(btn).parent().parent().remove();
            }
        }

        $(document).ready(function () {
            console.log(localStorage['tab_main']);
            if(localStorage['tab_main']==undefined){
                $('.tab_first').addClass('active');
                $('.tab_first').removeClass('fade');
                $('.first_nav').addClass('active');
                main_slider_replace_ck();
            }else{
                $('div#'+localStorage['tab_main']).removeClass('fade');
                $('div#'+localStorage['tab_main']).addClass('active');
                $('a[href="#'+localStorage['tab_main']+'1"]').addClass('active');

                switch (localStorage['tab_main']){
                    case 'home':
                        main_slider_replace_ck();
                    break;

                    case 'our_brands':
                        brand_slider_replace_ck();
                    break;

                    case 'our_industries':
                        industries_replace_ck();
                    break;

                    case 'tailor_made_solutions':
                        tailor_replace_ck();
                    break;

                    case 'who_we_are':
                        wwa_replace_ck();
                    break;

                    case 'join_us':
                        join_replace_ck();
                    break;

                    case 'contact':
                        replace_ck('contact_descr');
                    break;

                    case 'address':
                        replace_ck('address1');
                        replace_ck('address2');
                        replace_ck('email');
                        replace_ck('linkedin');
                    break;

                    case 'navigations':

                    break;

                    default:
                        industries_list_list();
                    break;
                }
            }
        });

        //wwa
        function wwa_replace_ck() {
            replace_ck('wwa_descr');
            replace_ck('first_text_wwa');
            replace_ck('second_text_wwa');
        }

        //Tailor
        function tailor_replace_ck() {
            replace_ck('tailor_descr');
            @foreach($tailor_slider as $slide)
                replace_ck('tailor_title_{{$slide->id}}');
                replace_ck('tailor_descr_{{$slide->id}}');
            @endforeach
        }

        //Industries List
        function industries_list_list() {
            @foreach($all_industries as $key=>$industry)
                if(localStorage['tab_main'] == 'industry{{$key}}') {
                $( function() {
                    var textarea_id;
                    console.log(".industries_list_{{$key}}");
                    $(".industries_list_{{$key}}").sortable({
                        revert: true,
                        live: true,
                        start: function (item,ui) {
                            textarea_id = null;
                            var parent = ui.item;
                            textarea_id = $(parent).find('textarea').attr('id');
                            console.log(textarea_id);
                            CKEDITOR.instances[textarea_id].destroy();
                        },
                        stop: function (item) {
                            replace_ck(textarea_id);
                            industries_slider_pos_set('industries_slider_item{{$key}}');
                        }
                    });
                });
                    replace_ck('industries_descr_{{$key}}');
                    @foreach($industry->contents as $i_slide)
                        replace_ck('industry_slide_title_{{$i_slide->id}}');
                        replace_ck('industry_slide_descr_{{$i_slide->id}}');
                    @endforeach
                }

            @endforeach
        }

        //Main Slider
        function main_slider_replace_ck() {
            @foreach($main_slider as $slide_main)
                replace_ck('main_slider_{{$slide_main->id}}');
            @endforeach
        }

        //Industries
        function industries_replace_ck() {
            @foreach($all_industries as $industr)
                replace_ck('industries2_title_{{$industr->id}}');
            @endforeach
            replace_ck('industries_descr_noclick');
        }

        //Join slider
        function join_replace_ck() {
            replace_ck('join_descr');

            @foreach($join_slider as $slide)
                replace_ck('join_title_{{$slide->id}}');
                replace_ck('join_descr_{{$slide->id}}');
            @endforeach
        }

        //Brand Slider
        function brand_slider_replace_ck() {
            @foreach($brand_slider as $slide_brand)
                replace_ck('brand_slide_{{$slide_brand->id}}');
            @endforeach
            replace_ck('brand_descr');
        }




        $( function() {
            var textarea_id;
            $(".join_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('textarea').attr('id');
                    CKEDITOR.instances[textarea_id].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
                    join_list_slider_pos_set();
                }
            });
        });



        $( function() {
            var textarea_id;
            $(".sliders_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('textarea').attr('id');
                    console.log(textarea_id);
                    CKEDITOR.instances[textarea_id].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
                    main_slider_pos_set();
                }
            });
        });

        $( function() {
            var textarea_id;
            $(".brand_slider_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('textarea').attr('id');
                    console.log(textarea_id);
                    CKEDITOR.instances[textarea_id].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
                    brand_slider_pos_set();
                }
            });
        });

        $( function() {
            var textarea_id;
            $(".tailor_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('textarea').attr('id');
                    console.log(textarea_id);
                    CKEDITOR.instances[textarea_id].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
                    tailor_slider_pos_set();
                }
            });
        });


        $( function() {
            var textarea_id;
            $(".industries_list2").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('textarea').attr('id');
                    console.log(textarea_id);
                    CKEDITOR.instances[textarea_id].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
                    industries_slider_pos_set2();
                }
            });
        });

        function join_list_slider_pos_set() {
            var pos = '';
            $('.join_slider_item').each(function () {
                var id = $(this).attr('data-id');
                if(id){
                    pos+=id+',';
                }
            });
            pos = pos.substring(0, pos.length - 1);
            $.ajax({
                url:"/api/admin/page/join_slider/set_position",
                type:"POST",
                data:{positions:pos,token:token},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })
        }

        function tailor_slider_pos_set() {
            var pos = '';
            $('.tailor_slider_item').each(function () {
                var id = $(this).attr('data-id');
                if(id){
                    pos+=id+',';
                }
            });
            pos = pos.substring(0, pos.length - 1);
            $.ajax({
                url:"/api/admin/page/tailor_slider/set_position",
                type:"POST",
                data:{positions:pos},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })
        }

        function industries_slider_pos_set(item) {
            var pos = '';
            $('.'+item).each(function () {
                var id = $(this).attr('data-id');
                if(id){
                    pos+=id+',';
                }
            });
            pos = pos.substring(0, pos.length - 1);
            console.log(pos);
            $.ajax({
                url:"/api/admin/page/industries_slider/set_position",
                type:"POST",
                data:{positions:pos,token:token},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })
        }


        function industries_slider_pos_set2() {
            var pos = '';
            $('.industries_slider_item2').each(function () {
                var id = $(this).attr('data-id');
                if(id){
                    pos+=id+',';
                }
            });
            pos = pos.substring(0, pos.length - 1);
            $.ajax({
                url:"/api/admin/page/industries/set_position",
                type:"POST",
                data:{token:token,positions:pos},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })
        }

        function brand_slider_pos_set() {
            var pos = '';
            $('.brand_slider_item').each(function () {
                var id = $(this).attr('data-id');
                if(id){
                    pos+=id+',';
                }
            });
            pos = pos.substring(0, pos.length - 1);

            $.ajax({
                url:"/api/admin/page/brand_slider/set_position",
                type:"POST",
                data:{positions:pos},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })
        }

        function join_slider_pos_set() {
            var pos = '';
            $('.join_item').each(function () {
                var id = $(this).attr('data-id');
                if(id){
                    pos+=id+',';
                }
            });
            pos = pos.substring(0, pos.length - 1);
            $.ajax({
                url:"/api/admin/page/join_slider/set_position",
                type:"POST",
                data:{positions:pos},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })
        }

        function main_slider_pos_set() {
            var pos = '';
            $('.slider_item').each(function () {
                var id = $(this).attr('data-id');
                if(id){
                    pos+=id+',';
                }
            });
            pos = pos.substring(0, pos.length - 1);
            $.ajax({
                url:"/api/admin/page/main_slider/set_position",
                type:"POST",
                data:{positions:pos},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })
        }

        function replace_ck(name) {
            CKEDITOR.replace(name);
        }

        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
        $(document).ready(function () {
            $(".header_text").html('Web Content');
        });

        function add_new_brand_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.brand_slider_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel brand_slider_item" style="margin-bottom:30px;">\n' +
                '                                                <div class="panel-draggable" >\n' +
                '                                                    <div class="col form-group p-0">\n' +
                '                                                        <input type="file" accept="image/png, image/jpeg"  class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                    </div>\n' +
                '                                                    <textarea id="brand_slide_'+rnd+'"  cols="30" rows="10"></textarea>\n' +
                '                                                </div>\n' +
                '                                                <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                    <button onclick="delete_brand_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                    <button onclick="save_brand_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                                </div>\n' +
                '                                            </div>');
            $('.dropify').dropify();
            replace_ck('brand_slide_'+rnd)
        }

        function add_new_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.sliders_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel slider_item" style="margin-bottom:30px;">\n' +
                '                                                <div class="panel-draggable" >\n' +
                '                                                    <div class="col form-group p-0">\n' +
                '                                                        <input type="file" accept="image/png, image/jpeg"  class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                    </div>\n' +
                '                                                    <textarea id="main_slider_'+rnd+'"  cols="30" rows="10"></textarea>\n' +
                '                                                </div>\n' +
                '                                                <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                    <button onclick="delete_main_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                    <button onclick="save_main_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                                </div>\n' +
                '                                            </div>');
            $('.dropify').dropify();
            replace_ck('main_slider_'+rnd);
        }

        function add_new_tailor_slide() {
            var rnd1 = Math.floor(Math.random() * 1000000) + 1;
            var rnd2 = Math.floor(Math.random() * 1000000) + 1;
            $('.tailor_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel tailor_slider_item" style="margin-bottom:30px;">\n' +
                '                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>\n' +
                '                                            <div class="panel-draggable" >\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file" accept="image/png, image/jpeg"  class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                '<h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file" name="tailor_made_solutions_hover_image"  class="file1 dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>'+
                '                                                <textarea class="tailor_title" id="tailor_title_'+rnd1+'" cols="30" rows="10"></textarea>\n' +
                '                                                <h3 class="d-flex justify-content-center">Hover content</h3>\n' +
                '                                                <textarea class="tailor_descr" id="tailor_descr_'+rnd2+'" cols="30" rows="10"></textarea>\n' +
                '                                            </div>\n' +
                '                                            <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                <button onclick="delete_tailor_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                <button onclick="save_tailor_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                            </div>\n' +
                '                                        </div>');
            $('.dropify').dropify();
            replace_ck('tailor_title_'+rnd1);
            replace_ck('tailor_descr_'+rnd2);
        }

        function add_new_join_slide() {
            var rnd1 = Math.floor(Math.random() * 1000000) + 1;
            var rnd2 = Math.floor(Math.random() * 1000000) + 1;
            $('.join_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel join_slider_item" style="margin-bottom:30px;">\n' +
                '                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>\n' +
                '                                            <div class="panel-draggable" >\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file" accept="image/png, image/jpeg"  class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                    '<h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file" name="join_us_hover_image"  class="dropify" data-height="500" data-default-file="#" />\n' +
                '                                                </div>'+
                '                                                <textarea class="join_title" id="join_title_'+rnd1+'" cols="30" rows="10"></textarea>\n' +
                '                                                <h3 class="d-flex justify-content-center">Hover content</h3>\n' +
                '                                                <textarea class="join_descr" id="join_descr_'+rnd2+'" cols="30" rows="10"></textarea>\n' +
                '                                            </div>\n' +
                '                                            <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                <button onclick="delete_join_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                <button onclick="save_join_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                            </div>\n' +
                '                                        </div>');
            $('.dropify').dropify();
            replace_ck('join_title_'+rnd1);
            replace_ck('join_descr_'+rnd2);
        }

        function add_new_industries_slide(btn) {
            $(".btn_submit").attr('disabled','disabled');
            var block = $('.'+$(btn).attr('data-block-name'));
            var rnd1 = Math.floor(Math.random() * 1000000) + 1;
            $(block).append('<div class="col-sm-12 col-md-6 col-xl-4 panel" style="margin-bottom:30px;">\n' +
                '                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>\n' +
                '                                            <div class="panel-draggable" >\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file" accept="image/png, image/jpeg"  class="industry_slide_src_'+rnd1+' dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                    '<h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>\n' +
                '                                                    <div class="col form-group p-0">\n' +
                '                                                        <input type="file" name="industries_hover_image"  class="industry_slide_src_hover_'+rnd1+' file1 dropify" data-height="500" data-default-file="" />\n' +
                '                                                    </div>'+
                '                                                <textarea class="industries_title" id="industry_slide_title_'+rnd1+'"  cols="30" rows="10"></textarea>\n' +
                '                                                <h3 class="d-flex justify-content-center">Click content</h3>\n' +
                '<div class="col form-group p-0">'+
                '<input type="file" name="file1" accept="image/png, image/jpeg"  class="industry_slide_src1_'+rnd1+' dropify" data-height="500" />'+
                '</div>'+
                '                                                <textarea class="industries_descr" id="industry_slide_descr_'+rnd1+'" cols="30" rows="10"></textarea>\n' +
                '                                                <br>\n' +
                '                                                <input class="form-control industry_slide_link_'+rnd1+'" name="link" type="text" placeholder="Link website">\n' +
                '                                            </div>\n' +
                '                                            <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                <button onclick="delete_industries_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                <button onclick="save_industries_slide(this)" data-industry-slide-link="industry_slide_link_'+rnd1+'" data-industry-slide-descr="industry_slide_descr_'+rnd1+'" data-industry-slide-src1="industry_slide_src1_'+rnd1+'" data-industry-slide-title="industry_slide_title_'+rnd1+'" data-industry-slide-src="industry_slide_src_'+rnd1+'" data-industry-id="'+$(btn).attr('data-industry-id')+'" type="button" data-industry-slide-id="" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                            </div>\n' +
                '                                        </div>');
            $('.dropify').dropify();
            replace_ck('industry_slide_title_'+rnd1);
            replace_ck('industry_slide_descr_'+rnd1);
            $(".btn_submit").removeAttr('disabled');
        }


        function save_tailor_slide(btn) {
            var parent = $(btn).parent().parent();
            var textarea_title = $(parent).find('textarea.tailor_title').attr('id');
            var textarea_descr = $(parent).find('textarea.tailor_descr').attr('id');
            var input_file = $(parent).find('.file')[0];
            var input_file1 = $(parent).find('.file1')[0];
            var title = CKEDITOR.instances[textarea_title].getData();
            var descr = CKEDITOR.instances[textarea_descr].getData();
            var tailor_slide_id = $(parent).attr('data-id');
            var formData = new FormData();
            var file = '';
            var file1 = '';
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            if (input_file1.files && input_file1.files[0]) {
                file1 = input_file1.files[0];
            }
            formData.append('title',title);
            formData.append('descr',descr);
            formData.append('file',file);
            formData.append('file1',file1);
            if(tailor_slide_id) {
                formData.append('tailor_slide_id', tailor_slide_id);
            }
            ajax_tailor_slide(formData,parent);
        }

        function save_join_slide(btn) {
            var parent = $(btn).parent().parent();
            var textarea_title = $(parent).find('textarea.join_title').attr('id');
            var textarea_descr = $(parent).find('textarea.join_descr').attr('id');
            var input_file = $(parent).find('.file')[0];
            var input_file1 = $(parent).find('.file1')[0];
            var title = CKEDITOR.instances[textarea_title].getData();
            var descr = CKEDITOR.instances[textarea_descr].getData();
            var join_slide_id = $(parent).attr('data-id');
            var formData = new FormData();
            var file = '';
            var file1 = '';
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            if (input_file1.files && input_file1.files[0]) {
                file1 = input_file1.files[0];
            }
            formData.append('title',title);
            formData.append('descr',descr);
            formData.append('file',file);
            formData.append('file1',file1);
            if(join_slide_id) {
                formData.append('join_slide_id', join_slide_id);
            }
            ajax_join_slide(formData,parent);
        }

        function save_industries_slide(btn) {
            var parent = $(btn).parent().parent();
            var input_file = $('.'+$(btn).attr('data-industry-slide-src'))[0];
            var input_file2 = $('.'+$(btn).attr('data-industry-slide-src-hover'))[0];
            var input_file1 = $('.'+$(btn).attr('data-industry-slide-src1'))[0];
            var title = CKEDITOR.instances[$(btn).attr('data-industry-slide-title')].getData();
            var descr = CKEDITOR.instances[$(btn).attr('data-industry-slide-descr')].getData();
            var industries_slide_id = $(btn).attr('data-industy-slide-id');
            var formData = new FormData();
            var file = '';
            var file1 = '';
            var file2 = '';
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }

            if (input_file1.files && input_file1.files[0]) {
                file1 = input_file1.files[0];
            }

            if (input_file2.files && input_file2.files[0]) {
                file2 = input_file2.files[0];
            }
            formData.append('link',$('.'+$(btn).attr('data-industry-slide-link')).val());
            formData.append('title',title);
            formData.append('descr',descr);
            formData.append('file',file);
            formData.append('file1',file1);
            formData.append('file2',file2);
            formData.append('token',token);
            formData.append('industry_id',$(btn).attr('data-industry-id'));
            if(industries_slide_id) {
                formData.append('industry_slide_id', industries_slide_id);
            }
            ajax_industries_slide(formData,parent);
        }


        $('form.create_new_industries').on('submit',function (e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('title',$('.title_new_industries').val());
            formData.append('token',token);
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/page/industries/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    $('.modal_hide').click();
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/admin/dis-content';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',3000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    $('.modal_hide').click();
                    console.log(data);
                    sweet_modal('Something went wrong','error',3000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        });


        function save_industries_slide2(btn) {
            var formData = new FormData();
            var parent = $(btn).parent().parent();
            var industries_slide_id = $(parent).attr('data-id');
            var textarea_title = $(parent).find('textarea.industries_title2').attr('id');
            var input_file = $(parent).find('.industries_photo_one')[0];
            var input_file1 = $(parent).find('.industries_photo_two')[0];
            var file='';
            var file1='';
            var title = CKEDITOR.instances[textarea_title].getData();
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            if (input_file1.files && input_file1.files[0]) {
                file1 = input_file1.files[0];
            }
            formData.append('title',title);
            formData.append('file',file);
            formData.append('file1',file1);
            formData.append('token',token);
            if(industries_slide_id) {
                formData.append('industries_slide_id', industries_slide_id);
            }
            ajax_industries_slide2(formData,parent);
        }

        function save_main_slide(btn) {
            var parent = $(btn).parent().parent();
            var textarea_id = $(parent).find('textarea').attr('id');
            var input_file = $(parent).find('input[type="file"]')[0];
            var title = CKEDITOR.instances[textarea_id].getData();
            var main_slide_id = $(parent).attr('data-id');
            var formData = new FormData();
            var file = '';
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            formData.append('title',title);
            formData.append('file',file);
            formData.append('token',token);
            if(main_slide_id) {
                formData.append('main_slide_id', main_slide_id);
            }
            ajax_main_slide(formData,parent);
        }

        function save_brand_slide(btn) {
            var parent = $(btn).parent().parent();
            var textarea_id = $(parent).find('textarea').attr('id');
            var input_file = $(parent).find('input[type="file"]')[0];
            var title = CKEDITOR.instances[textarea_id].getData();
            var brand_slide_id = $(parent).attr('data-id');
            var formData = new FormData();
            var file = '';
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            formData.append('title',title);
            formData.append('file',file);
            formData.append('token',token);
            if(brand_slide_id) {
                formData.append('brand_slide_id', brand_slide_id);
            }
            ajax_brand_slide(formData,parent);
        }

        function delete_main_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var main_slide_id = $(parent).attr('data-id');
                if (main_slide_id) {
                    $.ajax({
                        url: "/api/admin/page/main_slider/delete",
                        type: "POST",
                        data: {main_slide_id: main_slide_id,token:token},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            if (data.success == true) {
                                $(parent).remove();
                                sweet_modal('Success', 'success', 1000);
                            } else {
                                sweet_modal(data.message, 'error', 3000);
                            }
                            $(".btn_submit").removeAttr('disabled');
                        }, error: function (data) {
                            console.log(data);
                            sweet_modal('Something went wrong', 'error', 3000);
                            $(".btn_submit").removeAttr('disabled');
                        }
                    })
                } else {
                    $(parent).remove();
                }
            })
        }

        function delete_tailor_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var tailor_slide_id = $(parent).attr('data-id');
                if (tailor_slide_id) {
                    $.ajax({
                        url: "/api/admin/page/tailor/delete",
                        type: "POST",
                        data: {tailor_slide_id: tailor_slide_id},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            if (data.success == true) {
                                $(parent).remove();
                                sweet_modal('Success', 'success', 1000);
                            } else {
                                sweet_modal(data.message, 'error', 3000);
                            }
                            $(".btn_submit").removeAttr('disabled');
                        }, error: function (data) {
                            console.log(data);
                            sweet_modal('Something went wrong', 'error', 3000);
                            $(".btn_submit").removeAttr('disabled');
                        }
                    })
                } else {
                    $(parent).remove();
                }
            })
        }
        function delete_industry(btn) {
            $(".btn_submit").attr('disabled','disabled');
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var industry_id = $(btn).attr('data-industry-id');
                if (industry_id) {
                    $.ajax({
                        url: "/api/admin/page/industry/delete",
                        type: "POST",
                        data: {token:token,industry_id: industry_id},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            if (data.success == true) {
                                $(parent).remove();
                                sweet_modal('Success', 'success', 1000);
                                setTimeout(function () {
                                    window.location = '/panel/admin/dis-content';
                                },1000);
                            } else {
                                sweet_modal(data.message, 'error', 3000);
                            }
                            $(".btn_submit").removeAttr('disabled');
                        }, error: function (data) {
                            console.log(data);
                            sweet_modal('Something went wrong', 'error', 3000);
                            $(".btn_submit").removeAttr('disabled');
                        }
                    })
                } else {
                    $(parent).remove();
                }
            })
        }

        function delete_industries_slide(btn) {
            $(".btn_submit").attr('disabled','disabled');
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var industry_slide_id = $(btn).attr('data-industry-slide-id');
                console.log(industry_slide_id);
                if (industry_slide_id) {
                    $.ajax({
                        url: "/api/admin/page/industries_slide/delete",
                        type: "POST",
                        data: {token:token,industry_slide_id: industry_slide_id},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            if (data.success == true) {
                                $(parent).remove();
                                sweet_modal('Success', 'success', 1000);
                            } else {
                                sweet_modal(data.message, 'error', 3000);
                            }
                            $(".btn_submit").removeAttr('disabled');
                        }, error: function (data) {
                            console.log(data);
                            sweet_modal('Something went wrong', 'error', 3000);
                            $(".btn_submit").removeAttr('disabled');
                        }
                    })
                } else {
                    $(parent).remove();
                }
            })
        }

        function delete_brand_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var brand_slide_id = $(parent).attr('data-id');
                if (brand_slide_id) {
                    $.ajax({
                        url: "/api/admin/page/brand_slider/delete",
                        type: "POST",
                        data: {brand_slide_id: brand_slide_id,token:token},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            if (data.success == true) {
                                $(parent).remove();
                                sweet_modal('Success', 'success', 1000);
                            } else {
                                sweet_modal(data.message, 'error', 3000);
                            }
                            $(".btn_submit").removeAttr('disabled');
                        }, error: function (data) {
                            console.log(data);
                            sweet_modal('Something went wrong', 'error', 3000);
                            $(".btn_submit").removeAttr('disabled');
                        }
                    })
                } else {
                    $(parent).remove();
                }
            })
        }

        function delete_join_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var join_slide_id = $(parent).attr('data-id');
                if (join_slide_id) {
                    $.ajax({
                        url: "/api/admin/page/join_slider/delete",
                        type: "POST",
                        data: {join_slide_id: join_slide_id},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            if (data.success == true) {
                                $(parent).remove();
                                sweet_modal('Success', 'success', 1000);
                            } else {
                                sweet_modal(data.message, 'error', 3000);
                            }
                            $(".btn_submit").removeAttr('disabled');
                        }, error: function (data) {
                            console.log(data);
                            sweet_modal('Something went wrong', 'error', 3000);
                            $(".btn_submit").removeAttr('disabled');
                        }
                    })
                } else {
                    $(parent).remove();
                }
            })
        }

        function ajax_join_slide(formData,parent) {
            $.ajax({
                url:"/api/admin/page/join_slider/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        $(parent).attr('data-id',data.id)
                        sweet_modal('Success','success',1000);
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

        function ajax_tailor_slide(formData,parent) {
            $.ajax({
                url:"/api/admin/page/tailor_slider/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        $(parent).attr('data-id',data.id)
                        sweet_modal('Success','success',1000);
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


        function ajax_industries_slide2(formData,parent) {
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/page/industries/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        $(parent).attr('data-id',data.id)
                        sweet_modal('Success','success',1000);
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

        function ajax_industries_slide(formData,parent) {
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/page/industries_slider/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){

                        sweet_modal('Success','success',1000);
                        if(data.type=='create') {
                            setTimeout(function () {
                                window.location = '/panel/admin/dis-content';
                            }, 1000);
                        }
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

        function ajax_brand_slide(formData,parent) {
            $.ajax({
                url:"/api/admin/page/brand_slider/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        $(parent).attr('data-id',data.id);
                        sweet_modal('Success','success',1000);
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

        function ajax_main_slide(formData,parent) {
            $.ajax({
                url:"/api/admin/page/main_slider/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        $(parent).attr('data-id',data.id)
                        sweet_modal('Success','success',1000);
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


        function save_brand_description(btn) {
            var text = CKEDITOR.instances['brand_descr'].getData();
            var type = 'brand_descr';
            console.log(text);
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:{text:text,type:type},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
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

        function save_join_description(btn) {
            var text = CKEDITOR.instances['join_descr'].getData();
            var type = 'join_descr';
            console.log(text);
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:{text:text,type:type},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
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

        function save_tailor_description(btn) {
            var text = CKEDITOR.instances['tailor_descr'].getData();
            var type = 'tailor_descr';
//            console.log(text);
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:{text:text,type:type},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
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


        function save_wwa_description() {
            wwa_main_descr();
            wwa_first_descr();
            wwa_second_descr();
            sweet_modal('Success','success',1000);
        }

        function wwa_first_descr() {
            var text = CKEDITOR.instances['first_text_wwa'].getData();
            var type = 'first_text_wwa';
            var file = $('.first_wwa')[0].files[0];
            var formData = new FormData();
            formData.append('text',text);
            formData.append('type',type);
            if(file) {
                formData.append('file', file);
            }
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
//                        sweet_modal('Success','success',1000);
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

        function wwa_second_descr() {
            var text = CKEDITOR.instances['second_text_wwa'].getData();
            var type = 'second_text_wwa';
            var file = $('.second_wwa')[0].files[0];
            var formData = new FormData();
            formData.append('text',text);
            formData.append('type',type);
            if(file) {
                formData.append('file', file);
            }
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
//                        sweet_modal('Success','success',1000);
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

        function wwa_main_descr() {
            var text = CKEDITOR.instances['wwa_descr'].getData();
            var type = 'wwa_descr';
            console.log(text);
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:{text:text,type:type},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
//                        sweet_modal('Success','success',1000);
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

        function save_contact_description(btn) {
            var text = CKEDITOR.instances['contact_descr'].getData();
            var type = 'contact_descr';
//            var file = $('.contact_photo')[0].files[0];
            var formData = new FormData();
            formData.append('text',text);
            formData.append('type',type);
//            if(file) {
//                formData.append('file', file);
//            }
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
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

        function save_industries_description2(btn) {
            var text = CKEDITOR.instances['industries_descr_noclick'].getData();
            var type = 'industries_descr2';
//            console.log(text);
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:{text:text,type:type},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
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

        function save_industries_description(btn) {
            var text = CKEDITOR.instances[$(btn).attr('data-descr-name')].getData();
            var file = $('.'+$(btn).attr('data-file-name'))[0].files[0];
            var formData = new FormData();
            formData.append('descr',text);
            formData.append('token',token);
            formData.append('industry_id',$(btn).attr('data-industry-id'));
            if(file) {
                formData.append('descr_photo_url', file);
            }
            $.ajax({
                url:"/api/admin/page/industries_descr_photo/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
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

        function save_addresss() {
            save_address_description('address1','address1');
            save_address_description('address2','address2');
            save_address_description('email','email');
            save_address_description('linkedin','linkedin');
            sweet_modal('Success','success',1000);
        }

        function save_address_description(textareaid,type) {
            var text = CKEDITOR.instances[textareaid].getData();
            var formData = new FormData();
            formData.append('text',text);
            formData.append('type',type);
            $.ajax({
                url:"/api/admin/page/descr_main/edit",
                type:"POST",
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
//                        sweet_modal('Success','success',1000);
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
        $('.check_space').blur(function(){
            $(this).val($.trim($(this).val()));
        });
    </script>
@endsection