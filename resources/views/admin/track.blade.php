@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
    <style>
        #t-order{
            border-bottom: 2px solid #fff;
        }
        .btn_search{
            color: #fff!important;
            background-color: #4c6897!important;
            border-color: #4c6897!important;
            border-bottom: 2px solid #435b85!important;
            margin-top: 6px;
        }
    </style>
@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
        @include('admin.sidebar')
        <main class="main">
            <div class="main_container_fluid">
                <div class="row">
                    {{--<div class="col-12" style="font-family: RalewayMedium;display: inline-block">--}}
                    {{--<!--Поле ввода номера отслеживания.-->--}}
                    {{--<input type="text" class="form-control m-b-10" id="YQNum" maxlength="50"/>--}}
                    {{--<!--Эта кнопка используется для вызова метода скрипта.-->--}}
                    {{--<input type="button" class="btn btn-primary" value="TRACK" onclick="doTrack()"/>--}}
                    {{--<!--Контейнер для показа результата отслеживания.-->--}}
                    {{--<div id="YQContainer"></div>--}}
                    {{--</div>--}}
                    <div class="col-12" style="font-family: RalewayMedium;display: inline-block">
                        <div class="row" style="padding-bottom: 1rem;">
                            <div class="col-md-6">
                                <input type="text" id="YQNum" class="form-control m-b-10" style="padding: 0.375rem 0.75rem!important;" placeholder="Insert DIS ref. to track your shipment">
                            </div>
                            <div class="col-md-6">
                                <input type="button" class="btn btn-primary btn_search" value="Track Shipment" onclick="doTrack()"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="width: 100%" id="YQContainer"></div>
                            </div>
                        </div>
                    </div>

                    {{--<div class="col-12" style="font-family: RalewayMedium;">--}}
                    {{--<form>--}}
                    {{--<div class="row" style="padding-bottom: 1rem;">--}}
                    {{--<div class="col-md-6">--}}
                    {{--<input type="text" class="form-control m-b-10" style="padding: 0.375rem 0.75rem!important;" placeholder="Insert DIS ref. to track your shipment">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                    {{--<button class="btn btn-primary">Track Shipment</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                    {{--<div class="card">--}}
                    {{--<div class="card-header text-center">--}}
                    {{--<p class="m-0">Tracking Order #1234567</p>--}}
                    {{--</div>--}}
                    {{--<div class="card-body">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                    {{--<h4 class="shipment">Shipment Addresses</h4>--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-lg-5 col-md-6">--}}
                    {{--<div class="shipment-border-right">--}}
                    {{--<p>Ship date: <b>FRI 11/11/2017</b></p>--}}
                    {{--<p class="text-uppercase special_color">BRASELTON,GA US</p>--}}
                    {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="col-lg-7 col-md-6">--}}
                    {{--<div class="">--}}
                    {{--<p>Ship date: <b>Pending</b></p>--}}
                    {{--<p class="text-uppercase special_color">East HANOVER,NJ US</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                    {{--<h4 class="shipment">Shipment Facts</h4>--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-4">--}}
                    {{--<p> BL Number </p>--}}
                    {{--</div>--}}
                    {{--<div class="col-8">--}}
                    {{--<p> 123456</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-4">--}}
                    {{--<p> Shipping Company </p>--}}
                    {{--</div>--}}
                    {{--<div class="col-8">--}}
                    {{--<p> FedEX SmartPost</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="row">--}}
                    {{--<div class="col">--}}
                    {{--<h4 class="shipment">Shipment Progress</h4>--}}
                    {{--<div class="row bs-wizard horizantal-timeline" style="border-bottom:0; margin:0px; font-family: RalewayMedium;">--}}
                    {{--<div class="col-md-3 text-left bs-wizard-step complete">--}}
                    {{--<div class="text-left bs-wizard-stepnum">Order confirmed</div>--}}
                    {{--<div class="progress" style="width: 140%;"><div class="progress-bar"></div></div>--}}
                    {{--<a style="left:13%" href="#" class="bs-wizard-dot text-center">1</a>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-3 bs-wizard-step complete"><!-- complete -->--}}
                    {{--<div class="text-center bs-wizard-stepnum">In production</div>--}}
                    {{--<div class="progress" style="position: relative;left: 56%;">--}}
                    {{--<div class="progress-bar"></div></div>--}}
                    {{--<a style="left:53%" href="#" class="bs-wizard-dot text-center">2</a>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-3 bs-wizard-step active"><!-- complete -->--}}
                    {{--<div class="text-center bs-wizard-stepnum">Reading for Shipping</div>--}}
                    {{--<div class="progress" style="left: 55%;width:135%;"><div class="progress-bar"></div></div>--}}
                    {{--<a style="left:53%" href="#" class="bs-wizard-dot text-center">3</a>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-3 bs-wizard-step disabled"><!-- active -->--}}
                    {{--<div class="text-right bs-wizard-stepnum">Shipped</div>--}}
                    {{--<div class="progress" style="width: 0%;"><div class="progress-bar"></div></div>--}}
                    {{--<a style="left:93%" href="#" class="bs-wizard-dot text-center">4</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}


                    {{--<div style="display:none; font-family: RalewayMedium;" class="row vertical-timeline">--}}
                    {{--<div class="timeline">--}}
                    {{--<div class="timeline-item active">--}}
                    {{--<div class="timeline-icon">--}}
                    {{--<span style="top: 13px;position: relative;left: 42%;">1</span>--}}
                    {{--</div>--}}
                    {{--<div class="timeline-content">--}}
                    {{--<p class="timeline-content-date">Order confirmed</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="timeline-item active">--}}
                    {{--<div style="top:20%;" class="timeline-icon">--}}
                    {{--<span style="top: 13px;position: relative;left: 42%;">2</span>--}}
                    {{--</div>--}}
                    {{--<div class="timeline-content right">--}}
                    {{--<p class="timeline-content-date">In production</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="timeline-item active">--}}
                    {{--<div style="top:20%;" class="timeline-icon">--}}
                    {{--<span style="top: 13px;position: relative;left: 42%;">3</span>--}}
                    {{--</div>--}}
                    {{--<div class="timeline-content">--}}
                    {{--<p class="timeline-content-date">Reading for Shipping</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="timeline-item">--}}
                    {{--<div style="top:21%;" class="timeline-icon">--}}
                    {{--<span style="top: 13px;position: relative;left: 42%;">4</span>--}}
                    {{--</div>--}}
                    {{--<div class="timeline-content right">--}}
                    {{--<p class="timeline-content-date">Shipped</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="row">--}}
                    {{--<div class="col-lg-12">--}}
                    {{--<table id="tracking" class="table table-responsive">--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                    {{--<th scope="row">1</th>--}}
                    {{--<td style="width: 370px;">Order confirmed</td>--}}
                    {{--</div>--}}
                    {{--<td style="width: 390px;" class="text-center"><img src="/public/img/ico-ok.png" alt=""></td>--}}
                    {{--<td style="width: 770px;" class="text-right">Notifications was sent</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<th scope="row">2</th>--}}
                    {{--<td>In production</td>--}}
                    {{--<td class="text-center"><img src="/public/img/ico-ok.png" alt=""></td>--}}
                    {{--<td class="text-right">Notifications was sent</td>--}}
                    {{--</tr>--}}
                    {{--<tr class="active-prog">--}}
                    {{--<th scope="row">3</th>--}}
                    {{--<td>Reading for Shipping</td>--}}
                    {{--<td class="text-center"><b>Current step</b></td>--}}
                    {{--<td class="text-right">Notifications was sent</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<th scope="row">4</th>--}}
                    {{--<td>Shipped</td>--}}
                    {{--<td class="text-center">awaiting</td>--}}
                    {{--<td class="text-right">--}}
                    {{--<button style="margin-top:0.2rem;" type="button" class="btn btn-table btn-secondary-disable" disabled="">Track Shipment</button>--}}
                    {{--<button  style="margin-top:0.2rem;"type="button" class=" btn btn-table btn-secondary-disable" disabled="">See documents</button>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--</tbody>--}}
                    {{--</table>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <!--Код скрипта можно вставить в нижней части страницы, чтобы он подождал, пока загрузится страница, а затем выполнился.-->
    <script type="text/javascript" src="//www.17track.net/externalcall.js"></script>
    <script type="text/javascript">
        function doTrack() {
            var num = document.getElementById("YQNum").value;
            if(num===""){
                alert("Enter your number.");
                return;
            }
            YQV5.trackSingle({
                //Обязательно, укажите id контейнера.
                YQ_ContainerId:"YQContainer",
                //Не обязательно, укажите высоту результата отслеживания, максимальная высота 800px, Значение по умолчанию - 560 пикселей.
                YQ_Height:560,
                //Не обязательно, выберите перевозчика, по умолчанию - автоопределение.
                YQ_Fc:"0",
                //Не обязательно, укажите язык пользовательского интерфейса, по умолчанию язык будет определен по настройкам браузера.
                YQ_Lang:"en",
                //Обязательно, укажите номер, который необходимо отслеживать.
                YQ_Num:num
            });
        }
    </script>
@endsection
