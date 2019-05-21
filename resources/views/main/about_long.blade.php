@extends('layout.main')
@section('head')
@include('template.head_template')
@endsection
@section('content')
<div class="main-content">
@include('main.header')
<section class="fdb-block">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 style="font-family: RalewayBold;color:#253756;" class="text-center mt-5 mb-5">WHO WE ARE</h2>
        <img class="img-fluid mb-5" src="{{$first_descr->src}}" >
        <div style="font-family: RalewayLight!important;">
            <?php
            echo $first_descr->text;
            ?>
        </div>
        </div>
      </div>
    </div>
    <div class="container category bg-white">
      <div class="container">
        <div class="row">
          <div class="col-lg-1 text-right">
            <img src="/public/img/security.png" class="img-icon">
          </div>
          <div class="col-lg-11">

            <p style="font-family: RalewayLight;margin-top: 1rem;">
              <b style="font-family: RalewaySemiBold;">Security:</b> We conduct business ethically and with integrity.
            </p>
          </div>
          <div class="col-lg-1 text-right">
            <img src="/public/img/reliability.png" class="img-icon">
          </div>
          <div class="col-lg-11">

            <p style="font-family: RalewayLight;margin-top: 0.5rem;">
              <b style="font-family: RalewaySemiBold;">Reliability:</b> We strive to satisfy our customers and respond to their needs by exclusively providing
              the best quality/price ratio and by offering an excellent service & a long-term partnership.
            </p>
          </div>
          <div class="col-lg-1 text-right">
            <img src="/public/img/flex.png" class="img-icon">
          </div>
          <div class="col-lg-11">

            <p style="font-family: RalewayLight;margin-top: 1rem;">
              <b style="font-family: RalewaySemiBold;">Flexibility:</b> In order to be able to serve our clients in a way that is effectively aligned with their
              goals, we offer them cost-effective tailor-made solutions.
            </p>
          </div>
          <div class="col-lg-1 text-right">
            <img src="/public/img/integr.png" class="img-icon">
          </div>
          <div class="col-lg-11">

            <p style="font-family: RalewayLight;margin-top: 1rem;">
              <b style="font-family: RalewaySemiBold;">Integrity:</b> Our values guide our actions and describe how we conduct ourselves in the market toward
              our customers and suppliers.
            </p>
          </div>
        </div>
      </div>
    </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div style="font-family: RalewayLight;">
          <?php echo $second_descr->text;?>
        </div>
        <div style="margin: 4rem 0;" class="col-md-12 text-center">
          <img class="img-fluid" src="{{$second_descr->src}}" class="whowearebot">
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection
@section('script')
@include('template.script_template')
@endsection
