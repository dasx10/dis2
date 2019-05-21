@extends('layout.main')
@section('head')
    @include('template.head_template')
    <style>
        @foreach($slider as $key=>$slide)
        {{--.cardboard{{$key}}{--}}
            {{--background: url('{{$slide->src}}');--}}
            {{--background-repeat: no-repeat!important;--}}
            {{--background-position: center!important;;--}}
            {{--background-size: 46% 50%;--}}
        {{--}--}}

        {{--.box-shadow-5-text:hover .cardboard{{$key}}{--}}
            {{--background: url('{{$slide->src_hover}}');--}}
            {{--background-repeat: no-repeat!important;--}}
            {{--background-position: center!important;;--}}
            {{--background-size: 46% 50%;--}}
        {{--}--}}
        {{--.salad-new-2{{$key}}{--}}
            {{--background: url('{{$slide->src}}')!important;--}}
            {{--background-repeat: no-repeat!important;--}}
            {{--background-position: center!important;;--}}
            {{--height:85px;--}}
            {{--/*background-size: 50px!important;;*/--}}
        {{--}--}}
        {{--.hov:hover .hexagon .salad-new-2{{$key}}{--}}
            {{--background: url('{{$slide->src_hover}}')!important;--}}
            {{--background-repeat: no-repeat!important;--}}
            {{--background-position: center!important;--}}
            {{--height: 85px;--}}
            {{--/* background-size: 50px!important;;*/--}}
        {{--}--}}
        .cardboard{{$key}}{
            background: url('{{$slide->src}}')!important;
            background-repeat: no-repeat!important;
            background-position: center!important;;
            /*background-size: 50px!important;;*/
        }
        .box-shadow-5-text:hover .cardboard{{$key}}{
            background: url('{{$slide->src_hover}}')!important;
            background-repeat: no-repeat!important;
            background-position: center!important;
        }
        @endforeach
    </style>
@endsection
@section('content')
    @include('main.header')
    <section class="main-content d-flex align-content-center flex-wrap">
        <div class="container d-flex align-content-center flex-wrap">
            <div class="row w-100 text-center p-t-b">
                <div class="col-12 text-center">
                    <h2 style="font-family: RalewayBold;color:#253756;" class="mr-t-b-sm">TAILOR MADE SOLUTIONS</h2>
                    <p style="font-family: RalewayRegular!important;font-size: 1.1rem!important;color:#253756!important;"><?php echo $tailor_descr->text; ?></p>
                </div>
                @foreach($slider as $key=>$slide)
                <div class="mb-5 col-lg-3">
                    <div class="card-body box-shadow-5-text pt-0 ">
                        <div class="box-shadow-white-2 d-flex">
                            <div class="img cardboard cardboard{{$key}}"></div>
                               {{--<img style="margin:0 auto;" class="align-items-center" src="img/cardboard.svg" alt="">--}}
                        </div>
                        <p style="font-family: RalewayMedium;color:#253756;cursor: pointer;" class="cursor-p mt-3  ind{{$key}} text-uppercase"></p>

                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection

@section('script')
    @include('template.script_template')
    <script>
         // alert(1);

                @foreach($slider as $key=>$slide)



                var descr = '<?php echo str_replace(["\r\n","\n",'&nbsp;'],'',$slide->descr);?>';

         $('.ind{{$key}}').append('<?php echo $slide->title; ?>');
        $('.ind{{$key}}').webuiPopover({placement:'bottom',trigger: "hover",content:'<div class=""><p>'+descr+'</p></div>'});
        @endforeach
        {{--$(".cardboard+{{$key}}+").hover(function(){--}}
            {{--$(".box-shadow-5-text ").css({'border-radius':'10px','background-color':'rgb(255, 255, 255)','box-shadow':'0px 3px 7px 0px rgba(0, 0, 0, 0.35)'});--}}
        {{--});--}}
        // $(".consolidation").click(function(e) {
        //     e.preventDefault();
        //     $(".consolidation").removeClass('active');
        //     $(this).addClass('active');
        // })
    </script>
@endsection
