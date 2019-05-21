<?php
use App\Model\Main\MainPageDescription;
    $address1 = MainPageDescription::where('type','=','address1')->select('text')->first();
    if(empty($address1)){
        $address1 = (object)[
            'text' => ''
        ];
    }
    $address2 = MainPageDescription::where('type','=','address2')->select('text')->first();
    if(empty($address2)){
        $address2 = (object)[
            'text' => ''
        ];
    }
    $email = MainPageDescription::where('type','=','email')->select('text')->first();
    if(empty($email)){
        $email = (object)[
            'text' => ''
        ];
    }
    $linkedin = MainPageDescription::where('type','=','linkedin')->select('text')->first();
    if(empty($linkedin)){
        $linkedin = (object)[
            'text' => ''
        ];
    }
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name=viewport content="width=device-width, initial-scale=1">
    @yield('head')
</head>
<body>
  <div class="wrapper">
    @yield('content')
<div class="main-footer">
  <section style="background-color: #4c6897!important;" id="info">
  		<div class="row p-t-b" style="padding-bottom: 0px;">
        <div class="container">
          <div class="row ">
            {{--<div class="col-lg-3 order-4 order-md-1">--}}
              {{--<img style="width: 160px!important;" class="img-fluid logo-footer" src="/public/img/logo_footer.png" alt="">--}}
            {{--</div>--}}
            <div class="col-lg-4 order-1 order-md-2">
              <ul class="cordInf">
                <li style="font-family: RalewayRegular!important;">
                    <span class="address">
                        <?php  $text1 = str_replace_last('<p>','',$address1->text);
                            echo $text1;
                        ?>
                    </span>
                </li>
              </ul>
            </div>
            <div class="col-lg-4 order-2 order-md-3">
              <ul class="cordInf2">
                <li style="font-family: RalewayRegular;"><span class="address">
                        <?php  $text2 = str_replace_last('<p>','',$address2->text);
                        echo $text2;
                        ?>
                    </span></li>
              </ul>
            </div>
            <div class="col-lg-4 order-3 order-md-4">
              <ul class="cordEmail">
                <li style="font-family: RalewayRegular;"><span class="address">
                        <?php  $text3 = str_replace_last('<p>','',$email->text);
                            echo $text3;
                        ?>
                    </span></li>
              </ul>
              <ul class="cordFollow">
                <li style="font-family: RalewayRegular;"><span class="address" >
                         <?php  $text4 = str_replace_last('<p>','',$linkedin->text);
                        echo $text4;
                        ?>
                    </span></li>
              </ul>
            </div>
          </div>
        </div>
  		</div>
	  <footer>
		  <div class="row footer">
			  <div class="container text-center">
				  <p style="font-family: RalewayRegular;">Copyright ©2003-2018 DIS Company Ltd. All rights reserved.</p>
			  </div>
		  </div>
	  </footer>
  	</section>
</div>
</div>
    @yield('script')
</body>
</html>
