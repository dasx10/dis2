@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
        @include('admin.sidebar')
        <main class="main">
            <div class="container-fluid main_container_fluid">
                <div class="card">
                    <div class="card-header" style="padding-top: 0.9375rem;padding-bottom: 0.9375rem;padding-right: 0.625rem;padding-left: 1.25rem">
                        <h5 style="margin-bottom: 0;font-size: 1.125rem;"><button onclick='location.href="/panel/admin/clients"' class="btn_back"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button>CLIENTS</h5>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <form class="container-fluid" action="">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                        <div class="col form-group">
                                            <input type="text" class="form-control" placeholder="*Company Name" required>
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" class="form-control" placeholder="*Contact Name" required>
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" class="form-control" placeholder="*Email" required>
                                        </div>
                                        <div class="col form-group">
                                            <div class="styled-select">
                                                <select class="form-control" required>
                                                    <option selected disabled value="">*Country</option>
                                                    <option value="USA">USA</option>
                                                    <option value="Russia">Russia</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="Australia">Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col form-group">
                                            <div class="styled-select">
                                                <select class="form-control" required>
                                                    <option selected disabled value="">*Regione</option>
                                                    <option value="ANY">ANY</option>
                                                    <option value="MENA">MENA</option>
                                                    <option value="Europe">Europe</option>
                                                    <option value="Latin America">Latin America</option>
                                                    <option value="North America & Australia">North America & Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                        <div class="col form-group">
                                            <input type="text" class="form-control" placeholder="*Phone Number" required>
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" class="form-control" placeholder="Position">
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" class="form-control" placeholder="Company website">
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" class="form-control" placeholder="Industry">
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" class="form-control" placeholder="Product of interest">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin: 15px 0 25px 0">
                                    <div class="col-12 text-center">
                                        <button class="btn_page"><span>Edit</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script>
        $(document).ready(function () {
            $(".header_text").html('Clients');
        });
    </script>
@endsection