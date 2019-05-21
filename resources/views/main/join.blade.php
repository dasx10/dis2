@extends('layout.main')
@section('head')
    @include('template.head_template')
    <style>
        @foreach($slider as $key=>$slide)
        .salad-new-2{{$key}}{
            background: url('{{$slide->src}}')!important;
            background-repeat: no-repeat!important;
            background-position: center!important;;
            /*height: 85px;*/
            /*background-size: 50px!important;;*/
        }
        /*.hexagon:hover .salad-new-2{*/
            /*background: url('/public/img/food-hover1.svg')!important;*/
            /*background-repeat: no-repeat!important;*/
            /*background-position: center!important;*/
            /*height: 60px;*/
            /*!* background-size: 50px!important;;*!*/
        /*}*/
        .box-shadow-5-text:hover .salad-new-2{{$key}}{
            background: url('{{$slide->src_hover}}')!important;
            background-repeat: no-repeat!important;
            background-position: center!important;
            /*height: 85px;*/
        }
        @endforeach
    </style>
@endsection
@section('content')
    @include('main.header')
    <section class="main-content d-flex align-content-center flex-wrap">
       <div class="container w-100 d-flex align-content-center flex-wrap">
            <div class="row w-100 text-center p-t-b  ">
                    <div class="col-md-12 text-center">
                        <h2 style="font-family: RalewayBold;color:#253756;">JOIN US</h2>
                        <div style="font-family: RalewayRegular!important;font-size: 1.1rem!important;color:#253756!important;"><?php
                                echo $join_descr->text;
                        ?></div>
                    </div>
                @foreach($slider as $key=>$slide)
                    <?php
                        $text = strip_tags($slide->descr);
                        $email_arr = ['Email','email'];
                        foreach ($email_arr as $item) {
                            if(strripos($text,$item)){
                                $text = str_replace($item,'<a href="mailto:info@dis-company.com">'.$item.'</a>',$text);
                            }
                        }
                    ?>
                        <div class=" mb-5 col-lg-4 ">
                            <div class="card-body box-shadow-5-text pt-0 ">
                                <div class="box-shadow-white-2 d-flex">
                                    <div class="img salad-new-2 salad-new-2{{$key}}"></div>
                                    {{--<img style="margin:0 auto;" class="align-items-center" src="img/cardboard.svg" alt="">--}}

                                </div>
                                <p style="font-family: RalewayMedium;color:#253756;cursor: pointer;" class="ind{{$key}} mt-3 text-uppercase"></p>
                            </div>
                        </div>
                @endforeach

        </div>
    </section>
@endsection
@section('script')
    @include('template.script_template')
    <script>

                @foreach($slider as $key=>$slide)
                        {{--var descr = "{{str_replace(["\r\n","\n"],'',strip_tags($slide->descr))}}";--}}
                var descr = '<?php echo str_replace(["\r\n","\n",'&nbsp;'],'',$slide->descr);?>';
                $('.ind{{$key}}').append('<?php echo $slide->title;?>');
        $('.ind{{$key}}').webuiPopover({placement:'bottom',trigger: "hover",content:'<div class=""><p>'+descr+'</p><div class="text-center"><a style="max-width: 150px; margin:0 auto; width: 100%;" href="/join-popup?join-type={{$key+1}}" class="align-items-end btn btn-view text-white">Join Us</a></div></div>'});
        @endforeach
    </script>
@endsection
