@extends('layout.user')
@section('head')
    @include('template.head_user_template')
@endsection
@section('content')
    @include('user.header')
    @include('user.sidebar')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3 pb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div>
                                        <img style="margin-left: 1rem;" src="/public/img/active-dis.png" alt="">
                                    </div>
                                    <div class="col">
                                        <p>Congratulations! You have <b>100</b> DIS points. <br>
                                            <b>50</b> more points to go to our <b>BIG prizes</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p><b>My DIS Points History:</b></p>
                                <div class="row bs-wizard" style="border-bottom:0;">

                                    <div class="col-3 bs-wizard-step complete">
                                        <div class="text-center bs-wizard-stepnum">Order confirmed</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot text-center">1</a>
                                    </div>

                                    <div class="col-3 bs-wizard-step complete"><!-- complete -->
                                        <div class="text-center bs-wizard-stepnum">In production</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot text-center">2</a>
                                    </div>

                                    <div class="col-3 bs-wizard-step active"><!-- complete -->
                                        <div class="text-center bs-wizard-stepnum">Reading for Shipping</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot text-center">3</a>
                                    </div>

                                    <div class="col-3 bs-wizard-step disabled"><!-- active -->
                                        <div class="text-center bs-wizard-stepnum">Shipped</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot text-center">4</a>
                                    </div>
                                </div>
                                <p><b>Our Prizes Catalog:</b></p>
                                <div class="row">
                                    <div class="img-block">
                                        <img src="/public/img/ticket.png" alt="">
                                        <span class="dis-point">300</span>
                                    </div>
                                    <div class="col">
                                        <b>300 DIS Points:</b>Ta-damm! Win a trip to China!<br>
                                        Lorem ipsum dolor sit amet, consectetur.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="img-block">
                                        <img src="/public/img/forklift.png" alt="">
                                        <span class="dis-point">150</span>
                                    </div>
                                    <div class="col">
                                        <b>150 DIS Points:</b>Ta-damm! Win a Forklift!<br>
                                        Lorem ipsum dolor sit amet, consectetur.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </main>
        </div>
    </div>
@endsection
@section('script')
    @include('template.script_user_template')
@endsection