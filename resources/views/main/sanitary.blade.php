@extends('layout.main')
@section('head')
    @include('template.head_template')
@endsection
@section('content')
    <section class="main-content">
        @include('main.header')
        <div class="container">
            <div class="row text-center mr-t-b">
                <div class="col-md-12 ">
                    <img class="width-img" src="{{$ind_descr->src}}" alt="">
                    <h2 style="font-family: RalewayBold!important;color:#253756!important;" class="mr-t-b-sm">
                        <?php echo  $ind_descr->text; ?>
                    </h2>
                </div>

            </div>
            <div class="row justify-content-center text-center">
                @foreach($slider as $key=>$slide)
                    <div class="col-md-4 col mt-5 mb-10">
                        <img class="width-img" src="{{$slide->src}}" alt="">
                        <p class="cursor-p titles{{$key}} text-uppercase"><?php
                            echo strip_tags($slide->title);
                            ?></p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
@section('script')
    @include('template.script_template')
    <script>
                @foreach($slider as $key=>$slide)
            <?php
            $descr =  strip_tags($slide->descr);

            ?>
        var descr = "{{$descr}}";

        $('.titles{{$key}}').webuiPopover({placement:'bottom',trigger: "hover",content:'<div class="text-center"><img class="img-fluid" src="{{$slide->src1}}" alt=""> <p>'+descr+'</p><a target="_blank" data-link="{{$slide->link}}" onclick="redirect(this)" class="btn btn-primary btn-view">Visit website</a></div>'});
        @endforeach

        function redirect(btn) {
            window.open = $(btn).attr('data-link');
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