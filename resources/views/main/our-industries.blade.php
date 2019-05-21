@extends('layout.main')
@section('head')
    @include('template.head_template')
    <style>
        @foreach($industries as  $key=>$industr)
            .salad{{$key}}{
                background: url('{{$industr->photo_url}}')!important;
                background-repeat: no-repeat!important;
                background-position: center!important;;
                /*background-size: 50px!important;;*/
            }
            .box-shadow-1-text:hover .salad{{$key}}{
                background: url('{{$industr->photo_url_hover}}')!important;
                background-repeat: no-repeat!important;
                background-position: center!important;;
                /* background-size: 50px!important;;*/
            }

        {{--.salad{{$key}}{--}}
            {{--background: url('{{$industr->photo_url}}')!important;--}}
            {{--background-repeat: no-repeat!important;--}}
            {{--background-position: center!important;;--}}
            {{--height:85px;--}}
            {{--/*background-size: 50px!important;;*/--}}
        {{--}--}}
        {{--.hov:hover .hexagon .salad{{$key}}{--}}
            {{--background: url('{{$industr->photo_url_hover}}')!important;--}}
            {{--background-repeat: no-repeat!important;--}}
            {{--background-position: center!important;--}}
            {{--height: 85px;--}}
            {{--/* background-size: 50px!important;;*/--}}
        {{--}--}}
        @endforeach
    </style>
@endsection
@section('content')
    @include('main.header')
    <section class="main-content d-flex align-content-center flex-wrap">
        <div class="container d-flex align-content-center flex-wrap">

            <div class="row text-center p-t-b ">
                <div class="col-md-12 text-center">
                    <div  style="font-family: RalewayRegular!important;font-size: 1.1rem!important;color:#253756!important;">
                        <?php echo $ind_descr->text; ?>
                    </div>
                </div>
                @foreach($industries as  $key=>$industr)
                    <div class="col-lg-3 text-center">
                        <div onclick="redirect(this)" data-link="/industries/{{$industr->link}}" class="card-body pt-0 cursor-p box-shadow-1-text">
                            {{--<div class="hexagon">--}}
                                {{--<div class="img salad-new salad{{$key}}"></div>--}}
                            {{--</div>--}}
                            <div class="box-shadow-1 d-flex">
                                <div class="img salad salad{{$key}}"></div>
                            </div>
                            <p class="head text-uppercase"><?php echo $industr->title; ?></p>
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
        function redirect(img) {
            window.location = $(img).attr('data-link');
        }
    </script>
@endsection
