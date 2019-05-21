@extends('layout.main')
@section('head')
    @include('template.head_template')
@endsection
@section('content')
    <div class="main-content">
        @include('main.header')
        <section id="register">
            <div class="container">
                <div class="row mr-t-b-lg">
                    <div class="card m-auto" style="width: 30rem;-webkit-box-shadow: 0px 0px 27px -8px rgba(0,0,0,0.75);-moz-box-shadow: 0px 0px 27px -8px rgba(0,0,0,0.75);box-shadow: 0px 0px 27px -8px rgba(0,0,0,0.75);">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form style="padding-top: 4rem;padding-bottom: 4rem;" class="container text-center p-t-b p-r-l">
                                        <div class="form-group">
                                            <p style="margin-bottom: 2rem;font-family: RalewayRegular; font-size: 1.1rem;" class="text-uppercase"> UNDER Construction </p>
                                            <p class="text-center" style="font-size: 1rem; font-family: RalewayRegular;">New features will be available soon</p>
                                        </div>
                                        <div class="row text-center">
                                            <a class="btn_submit  btn-block btn btn-success" href="/" style="font-family:RalewaySemiBold;line-height: 30px;margin:15px auto;border-radius: 5px;background-color: rgb(86, 190, 96);color: #fff;border-bottom: 2px solid #508755;width: 100%;height: 40px;">Close</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@section('script')
    @include('template.script_template')