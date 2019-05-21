@extends('layout.main')
@section('head')
    @include('template.head_template')
    <style>
        @foreach($industries->contents as $key=>$slide)
        .salad{{$key}}{
            background: url('{{$slide->src}}')!important;
            background-repeat: no-repeat!important;
            background-position: center!important;;
            /*height:85px;*/
            /*background-size: 50px!important;;*/
        }
        .box-shadow-1-text:hover .salad{{$key}}{
            background: url('{{$slide->src_hover}}')!important;
            background-repeat: no-repeat!important;
            background-position: center!important;
            /*height: 85px;*/
            /* background-size: 50px!important;;*/
        }
        @endforeach
    </style>
@endsection
@section('content')
    @include('main.header')
    <section class="main-content d-flex align-content-center flex-wrap">
       <div class="container d-flex align-content-center flex-wrap">
            <div class="row w-100 text-center mr-t-b">
                <div class="col-md-12 ">
                    <img class="width-img" class="img-fluid" src="{{$industries->descr_photo_url}}" alt="">
                    <div style="font-family: RalewayRegular!important;font-size: 1.1rem!important;color:#253756!important;">
                    <?php echo $industries->descr; ?>
                    </div>
                    {{--<h2 style="font-family: RalewayBold;color:#253756;" class="mr-t-b-sm">FOOD PROGRESSING INDUSTRY</h2>--}}
                    {{--<p style="font-family: RalewayRegular;font-size: 1.1rem;color:#253756;">We serve our customers with reliable products, combined with our experience <br>--}}
                    {{--to create practical solutions throughout many sectors of industry.</p>--}}
                </div>
                @foreach($industries->contents as $key=>$slide)
                    <div class="col-md col-sm-12 col-lg mt-5">
                        <div class="card-body pt-0 cursor-p box-shadow-1-text">
                        <div class="box-shadow-1 d-flex">
                            <div class="img salad salad{{$key}}"></div>
                        </div>
                        {{--<div class="hexagon">--}}
                            {{--<div class="img salad-new salad{{$key}}"></div>--}}
                        {{--</div>--}}
                            <div class="text-uppercase ind{{$key}}">

                        <p style="font-family: RalewayMedium;color:#253756;cursor: pointer;" class="cursor-p mt-3  text-uppercase"><?php echo $slide->title?></p>
                            </div>
                    </div>
                    </div>
                @endforeach
                {{--<div class="col-lg-3 text-center">--}}
                    {{--<div class="hexagon">--}}
                        {{--<div class="img salad-new"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

        </div>
        </div>
    </section>

@endsection
@section('script')
    @include('template.script_template')

    <script>
        @foreach($industries->contents as $key=>$slide)

                var descr = '<?php echo str_replace(["\r\n","\n",'&nbsp;'],'',$slide->descr);?>';

            $('.ind{{$key}}').webuiPopover({placement:'bottom',trigger: "hover",content:'<div class=""><div class="text-center"><img class="img-fluid" src="{{$slide->src1}}" alt=""></div> <p>'+descr+'</p><div class="text-center"><button data-link="{{$slide->link}}" onclick="redirect(this)" class="btn btn-primary btn-view">Visit website</button></div></div>'});
        @endforeach

        function redirect(btn) {
            var linking = $(btn).attr('data-link');
            window.open(linking, '_blank');
        }
        //создаем JQuery функцию, которая будет подгружать изображения в буфер
        jQuery.preloadImages = function()
        {
            for(var i = 0; i < arguments.length; i++)
            {
                jQuery("<img>").attr("src", arguments[ i ]);
            }
        };

        //указываем путь к изображению, которое нужно подгрузить
        $.preloadImages("{{$slide->src1}}");
    </script>
@endsection
