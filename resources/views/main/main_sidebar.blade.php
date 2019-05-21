<?php
    $n_t_1 = \App\Model\Main\MainPageDescription::where('type','=','navigations_type_1')->select('text')->first();
    if(empty($n_t_1)){
        $n_t_1 = (object)[
            'text' => ''
        ];
    }
    $n_t_2 = \App\Model\Main\MainPageDescription::where('type','=','navigations_type_2')->select('text')->first();
    if(empty($n_t_2)){
        $n_t_2 = (object)[
            'text' => ''
        ];
    }
    $n_t_3 = \App\Model\Main\MainPageDescription::where('type','=','navigations_type_3')->select('text')->first();
    if(empty($n_t_3)){
        $n_t_3 = (object)[
            'text' => ''
        ];
    }

    $n_t_4 = \App\Model\Main\MainPageDescription::where('type','=','navigations_type_4')->select('text')->first();
    if(empty($n_t_4)){
        $n_t_4 = (object)[
            'text' => ''
        ];
    }
    $n_t_5 = \App\Model\Main\MainPageDescription::where('type','=','navigations_type_5')->select('text')->first();
    if(empty($n_t_5)){
        $n_t_5 = (object)[
            'text' => ''
        ];
    }
    $n_t_6 = \App\Model\Main\MainPageDescription::where('type','=','navigations_type_6')->select('text')->first();
    if(empty($n_t_6)){
        $n_t_6 = (object)[
            'text' => ''
        ];
    }

?>
<div style="font-family: RalewaySemiBold;" class="collapse navbar-collapse sidebar-wrapper" id="navbarsExampleDefault">
    <ul class="navbar-nav m-auto sidebar-wrapper_two">
        <li class="nav-item">
            <a class="nav-link top-menu" href="/brands">{{$n_t_1->text}}</a>
        </li>

        {{--<li class="nav-item">
            <a class="nav-link top-menu" href="/our-industries ">{{$n_t_2->text}}</a>
        </li>--}}
        <li onclick="window.location = '/our-industries'" class="nav-item dropdown dropdown-mob icon-login">
            <a href="/our-industries" class="nav-link top-menu dropdown-mob text-uppercase dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$n_t_2->text}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item text-uppercase" href="/industries/food-processing-industry"><span>FOOD PROCESSING</span> </a>
                <a class="dropdown-item text-uppercase" href="/industries/paint-coating-industry"><span>PAINT & COATING</span></a>
                <a class="dropdown-item text-uppercase" href="/industries/disinfestation-sanitary-industry"><span>DISINFESTATION & SANITARY</span></a>
                <a class="dropdown-item text-uppercase" href="/industries/cooling-industry"><span>COOLING INDUSTRY</span></a>
            </div>
        </li>
        <div class="icon-login-xs">
        <li class="nav-item">

            <a style="padding-left: 7px!important;" class="dropdown-item text-uppercase" href="/our-industries"><span> {{$n_t_2->text}}</span> </a>
        </li>
        <li class="nav-item">
            <a class="dropdown-item text-uppercase" href="/industries/food-processing-industry">- <span>FOOD PROCESSING</span> </a>
        </li>
        <li class="nav-item">
            <a class="dropdown-item text-uppercase" href="/industries/paint-coating-industry">- <span>PAINT & COATING</span></a>
        </li>
        <li class="nav-item">
            <a class="dropdown-item text-uppercase" href="/industries/disinfestation-sanitary-industry">- <span>DISINFESTATION & SANITARY</span></a>
        </li>
        <li class="nav-item">
            <a class="dropdown-item text-uppercase" href="/industries/cooling-industry">- <span>COOLING INDUSTRY</span></a>
        </li>
        </div>
        <li class="nav-item">
            <a class="nav-link top-menu" href="/tailor">{{$n_t_3->text}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link top-menu about_long" href="/about">{{$n_t_4->text}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link top-menu" href="/join">{{$n_t_5->text}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link top-menu" href="/contact">{{$n_t_6->text}}</a>
        </li>
        <li class="icon-login-xs nav-item">
            <a class="nav-link top-menu" href="/login">LOGIN</a>
        </li>
    </ul>
    <a class="icon-login" href="/login"><img class="img_login" src="/public/img/login_header.png" alt=""></a>
</div>
