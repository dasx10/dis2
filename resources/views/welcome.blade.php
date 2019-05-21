@extends('layout.main')
@section('head')
    @include('template.head_template')
    <style>
        .main-content{
            height: 70%;
        }
    </style>
@endsection
@section('content')
    @include('main.header')
    <div class="main-content" style="background: #4c6897!important;">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="">
            <ol class="carousel-indicators">
                <?php $i=1; ?>
                @foreach($main_slider as $key=>$value)
                    @if($key==0)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
                    @else
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                    @endif
                    <?php $i++; ?>
                @endforeach
            </ol>


            <div class="carousel-inner">
                @foreach($main_slider as $key=>$value)
                    <?php $i==1; ?>
                    @if($key==0)
                        <div class="carousel-item active">
                            <img class="d-block img-width h-100 w-100" src="{{$value->src}}" alt="First slide">
                            <div class="carousel-caption d-none d-md-block" id="slide-info-{{$i}}">
                            <h1 class="text-uppercase"><?php echo $value->title;?></h1>
                            </div>
                        </div>
                    @else
                        <div class="carousel-item">
                            <img class="d-block img-width h-100 w-100" src="{{$value->src}}" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block" id="slide-info-{{$i}}">
                                <h1 class="text-uppercase" ><?php echo $value->title;?></h1>
                            </div>
                        </div>
                    @endif
                    <?php $i++; ?>
                @endforeach

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span style="position: relative;left: -26.5%;" class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span style="position: relative;right: -26.5%;" class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@endsection
@section('script')
    @include('template.script_template')
@endsection
