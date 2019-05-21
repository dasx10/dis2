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
                        <a class="nav-link  nav_catalog nav_link_set" data-href="about_brand_profile" href="#about_brand_profile1" role="tab" data-toggle="tab">About Brand Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="certifications" href="#certifications1" role="tab" data-toggle="tab">About Certifications</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="quality_assurance" href="#quality_assurance1" role="tab" data-toggle="tab">About Quality Assurance</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="packing" href="#packing1" role="tab" data-toggle="tab">Packing</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="download_kit" href="#download_kit1" role="tab" data-toggle="tab">Download Kit</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="contact_us" href="#contact_us1" role="tab" data-toggle="tab">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="productscategory" href="#productscategory1" role="tab" data-toggle="tab">Products Categories</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="products" href="#products1" role="tab" data-toggle="tab">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  nav_catalog nav_link_set" data-href="markets" href="#markets1" role="tab" data-toggle="tab">Markets</a>
                    </li>

                </ul>
                <div class="tab-content">

                    {{--//Home--}}
                    <div role="tabpanel" class="tab-pane tab_first" id="home">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Slider</h3>
                                <div class="row draggablePanelList main_page_slider_list">
                                    @foreach($dolchem_main_page_content as $dolchem_main_page_slide)
                                        <div data-id="{{$dolchem_main_page_slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel main_page_slide" style="margin-bottom:30px;position: relative">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file" accept="image/png, image/jpeg"  class="dropify" data-height="500" data-default-file="{{$dolchem_main_page_slide->photo_url}}" />
                                                </div>
                                                <textarea class="textarea" id="main_page_slider_{{$dolchem_main_page_slide->id}}"  cols="30" rows="10">{{$dolchem_main_page_slide->title}}</textarea>
                                                <br>
                                                <textarea class="textarea1" id="main_page_slider1_{{$dolchem_main_page_slide->id}}"  cols="30" rows="10">{{$dolchem_main_page_slide->title1}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_main_page_slide(this)" data-id="{{$dolchem_main_page_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_main_page_slide(this)" data-id="{{$dolchem_main_page_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit" style="width:15.3125rem;" onclick="add_new_main_page_slide()">Add new slide</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--//End Home--}}

                    {{--//About Brand Profile--}}
                    <div role="tabpanel" class="tab-pane" id="about_brand_profile">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style=";margin-bottom:15px;">Brand Text</h3>
                                <div class="row form-group">
                                    <div class="col-12 col-lg-12 form-group"><input value="{{$dolchem_brand_text->text}}" name="brand_text" class="form-control check_space" required type="text" placeholder="Brand Text"></div>
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit"  onclick="save_brand_text()">Save brand text</button>
                                    </div>
                                </div>

                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">About Brand Profile</h3>
                                <div class="row draggablePanelList brand_profile_slider_list">
                                    @foreach($dolchem_about_brand_profile as $dolchem_about_brand_slide)
                                        <div data-id="{{$dolchem_about_brand_slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel brand_profile_slide" style="margin-bottom:30px;position: relative">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file"   class="dropify" data-height="500" data-default-file="{{$dolchem_about_brand_slide->photo_url}}" />
                                                </div>
                                                <textarea id="brand_profile_{{$dolchem_about_brand_slide->id}}" class="textarea"  cols="30" rows="10">{{$dolchem_about_brand_slide->title}}</textarea>
                                                <br>
                                                <textarea id="brand_profile1_{{$dolchem_about_brand_slide->id}}" class="textarea1"  cols="30" rows="10">{{$dolchem_about_brand_slide->title1}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_about_brand_profile_slide(this)" data-id="{{$dolchem_about_brand_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_about_brand_profile_slide(this)" data-id="{{$dolchem_about_brand_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit"  onclick="add_new_about_brand_profile_slide()">Add new brand profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--//End About brand Profile--}}

                    {{--//Certifications--}}
                    <div role="tabpanel" class="tab-pane" id="certifications">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">About Сertifications</h3>
                                <div class="row draggablePanelList certifications_slider_list">
                                    @foreach($dolchem_certifications as $dolchem_certifications_slide)
                                        <div data-id="{{$dolchem_certifications_slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel certifications_slide" style="margin-bottom:30px;position: relative">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file"   class="dropify" data-height="500" data-default-file="{{$dolchem_certifications_slide->photo_url}}" />
                                                </div>
                                                <textarea id="certifications_{{$dolchem_certifications_slide->id}}" class="textarea"  cols="30" rows="10">{{$dolchem_certifications_slide->title}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_certifications_slide(this)" data-id="{{$dolchem_certifications_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_certifications_slide(this)" data-id="{{$dolchem_certifications_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit" onclick="add_new_certifications_slide()">Add new certificate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--//End Certifications--}}


                    {{--//Quality Assurance--}}
                    <div role="tabpanel" class="tab-pane" id="quality_assurance">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Content</h3>
                                <p><textarea id="quality_assurance_content" class="textarea"  cols="30" rows="10">{{$dolchem_quality_assurance_text->text}}</textarea></p>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">About Quality Assurance</h3>
                                <div class="row draggablePanelList quality_assurance_slider_list">
                                    @foreach($dolchem_quality_assurance as $dolchem_quality_assurance_slide)
                                        <div data-id="{{$dolchem_quality_assurance_slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel quality_assurance_slide" style="margin-bottom:30px;position: relative">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <div class="col form-group p-0">
                                                    <input type="file"   class="dropify" data-height="500" data-default-file="{{$dolchem_quality_assurance_slide->photo_url}}" />
                                                </div>
                                                <textarea id="quality_assurance_{{$dolchem_quality_assurance_slide->id}}" class="textarea"  cols="30" rows="10">{{$dolchem_quality_assurance_slide->title}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_quality_assurance_slide(this)" data-id="{{$dolchem_quality_assurance_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_quality_assurance_slide(this)" data-id="{{$dolchem_quality_assurance_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit" onclick="add_new_quality_assurance_slide()">Add new quality assurance</button>
                                        <button type="button" class="btn_page btn_submit" onclick="save_quality_assurance_content()">Save Description</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--//End Quality Assurance--}}


                    {{--//Packing--}}
                    <div role="tabpanel" class="tab-pane" id="packing">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Packing</h3>
                                <div class="row draggablePanelList packing_slider_list">
                                    @foreach($dolchem_packing as $dolchem_packing_slide)
                                        <div data-id="{{$dolchem_packing_slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel packing_slide" style="margin-bottom:30px;position: relative">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image</h3>
                                                <div class="col form-group p-0">
                                                    <input type="file"  name="packing_image" class="dropify" data-height="500" data-default-file="{{$dolchem_packing_slide->photo_url}}" />
                                                </div>
                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>
                                                <div class="col form-group p-0">
                                                    <input type="file" name="packing_hover_image"  class="dropify" data-height="500" data-default-file="{{$dolchem_packing_slide->photo_url_hover}}" />
                                                </div>
                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Title & Description</h5>
                                                <textarea id="packing_title_{{$dolchem_packing_slide->id}}" class="textarea"  cols="30" rows="10">{{$dolchem_packing_slide->title}}</textarea>
                                                <textarea id="packing_descr_{{$dolchem_packing_slide->id}}" class="textarea1"  cols="30" rows="10">{{$dolchem_packing_slide->descr}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_packing_slide(this)" data-id="{{$dolchem_packing_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_packing_slide(this)" data-id="{{$dolchem_packing_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit" onclick="add_new_packing_slide()">Add new packing</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--//End Packing--}}


                    {{--//Download Kit--}}
                    <div role="tabpanel" class="tab-pane" id="download_kit">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Download Kit</h3>
                                <div class="row draggablePanelList download_kit_slider_list">
                                    @foreach($dolchem_download_kit as $dolchem_download_kit_slide)
                                        <div data-id="{{$dolchem_download_kit_slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel download_kit_slide" style="margin-bottom:30px;position: relative">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image</h3>
                                                <div class="col form-group p-0">
                                                    <input type="file"  name="image" class="dropify" data-height="500" data-default-file="{{$dolchem_download_kit_slide->photo_url}}" />
                                                </div>
                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image Hover</h3>
                                                <div class="col form-group p-0">
                                                    <input type="file"  name="image_hover" class="dropify" data-height="500" data-default-file="{{$dolchem_download_kit_slide->photo_url_hover}}" />
                                                </div>
                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Download File</h5>
                                                <div class="col form-group p-0">
                                                    <input type="file" name="download_kit_file"   data-height="500" />
                                                </div>
                                                <textarea id="download_kit_title_{{$dolchem_download_kit_slide->id}}" class="textarea"  cols="30" rows="10">{{$dolchem_download_kit_slide->title}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_download_kit_slide(this)" data-id="{{$dolchem_download_kit_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_download_kit_slide(this)" data-id="{{$dolchem_download_kit_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit" onclick="add_new_download_kit_slide()">Add new download kit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--//End Download Kit--}}

                    {{--//Contact Us--}}
                    <div role="tabpanel" class="tab-pane" id="contact_us">
                        <div class="card box-shadow">
                            <div class="card-block">

                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Contact Us Text</h3>
                                <div class="row form-group">
                                    <div class="col-12 col-lg-12 form-group"><input value="{{$dolchem_contact_us_text->text}}" name="contact_us_text" class="form-control check_space" required type="text" placeholder="Contact Us Text"></div>
                                </div>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Footer - Address</h3>
                                    <div class="row form-group">
                                        <div class="col-12 col-lg-6 form-group"><input value="{{$dolchem_address_text->text}}" name="address_text" class="form-control check_space" required type="text" placeholder="Text"></div>
                                        <div class="col-12 col-lg-6 form-group"><input value="{{$dolchem_address_text->text1}}" name="address_text1" class="form-control check_space" required type="text" placeholder="Text1"></div>
                                        <div class="col-12 col-lg-6 form-group"><input value="{{$dolchem_telephone_text->text}}" name="telephone" class="form-control check_space" required type="text" placeholder="Telephone Number"></div>
                                    </div>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Footer - Address1</h3>
                                    <div class="row form-group">
                                        <div class="col-12 col-lg-6 form-group"><input value="{{$dolchem_address1_text->text}}" name="address1_text" class="form-control check_space" required type="text" placeholder="Text"></div>
                                        <div class="col-12 col-lg-6 form-group"><input value="{{$dolchem_address1_text->text1}}" name="address1_text1" class="form-control check_space" required type="text" placeholder="Text1"></div>
                                        <div class="col-12 col-lg-6 form-group"><input value="{{$dolchem_telephone1_text->text}}" name="telephone1" class="form-control check_space" required type="text" placeholder="Telephone Number"></div>
                                    </div>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Footer - Email</h3>
                                    <div class="row form-group">
                                        <div class="col-12 col-lg-12 form-group"><input value="{{$dolchem_email_text->text}}" name="email" class="form-control check_space" required type="text" placeholder="Email"></div>
                                    </div>
                                <h3 class="d-flex justify-content-center" style=";margin-bottom:15px;">Footer - LinkedIn Link</h3>
                                    <div class="row form-group">
                                        <div class="col-12 col-lg-12 form-group"><input value="{{$dolchem_linkedin_link_text->text}}" name="linkedin_link" class="form-control check_space" required type="text" placeholder="LinkedIn Link"></div>
                                    </div>
                                <div class="row form-group">
                                    <div class="col-12 text-center">
                                        <button onclick="save_descr()" type="button" class="btn_page_orange" style="margin: 2px">Save Text</button>
                                    </div>
                                </div>
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Markers</h3>
                                <form action="">
                                    <h5>Offices markers:</h5>
                                    <div class="office_markers">
                                        @foreach($dolchem_markers as $marker)
                                            @if($marker->type=='office')
                                                <div class="row form-group">
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->lat}}" name="lat" class="form-control check_space check_number" required type="text" placeholder="Latitude"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->lng}}" name="lng" class="form-control" required type="text" placeholder="Longitude"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->title}}" name="title" class="form-control" required type="text" placeholder="Title"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->content}}" name="content" class="form-control"  type="text" placeholder="Content"></div>
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
                                            <button onclick="add_office_marker('office_markers',1)" type="submit" class="btn_page_orange" style="margin: 2px">Add new Office marker</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--//End Contact Us--}}
                    {{--//Markets--}}
                    <div role="tabpanel" class="tab-pane" id="markets">
                        <div class="card box-shadow">
                            <div class="card-block">

                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">About Markets Text</h3>
                                <div class="row form-group">
                                    <div class="col-12 col-lg-12 form-group"><input value="{{$dolchem_about_markets_text->text}}" name="about_markets_text" class="form-control check_space" required type="text" placeholder="Contact Us Text"></div>
                                </div>


                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Markers</h3>
                                <form action="">
                                    <h5>Markets markers:</h5>
                                    <div class="market_markers">
                                        @foreach($dolchem_markers as $marker)
                                            @if($marker->type=='market')
                                                <div class="row form-group">
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->lat}}" name="lat" class="form-control check_space check_number" type="text" placeholder="Latitude"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->lng}}" name="lng" class="form-control" type="text" placeholder="Longitude"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->title}}" name="title" class="form-control" type="text" placeholder="Title"></div>
                                                    <div class="col-12 col-lg-6 form-group"><input value="{{$marker->content}}" name="content" class="form-control" type="text" placeholder="Content"></div>
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
                            </div>
                        </div>
                    </div>
                    {{--//End Markets--}}

                    {{--//Products Categories--}}
                    <div role="tabpanel" class="tab-pane" id="productscategory">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Products Categories</h3>
                                <div class="row draggablePanelList products_categories_slider_list">
                                    @foreach($dolchem_products_categories as $dolchem_products_categories_slide)
                                        <div data-id="{{$dolchem_products_categories_slide->id}}" class="col-sm-12 col-md-6 col-xl-4 panel products_categories_slide" style="margin-bottom:30px;position: relative">
                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>
                                            <div class="panel-draggable" >
                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image</h3>
                                                <div class="col form-group p-0">
                                                    <input type="file"  name="image" class="dropify" data-height="500" data-default-file="{{$dolchem_products_categories_slide->photo_url}}" />
                                                </div>
                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image Hover</h3>
                                                <div class="col form-group p-0">
                                                    <input type="file"  name="image_hover" class="dropify" data-height="500" data-default-file="{{$dolchem_products_categories_slide->photo_url_hover}}" />
                                                </div>
                                                <textarea id="products_categories_title_{{$dolchem_products_categories_slide->id}}" class="textarea"  cols="30" rows="10">{{$dolchem_products_categories_slide->title}}</textarea>
                                            </div>
                                            <div style="text-align: center;margin-top: 10px;">
                                                <button onclick="delete_products_categories_slide(this)" data-id="{{$dolchem_products_categories_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>
                                                <button onclick="save_products_categories_slide(this)" data-id="{{$dolchem_products_categories_slide->id}}" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col  text-center">
                                        <button type="button" class="btn_page_orange btn_submit" onclick="add_new_products_categories_slide()">Add new category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--//End Products Categories--}}

                    {{--//Products--}}
                    <div role="tabpanel" class="tab-pane" id="products">
                        <div class="card box-shadow">
                            <div class="card-block">
                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Products </h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card prod-list">

                                            <table class="table table-borderless mb-0 dataTable" id="table11">
                                                <thead>
                                                    <tr style="font-family: RalewaySemiBold;">
                                                        <th  class="th-text text-uppercase border-bottom-0">№</th>
                                                        <th  class="th-text text-uppercase text-left border-bottom-0 p-l-5">Product name</th>
                                                        <th  class="th-text text-uppercase border-bottom-0">Cas number</th>
                                                        <th  class="th-text text-uppercase border-bottom-0 text-center pr-4">Category</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    @foreach($dolchem_products as $dolchem_product)
                                                        <tr>
                                                            <td>1</td>
                                                            <td scope="row"  class="text-left p-l-5"><b>{{$dolchem_product->product_name}}</b></td>
                                                            <td scope="row"><b>{{$dolchem_product->product_code}}</b></td>
                                                            <td class="text-center" >
                                                                <select class="form-control select_category_prod{{$dolchem_product->products_id}}" onchange="update_category(this)" data-products-id="{{$dolchem_product->products_id}}">
                                                                    <option value="">Select category</option>
                                                                    @foreach($dolchem_products_categories as $category)
                                                                        <option value="{{$category->id}}"><?php echo $category->title ?></option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--//End Products--}}


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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var token = '{{$token}}';
        $('header').css('z-index','100');

        $('.nav_link_set').on('click',function () {
            localStorage['tab_main'] = $(this).attr('data-href');
            window.location = location;
        });


        $( function() {
            var textarea_id;
            var textarea_id1;
            $(".products_categories_slider_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('.textarea').attr('id');
//                    textarea_id1 = $(parent).find('.textarea1').attr('id');
                    CKEDITOR.instances[textarea_id].destroy();
//                    CKEDITOR.instances[textarea_id1].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
//                    replace_ck(textarea_id1);
                    var pos = '';
                    $('.products_categories_slide').each(function () {
                        var id = $(this).attr('data-id');
                        if(id){
                            pos+=id+',';
                        }
                    });
                    pos = pos.substring(0, pos.length - 1);
                    $.ajax({
                        url:"/api/admin/dolchem_page/products_categories/set_position",
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
            });
        });

        $( function() {
            var textarea_id;
            var textarea_id1;
            $(".download_kit_slider_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('.textarea').attr('id');
//                    textarea_id1 = $(parent).find('.textarea1').attr('id');
                    CKEDITOR.instances[textarea_id].destroy();
//                    CKEDITOR.instances[textarea_id1].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
//                    replace_ck(textarea_id1);
                    var pos = '';
                    $('.download_kit_slide').each(function () {
                        var id = $(this).attr('data-id');
                        if(id){
                            pos+=id+',';
                        }
                    });
                    pos = pos.substring(0, pos.length - 1);
                    $.ajax({
                        url:"/api/admin/dolchem_page/download_kit/set_position",
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
            });
        });


        $( function() {
            var textarea_id;
            var textarea_id1;
            $(".packing_slider_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('.textarea').attr('id');
                    textarea_id1 = $(parent).find('.textarea1').attr('id');
                    CKEDITOR.instances[textarea_id].destroy();
                    CKEDITOR.instances[textarea_id1].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
                    replace_ck(textarea_id1);
                    var pos = '';
                    $('.packing_slide').each(function () {
                        var id = $(this).attr('data-id');
                        if(id){
                            pos+=id+',';
                        }
                    });
                    pos = pos.substring(0, pos.length - 1);
                    $.ajax({
                        url:"/api/admin/dolchem_page/packing/set_position",
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
            });
        });

        $( function() {
            var textarea_id;
            var textarea_id1;
            $(".quality_assurance_slider_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('.textarea').attr('id');
//                    textarea_id1 = $(parent).find('.textarea1').attr('id');
                    CKEDITOR.instances[textarea_id].destroy();
//                    CKEDITOR.instances[textarea_id1].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
//                    replace_ck(textarea_id1);
                    var pos = '';
                    $('.quality_assurance_slide').each(function () {
                        var id = $(this).attr('data-id');
                        if(id){
                            pos+=id+',';
                        }
                    });
                    pos = pos.substring(0, pos.length - 1);
                    $.ajax({
                        url:"/api/admin/dolchem_page/quality_assurance/set_position",
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
            });
        });

        $( function() {
            var textarea_id;
            var textarea_id1;
            $(".certifications_slider_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('.textarea').attr('id');
//                    textarea_id1 = $(parent).find('.textarea1').attr('id');
                    CKEDITOR.instances[textarea_id].destroy();
//                    CKEDITOR.instances[textarea_id1].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
//                    replace_ck(textarea_id1);
                    var pos = '';
                    $('.certifications_slide').each(function () {
                        var id = $(this).attr('data-id');
                        if(id){
                            pos+=id+',';
                        }
                    });
                    pos = pos.substring(0, pos.length - 1);
                    $.ajax({
                        url:"/api/admin/dolchem_page/certifications/set_position",
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
            });
        });

        $( function() {
            var textarea_id;
            var textarea_id1;
            $(".brand_profile_slider_list").sortable({
                revert: true,
                live: true,
                start: function (item,ui) {
                    textarea_id = null;
                    var parent = ui.item;
                    textarea_id = $(parent).find('.textarea').attr('id');
                    textarea_id1 = $(parent).find('.textarea1').attr('id');
                    CKEDITOR.instances[textarea_id].destroy();
                    CKEDITOR.instances[textarea_id1].destroy();
                },
                stop: function (item) {
                    replace_ck(textarea_id);
                    replace_ck(textarea_id1);
                    var pos = '';
                    $('.brand_profile_slide').each(function () {
                        var id = $(this).attr('data-id');
                        if(id){
                            pos+=id+',';
                        }
                    });
                    pos = pos.substring(0, pos.length - 1);
                    $.ajax({
                        url:"/api/admin/dolchem_page/about_brand/set_position",
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
            });
        });


        $( function() {
            var textarea_id;
            $(".main_page_slider_list").sortable({
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
                    var pos = '';
                    $('.main_page_slide').each(function () {
                        var id = $(this).attr('data-id');
                        if(id){
                            pos+=id+',';
                        }
                    });
                    pos = pos.substring(0, pos.length - 1);
                    $.ajax({
                        url:"/api/admin/dolchem_page/main_page/set_position",
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
            });
        });

        $(document).ready(function() {
            $('#table11').DataTable({
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
        } );

        function update_category(select) {
            $.ajax({
                url:"/api/admin/page/dolchem_category/edit",
                type:"POST",
                data:{
                    token:token,
                    products_id:$(select).attr('data-products-id'),
                    cat_id:$(select).val(),
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    sweet_modal('Success','success',1000);
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })
        }
        
        
        function save_descr() {
            save_address();
            save_phone();
            save_phone1();
            save_address1();
            save_email();
            save_linkedin_link();
            save_contact_us_text();
            save_about_markets_text();
            sweet_modal('Success','success',1000);
        }

        function save_about_markets_text() {
            var formData = new FormData();
            formData.append('text',$('input[name="about_markets_text"]').val());
            formData.append('type','about_markets_text');
            formData.append('token',token);
            save_content(formData);
        }

        function save_phone() {
            var formData = new FormData();
            formData.append('text',$('input[name="telephone"]').val());
            formData.append('type','telephone');
            formData.append('token',token);
            save_content(formData);
        }

        function save_phone1() {
            var formData = new FormData();
            formData.append('text',$('input[name="telephone1"]').val());
            formData.append('type','telephone1');
            formData.append('token',token);
            save_content(formData);
        }

        function save_contact_us_text() {
            var formData = new FormData();
            formData.append('text',$('input[name="contact_us_text"]').val());
            formData.append('type','contact_us_text');
            formData.append('token',token);
            save_content(formData);
        }

        function save_brand_text() {
            var formData = new FormData();
            formData.append('text',$('input[name="brand_text"]').val());
            formData.append('type','brand_text');
            formData.append('token',token);
            save_content(formData);
            sweet_modal('Success','success',1000);
        }

        function save_linkedin_link() {
            var formData = new FormData();
            formData.append('text',$('input[name="linkedin_link"]').val());
            formData.append('type','linkedin_link');
            formData.append('token',token);
            save_content(formData);
        }


        function save_email() {
            var formData = new FormData();
            formData.append('text',$('input[name="email"]').val());
            formData.append('type','email');
            formData.append('token',token);
            save_content(formData);
        }

        function save_address1() {
            var formData = new FormData();
            formData.append('text',$('input[name="address1_text"]').val());
            formData.append('text1',$('input[name="address1_text1"]').val());
            formData.append('type','address1');
            formData.append('token',token);
            save_content(formData);
        }

        function save_address() {
            var formData = new FormData();
            formData.append('text',$('input[name="address_text"]').val());
            formData.append('text1',$('input[name="address_text1"]').val());
            formData.append('type','address');
            formData.append('token',token);
            save_content(formData);
        }

        function add_office_marker(block,type) {
            $('.'+block).append('<div class="row form-group">\n' +
                '                                        <div class="col-12 col-lg-6 form-group"><input class="form-control check_space check_number" name="lat" required type="text" placeholder="Latitude"></div>\n' +
                '                                        <div class="col-12 col-lg-6 form-group"><input class="form-control" required type="text" name="lng" placeholder="Longitude"></div>\n' +
                '                                        <div class="col-12 col-lg-6 form-group"><input class="form-control" required type="text" name="title" placeholder="Title"></div>\n' +
                '                                        <div class="col-12 col-lg-6 form-group"><input class="form-control" required type="text" name="content" placeholder="Content"></div>\n' +
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
            if($(parent).find('input[name="lat"]').val()==''){
                sweet_modal('Invalid parameter. Empty latitude', 'error', 3000);
                return false;
            }
            if($(parent).find('input[name="lng"]').val()==''){
                sweet_modal('Invalid parameter. Empty longitude', 'error', 3000);
                return false;
            }
            if($(parent).find('input[name="title"]').val()==''){
                sweet_modal('Invalid parameter. Empty title', 'error', 3000);
                return false;
            }
            $.ajax({
                url:"/api/admin/page/dolchem_marker/edit",
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
                    if(data.success == true) {
                        sweet_modal('Success', 'success', 1000);
                    }else{
                        sweet_modal(data.message, 'error', 3000);
                    }
                    console.log(data);
                },error:function (data) {
                    console.log(data);
                }
            })

        }

        function delete_office_marker(btn) {
            if($(btn).attr('data-marker-id')){
                $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                    $.ajax({
                        url: "/api/admin/page/dolchem_marker/delete",
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


        function save_quality_assurance_content() {
            var formData = new FormData();
            var text = CKEDITOR.instances['quality_assurance_content'].getData();
            formData.append('text',text);
            formData.append('type','quality_assurance_content');
            formData.append('token',token);
            save_content(formData);
            sweet_modal('Success','success',1000);
        }

        function save_content(formData) {
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/dolchem_page/content/edit",
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
//                        sweet_modal('Success','success',1000);
//                        if(data.type=='create'){
//                            setTimeout(function () {
//                                window.location = '/panel/admin/dolchem-content';
//                            },1000);
//                        }
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


        $(document).ready(function () {
            console.log(localStorage['tab_main']);
            if(localStorage['tab_main']==undefined){
                $('.tab_first').addClass('active');
                $('.tab_first').removeClass('fade');
                $('.first_nav').addClass('active');
                main_page_slider_replace_ck
            }else{
                $('div#'+localStorage['tab_main']).removeClass('fade');
                $('div#'+localStorage['tab_main']).addClass('active');
                $('a[href="#'+localStorage['tab_main']+'1"]').addClass('active');

                switch (localStorage['tab_main']){
                    case 'home':
                        main_page_slider_replace_ck();
                    break;

                    case 'about_brand_profile':
                        about_brand_profile_replace_ck();
                    break;

                    case 'certifications':
                        sertifications_replace_ck();
                    break;

                    case 'quality_assurance':
                        quality_assurance_replace_ck();
                        replace_ck('quality_assurance_content');
                    break;

                    case 'packing':
                        packing_replace_ck();
                    break;

                    case 'productscategory':
                        productscategory_replace_ck();
                    break;

                    case 'products':
                        @foreach($dolchem_products as $dolchem_product)
                            $('.select_category_prod{{$dolchem_product->products_id}}').val('{{$dolchem_product->dolchem_products_categories_id}}');
                        @endforeach
                    break;

                    case 'download_kit':
                        download_kit_replace_ck();
                    break;

                    default:
                        main_page_slider_replace_ck();
                    break;
                }
            }
        });

        function productscategory_replace_ck(){
            @foreach($dolchem_products_categories as $dolchem_products_categories_slide)
                replace_ck('products_categories_title_{{$dolchem_products_categories_slide->id}}');
            @endforeach
        }

        function download_kit_replace_ck() {
            @foreach($dolchem_download_kit as $dolchem_download_kit_slide)
                replace_ck('download_kit_title_{{$dolchem_download_kit_slide->id}}');
            @endforeach
        }

        function packing_replace_ck() {
            @foreach($dolchem_packing as $dolchem_packing_slide)
                replace_ck('packing_title_{{$dolchem_packing_slide->id}}');
                replace_ck('packing_descr_{{$dolchem_packing_slide->id}}');
            @endforeach
        }

        function quality_assurance_replace_ck() {
            @foreach($dolchem_quality_assurance as $dolchem_quality_assurance_slide)
                replace_ck('quality_assurance_{{$dolchem_quality_assurance_slide->id}}');
            @endforeach
        }

        function sertifications_replace_ck() {
            @foreach($dolchem_certifications as $dolchem_certifications_slide)
                replace_ck('certifications_{{$dolchem_certifications_slide->id}}');
            @endforeach
        }

        function about_brand_profile_replace_ck() {
            @foreach($dolchem_about_brand_profile as $dolchem_about_brand_slide)
                replace_ck('brand_profile_{{$dolchem_about_brand_slide->id}}');
                replace_ck('brand_profile1_{{$dolchem_about_brand_slide->id}}');
            @endforeach
        }

        function main_page_slider_replace_ck() {
            @foreach($dolchem_main_page_content as $dolchem_main_page_slide)
                replace_ck('main_page_slider_{{$dolchem_main_page_slide->id}}');
                replace_ck('main_page_slider1_{{$dolchem_main_page_slide->id}}');
            @endforeach
        }


        function replace_ck(name) {
            CKEDITOR.replace(name);
        }

        function add_new_products_categories_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.products_categories_slider_list').append('<div data-id="" class="col-sm-12 col-md-6 col-xl-4 panel products_categories_slide" style="margin-bottom:30px;position: relative">\n' +
                '                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>\n' +
                '                                            <div class="panel-draggable" >\n' +
                '                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image</h3>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file"  name="image" class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                '                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image Hover</h3>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file"  name="image_hover" class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                '                                                <textarea id="products_categories_title_'+rnd+'" class="textarea"  cols="30" rows="10"></textarea>\n' +
                '                                            </div>\n' +
                '                                            <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                <button onclick="delete_products_categories_slide(this)" data-id="" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                <button onclick="save_products_categories_slide(this)" data-id="" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                            </div>\n' +
                '                                        </div>');
            $('.dropify').dropify();
            replace_ck('products_categories_title_'+rnd);
        }

        function add_new_download_kit_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.download_kit_slider_list').append('<div data-id="" class="col-sm-12 col-md-6 col-xl-4 panel download_kit_slide" style="margin-bottom:30px;position: relative">\n' +
                '                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>\n' +
                '                                            <div class="panel-draggable" >\n' +
                '                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image</h3>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file"  name="image" class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                '                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image Hover</h3>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file"  name="image_hover" class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                '                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Download File</h5>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file" name="download_kit_file"   data-height="500"" />\n' +
                '                                                </div>\n' +
                '                                                <textarea id="download_kit_title_'+rnd+'" class="textarea"  cols="30" rows="10"></textarea>\n' +
                '                                            </div>\n' +
                '                                            <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                <button onclick="delete_download_kit_slide(this)" data-id="" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                <button onclick="save_download_kit_slide(this)" data-id="" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                            </div>\n' +
                '                                        </div>');
            $('.dropify').dropify();
            replace_ck('download_kit_title_'+rnd);
        }
        function add_new_packing_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.packing_slider_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel packing_slide" style="margin-bottom:30px;position: relative">\n' +
                '                                            <span style="    position: absolute;z-index: 50;color: black;font-size: 30px;left: 25px;text-align: center;cursor: pointer"><i class="fas fa-arrows-alt"></i></span>\n' +
                '                                            <div class="panel-draggable" >\n' +
                '                                                <h3 class="d-flex justify-content-center" style="margin-bottom:15px;">Image</h3>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file"  name="packing_image" class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                '                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Hover Image</h5>\n' +
                '                                                <div class="col form-group p-0">\n' +
                '                                                    <input type="file" name="packing_hover_image"  class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                </div>\n' +
                '                                                <h5 class="d-flex justify-content-center" style="margin-bottom:15px;">Title & Description</h5>\n' +
                '                                                <textarea id="packing_title_'+rnd+'" class="textarea"  cols="30" rows="10"></textarea>\n' +
                '                                                <textarea id="packing_descr_'+rnd+'" class="textarea1"  cols="30" rows="10"></textarea>\n' +
                '                                            </div>\n' +
                '                                            <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                <button onclick="delete_packing_slide(this)" data-id="" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                <button onclick="save_packing_slide(this)" data-id="" type="button" class="btn_page btn_submit" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                            </div>\n' +
                '                                        </div>');
            $('.dropify').dropify();
            replace_ck('packing_title_'+rnd);
            replace_ck('packing_descr_'+rnd);
        }

        function add_new_quality_assurance_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.quality_assurance_slider_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel quality_assurance_slide" style="margin-bottom:30px;">\n' +
                '                                                <div class="panel-draggable" >\n' +
                '                                                    <div class="col form-group p-0">\n' +
                '                                                        <input type="file"   class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                    </div>\n' +
                '                                                    <textarea class="textarea" id="quality_assurance_'+rnd+'"  cols="30" rows="10"></textarea><br>\n' +
                '                                                </div>\n' +
                '                                                <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                    <button onclick="delete_quality_assurance_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                    <button onclick="save_quality_assurance_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                                </div>\n' +
                '                                            </div>');
            $('.dropify').dropify();
            replace_ck('quality_assurance_'+rnd);
        }

        function add_new_certifications_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.certifications_slider_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel certifications_slide" style="margin-bottom:30px;">\n' +
                '                                                <div class="panel-draggable" >\n' +
                '                                                    <div class="col form-group p-0">\n' +
                '                                                        <input type="file"   class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                    </div>\n' +
                '                                                    <textarea class="textarea" id="certifications_'+rnd+'"  cols="30" rows="10"></textarea><br>\n' +
                '                                                </div>\n' +
                '                                                <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                    <button onclick="delete_certifications_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                    <button onclick="save_certifications_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                                </div>\n' +
                '                                            </div>');
            $('.dropify').dropify();
            replace_ck('certifications_'+rnd);
        }

        function add_new_about_brand_profile_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.brand_profile_slider_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel brand_profile_slide" style="margin-bottom:30px;">\n' +
                '                                                <div class="panel-draggable" >\n' +
                '                                                    <div class="col form-group p-0">\n' +
                '                                                        <input type="file"   class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                    </div>\n' +
                '                                                    <textarea class="textarea" id="about_brand_profile_slider_'+rnd+'"  cols="30" rows="10"></textarea><br>\n' +
                '                                                    <textarea class="textarea1" id="about_brand_profile_slider1_'+rnd+'"  cols="30" rows="10"></textarea>\n' +
                '                                                </div>\n' +
                '                                                <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                    <button onclick="delete_about_brand_profile_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                    <button onclick="save_about_brand_profile_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                                </div>\n' +
                '                                            </div>');
            $('.dropify').dropify();
            replace_ck('about_brand_profile_slider_'+rnd);
            replace_ck('about_brand_profile_slider1_'+rnd);
        }

        function add_new_main_page_slide() {
            var rnd = Math.floor(Math.random() * 1000000) + 1;
            $('.main_page_slider_list').append('<div class="col-sm-12 col-md-6 col-xl-4 panel main_page_slide" style="margin-bottom:30px;">\n' +
                '                                                <div class="panel-draggable" >\n' +
                '                                                    <div class="col form-group p-0">\n' +
                '                                                        <input type="file" accept="image/png, image/jpeg"  class="dropify" data-height="500" data-default-file="" />\n' +
                '                                                    </div>\n' +
                '                                                    <textarea class="textarea" id="main_page_slider_'+rnd+'"  cols="30" rows="10"></textarea><br>\n' +
                '                                                    <textarea class="textarea1" id="main_page_slider1_'+rnd+'"  cols="30" rows="10"></textarea>\n' +
                '                                                </div>\n' +
                '                                                <div style="text-align: center;margin-top: 10px;">\n' +
                '                                                    <button onclick="delete_main_page_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px;background-color: #ff0000;border-bottom: 0.2em solid #e00000;">Delete</button>\n' +
                '                                                    <button onclick="save_main_page_slide(this)" type="button" class="btn_page" style="width:10.3125rem;margin: 2px">Save</button>\n' +
                '                                                </div>\n' +
                '                                            </div>');
            $('.dropify').dropify();
            replace_ck('main_page_slider_'+rnd);
            replace_ck('main_page_slider1_'+rnd);
        }
        
        function save_products_categories_slide(btn) {
            var formData = new FormData();
            var slide_id = $(btn).attr('data-id');
            var parent = $(btn).parent().parent();
            var title_id = $(parent).find('textarea.textarea').attr('id');
            var input_file = $(parent).find('input[name="image"]')[0];
            var input_file2 = $(parent).find('input[name="image_hover"]')[0];
            var file='';
            var file1='';
            var title = CKEDITOR.instances[title_id].getData();
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            if (input_file2.files && input_file2.files[0]) {
                file1 = input_file2.files[0];
            }
            formData.append('title',title);
            formData.append('file',file);
            formData.append('file1',file1);
            formData.append('token',token);
            if(slide_id) {
                formData.append('slide_id', slide_id);
            }


            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/dolchem_page/products_categories/edit",
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
                        if(data.type=='create'){
                            setTimeout(function () {
                                window.location = '/panel/admin/dolchem-content';
                            },1000);
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

        function save_download_kit_slide(btn) {
            var formData = new FormData();
            var slide_id = $(btn).attr('data-id');
            var parent = $(btn).parent().parent();
            var title_id = $(parent).find('textarea.textarea').attr('id');
            var input_file = $(parent).find('input[name="image"]')[0];
            var input_file2 = $(parent).find('input[name="image_hover"]')[0];
            var input_file1 = $(parent).find('input[name="download_kit_file"]')[0];
            var file='';
            var file1='';
            var link='';
            var title = CKEDITOR.instances[title_id].getData();
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            if (input_file2.files && input_file2.files[0]) {
                file1 = input_file2.files[0];
            }
            if (input_file1.files && input_file1.files[0]) {
                link = input_file1.files[0];
            }
            formData.append('title',title);
            formData.append('file',file);
            formData.append('file1',file1);
            formData.append('link',link);
            formData.append('token',token);
            if(slide_id) {
                formData.append('slide_id', slide_id);
            }


            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/dolchem_page/download_kit/edit",
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
                        if(data.type=='create'){
                            setTimeout(function () {
                                window.location = '/panel/admin/dolchem-content';
                            },1000);
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

        function save_packing_slide(btn) {
            var formData = new FormData();
            var slide_id = $(btn).attr('data-id');
            var parent = $(btn).parent().parent();
            var title_id = $(parent).find('textarea.textarea').attr('id');
            var descr_id = $(parent).find('textarea.textarea1').attr('id');
            var input_file = $(parent).find('input[name="packing_image"]')[0];
            var input_file1 = $(parent).find('input[name="packing_hover_image"]')[0];
            var file='';
            var file1='';
            var title = CKEDITOR.instances[title_id].getData();
            var descr = CKEDITOR.instances[descr_id].getData();
            console.log(descr);
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
            formData.append('token',token);
            if(slide_id) {
                formData.append('slide_id', slide_id);
            }


            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/dolchem_page/packing/edit",
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
                        if(data.type=='create'){
                            setTimeout(function () {
                                window.location = '/panel/admin/dolchem-content';
                            },1000);
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

        function save_quality_assurance_slide(btn) {
            var formData = new FormData();
            var slide_id = $(btn).attr('data-id');
            var parent = $(btn).parent().parent();
            var title_id = $(parent).find('textarea.textarea').attr('id');
            var input_file = $(parent).find('input[type="file"]')[0];
            var file='';
            var title = CKEDITOR.instances[title_id].getData();
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            console.log(file);
            formData.append('title',title);
            formData.append('file',file);
            formData.append('token',token);
            if(slide_id) {
                formData.append('slide_id', slide_id);
            }


            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/dolchem_page/quality_assurance/edit",
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
                        if(data.type=='create'){
                            setTimeout(function () {
                                window.location = '/panel/admin/dolchem-content';
                            },1000);
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


        function save_certifications_slide(btn) {
            var formData = new FormData();
            var slide_id = $(btn).attr('data-id');
            var parent = $(btn).parent().parent();
            var title_id = $(parent).find('textarea.textarea').attr('id');
            var input_file = $(parent).find('input[type="file"]')[0];
            var file='';
            var title = CKEDITOR.instances[title_id].getData();
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            console.log(file);
            formData.append('title',title);
            formData.append('file',file);
            formData.append('token',token);
            if(slide_id) {
                formData.append('slide_id', slide_id);
            }


            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/dolchem_page/certifications/edit",
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
                        if(data.type=='create'){
                            setTimeout(function () {
                                window.location = '/panel/admin/dolchem-content';
                            },1000);
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

        function save_about_brand_profile_slide(btn) {
            var formData = new FormData();
            var slide_id = $(btn).attr('data-id');
            var parent = $(btn).parent().parent();
            var title_id = $(parent).find('textarea.textarea').attr('id');
            var title1_id = $(parent).find('textarea.textarea1').attr('id');
            var input_file = $(parent).find('input[type="file"]')[0];
            var file='';
            var title = CKEDITOR.instances[title_id].getData();
            var title1 = CKEDITOR.instances[title1_id].getData();
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            console.log(file);
            formData.append('title',title);
            formData.append('title1',title1);
            formData.append('file',file);
            formData.append('token',token);
            if(slide_id) {
                formData.append('slide_id', slide_id);
            }


            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/dolchem_page/about_brand/edit",
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
                        if(data.type=='create'){
                            setTimeout(function () {
                                window.location = '/panel/admin/dolchem-content';
                            },1000);
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

        function save_main_page_slide(btn) {
            var formData = new FormData();
            var slide_id = $(btn).attr('data-id');
            var parent = $(btn).parent().parent();
            var title_id = $(parent).find('textarea.textarea').attr('id');
            var title1_id = $(parent).find('textarea.textarea1').attr('id');
            var input_file = $(parent).find('input[type="file"]')[0];
            var file='';
            var title = CKEDITOR.instances[title_id].getData();
            var title1 = CKEDITOR.instances[title1_id].getData();
            if (input_file.files && input_file.files[0]) {
                file = input_file.files[0];
            }
            console.log(file);
            formData.append('title',title);
            formData.append('title1',title1);
            formData.append('file',file);
            formData.append('token',token);
            if(slide_id) {
                formData.append('slide_id', slide_id);
            }


            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/dolchem_page/main_page/edit",
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
                        if(data.type=='create'){
                            setTimeout(function () {
                                window.location = '/panel/admin/dolchem-content';
                            },1000);
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

        function delete_products_categories_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var slide_id = $(btn).attr('data-id');
                if (slide_id) {
                    $.ajax({
                        url: "/api/admin/dolchem_page/products_categories/delete",
                        type: "POST",
                        data: {slide_id: slide_id, token: token},
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
            });
        }


        function delete_packing_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var slide_id = $(btn).attr('data-id');
                if (slide_id) {
                    $.ajax({
                        url: "/api/admin/dolchem_page/packing/delete",
                        type: "POST",
                        data: {slide_id: slide_id, token: token},
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
            });
        }

        function delete_quality_assurance_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var slide_id = $(btn).attr('data-id');
                if (slide_id) {
                    $.ajax({
                        url: "/api/admin/dolchem_page/quality_assurance/delete",
                        type: "POST",
                        data: {slide_id: slide_id, token: token},
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
            });
        }


        function delete_certifications_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var slide_id = $(btn).attr('data-id');
                if (slide_id) {
                    $.ajax({
                        url: "/api/admin/dolchem_page/certifications/delete",
                        type: "POST",
                        data: {slide_id: slide_id, token: token},
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
            });
        }

        function delete_download_kit_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var slide_id = $(btn).attr('data-id');
                if (slide_id) {
                    $.ajax({
                        url: "/api/admin/dolchem_page/download_kit/delete",
                        type: "POST",
                        data: {slide_id: slide_id, token: token},
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
            });
        }

        function delete_main_page_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var slide_id = $(btn).attr('data-id');
                if (slide_id) {
                    $.ajax({
                        url: "/api/admin/dolchem_page/main_page/delete",
                        type: "POST",
                        data: {slide_id: slide_id, token: token},
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
            });
        }

        function delete_about_brand_profile_slide(btn) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                var parent = $(btn).parent().parent();
                var slide_id = $(btn).attr('data-id');
                if (slide_id) {
                    $.ajax({
                        url: "/api/admin/dolchem_page/about_brand/delete",
                        type: "POST",
                        data: {slide_id: slide_id, token: token},
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
            });
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
    </script>
@endsection