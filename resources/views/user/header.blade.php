<?php
    use App\Model\Clients\ClientsData;
    use App\Model\Sessions;
    $users_id = Sessions::get_users_id_by_token(Sessions::get_token());
    $data = ClientsData::where('users_id','=',$users_id)->select('dis_points')->first();
    $dis_points = $data->dis_points;
//    $dis_points = 0;
?>
<header class="app-header">
  <div class="container-fluid header_wrapper">
      <div class="row">
      <div class="logo-header" style="position:relative;">
          <p onclick="window.location='/panel/user'" style="font-family: RalewayBold;position: relative;top: 29%;margin: 0;font-size: 24px;text-align: center;color: #fff; cursor: pointer;">MY E-DESK</p>
          <p style="position:absolute; right:0px; bottom:2px;" class="m-0 float-right"><img class="img-respinsove" src="/public/img/logo.png"></p>
      </div>
      <div class="col-2 align-items-center d-none d-sm-none d-md-flex d-xl-flex">
          <span style="font-family:RalewaySemiBold"; class="header_text">MY DIS POINTS<span id="dis" class="badge badge-pill badge-light">{{$dis_points}}</span></span>
      </div>
      <div class="col-md-2 col-lg-3 col-xl-3 align-items-center justify-content-end  d-none d-sm-none d-md-flex d-xl-flex">
          <div class="dropdown">
              <a id="p-order" class="align-self-center header_breadcrumb" href="/panel/user/purchase-orders" style="font-family: RalewaySemiBold; padding-bottom: 2px;" >
                PURCHASE ORDER
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-2 align-items-center d-none d-sm-none d-md-flex d-xl-flex" style="padding-left: 0.9375rem;">
        <div class="dropdown">
          <a id="t-order" class="header_breadcrumb" href="/panel/user/track-your-orders" style="font-family: RalewaySemiBold; padding-bottom: 2px;" >
            TRACK YOUR ORDERS
          </a>
         </div>
      </div>
      <div class="col align-items-center justify-content-end  d-none d-sm-none d-md-flex d-xl-flex">
          <a id="header_logout" href="/logout" style="font-family: RalewaySemiBold; font-size:1rem; text-decoration: none; color: white;position: relative;top: 2px;">
              <img src="/public/img/logout.png" alt="logout" class="header_icon_logout fixed-img">
              <span class="hide-xs">LOG OUT</span>
          </a>
      </div>
      <div class="col d-flex d-sm-flex d-md-none d-xl-none align-items-center justify-content-end">
          <button class="navbar-dark navbar-toggler btn_open_navbar" type="button">
              <span class="navbar-toggler-icon"></span>
          </button>
      </div>
      </div>
  </div>
</header>
