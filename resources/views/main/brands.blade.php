@extends('layout.main')
@section('head')
    @include('template.head_template')
    <style>
        @foreach($slider as $key=>$slide)
        h1 { margin: 150px auto 30px auto; }
        /*body { font-family: Arial; font-size: 12px; background: #ededed; }*/

        .ktrv {
            margin: 0 auto;
            width: 100%;
            /*        border: 1px solid #222;*/
            height: 500px;
            position: relative;
            clear: both;
            overflow: hidden;
            background: #f5f5f5!important;
        }
        .noselect {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin-bottom: 0rem;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            color: #fff;
            /*background-color: #3e5c8f;*/
            padding: 1rem 0;
        }

        /*        .wwkt img {
              display: inline-block;
              width: 100%;
              height: 100%;
              opacity: 0;

            }*/

        .ktrv>div.wwkt>div:nth-child(2) {
            position: absolute;
            top: 0;
            width: 100%;
            height: inherit;
            /*display: table;*/
            background-color: #fff;
            border-radius: 5px;
        }
        .ktrv>div.wwkt>div:last-child {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            display: table;
        }
        .ktrv > div.wwkt > div:first-child {

            display: table-cell;
            vertical-align: middle;
            height: 100%;
            width: 100%;

        }
        .text a {
            text-decoration: none;
            color:#8e8e8e;
        }

        p.noselect{{$key}} {

            /*        display: table-cell;
                    vertical-align: middle;
                    height: inherit;*/
            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 0px;
            margin: 0px;
        }


        #callback-output {
            height: 250px;
            overflow: scroll;
        }

        .p--4{
            padding: 4rem 0;
        }
        .slide-img{
            /*        top: 30%;
                position: relative;
            */
            margin-bottom: 2rem;
        }

        .ktrv>div.wwkt {
            display: inline-block;
            cursor: pointer;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09),inset 0px -80px 0px 0px rgba(62, 92, 143, 0.004);
        }


        img{
            display: block!important;
        }
        img.bg-white{
            padding: 85px 0px!important;//

        }
        .address img{
            display: inherit!important;
        }
        .text{
            height:55px; padding-top:14px;color:#8e8e8e;; background-color:#ededed;
        }
        .active_text p{
            color:#fff;
            background-color:#3e5c8f;
        }
        .active_text a {
            color:white;
        }
        .active_text_1 {
            color:#fff;
            background-color:#3e5c8f;
        }

        .inactive_text p{
            color:#8e8e8e;
            background-color:#ededed;
        }
        .carousel-indicators li{
            background-color: rgba(216, 213, 213, 0.5)!important;
        }
        .carousel-indicators li.active{

            background-color: #cecaca!important;
        }
        @endforeach
    </style>
@endsection
@section('content')
    <div class="main-content">
        @include('main.header')
        <div class="row mr-t-b">
            <div class="container text-center">
                <h2 style="font-family: RalewayBold;color:#253756;">OUR BRANDS</h2>
                <p style="font-family: RalewayRegular;font-size: 1.1rem;color:#253756;"><?php echo $brand_descr->text; ?></p>
            </div>
        </div>
        <div class="row mr-t-b">
            <div id="ktrv" class="text-center ktrv m-auto" style="height: 45vh!important;">
                @foreach($slider as $key=>$slide)
                    @if($key==0)
                            <div class="wwkt itemsrc text-center" id="wwcp-1">
<div></div>
                                <div class="d-flex align-items-center" >
                                    <img  class="img-fluid slide-img" src="{{$slide->src}}"   />
                                    <p class="text  noselect{{$key}}">
                                    </p>
                                </div>
{{--<div></div>--}}
                            </div>

                    @else
                            <div class="wwkt itemsrc text-center" id="wwcp-1">
                            <div>
                            </div>
                                <div class="d-flex align-items-center" >
                                    <img  class="img-fluid slide-img" src="{{$slide->src}}" />
                                    <p   class="text  noselect{{$key}}">

                                    </p>
                                </div>
                            </div>
                        <div>
                        </div>
                    @endif
                @endforeach

            </div>
            <div style="display:none; margin: 0 auto;" id="carouselbrandsmall" class="carousel slide" data-ride="carousel">
                <ol style="bottom:-15px;" class="carousel-indicators">
                    @foreach($slider as $key=>$slide)
                        @if($key==0)
                            <li data-target="#carouselbrandsmall" data-slide-to="{{$key}}" class="active"></li>
                        @else
                            <li data-target="#carouselbrandsmall" data-slide-to="{{$key}}"></li>
                        @endif
                    @endforeach
                </ol>
                <div class="carousel-inner" role="listbox">
                    @foreach($slider as $key=>$slide)
                        @if($key==0)
                            <div class="carousel-item active">
                                <img class="d-block img-mobile img-fluid bg-white" src="{{$slide->src}}" alt="{{$key}}">
                                <p class="text active_text_1 noselect"><?php echo strip_tags($slide->title); ?></p>
                            </div>
                        @else

                            <div class="carousel-item">
                                <img class="d-block img-mobile img-fluid bg-white" src="{{$slide->src}}" alt="{{$key}}">
                                <p  class="text active_text_1 noselect"><?php echo strip_tags($slide->title); ?></p>
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselbrandsmall" role="button" data-slide="prev">
                    <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselbrandsmall" role="button" data-slide="next">
                    <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <a href="" class="redirect_link" target="_blank" style="d-none"></a>
@endsection
@section('script')
    @include('template.script_template')
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    {{--<script src="/public/js/jquery.waterwheelCarousel.js"></script>--}}
            <script src="/public/js/jquery.waterwheelCarouselnew.js"></script>
    <script>
        @foreach($slider as $key=>$slide)
            $( ".noselect{{$key}}" ).append('<?php echo $slide->title;?>');
        @endforeach
        $( ".text a" ).click(function() {
            var a = document.createElement("a");
            a.click();
            a.removeAttr();
        });
    </script>

@endsection
