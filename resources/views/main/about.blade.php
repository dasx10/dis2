@extends('layout.main')
@section('head')
@include('template.head_template')
<style>
@media(min-width:1200px) and (max-width:1300px){
.container{
max-width: 1140px!important;
}
.who-text{
  font-size: 1rem!important;
}
 .navbar{
font-size: 1rem;
}
}
@media(min-width:1700px){
.p-t-lg-5{

  padding-top: 2rem!important;
}

}
</style>
@endsection
@section('content')
  @include('main.header')
<div style="position:relative;" class="main-content">
<section style="bottom:0; width:100%;" class="fdb-block">
   <div class="container">
     <div class="row m-b-5 mt-5" style="margin-top: 4.18rem!important;">
       <div class="col-12" style="position: relative;width: 100%;">
         <div class="row justify-content-center ipad-block" style="position: absolute; left: 0; width: 100%;">
           <div class="bg-white"></div>
           <div class="pt-5 p-t-lg-5 p-t-0 col-md-5 col-lg-3 text-center" style="position: relative;z-index: -1;padding-top: 4rem!important;">
             <img alt="image" class="img-fluid who" src="/public/img/about.png">
           </div>
           <div class="pt-5 p-t-lg-5 p-t-0 col-md-7 col-lg-5 text-left" style="position: relative;z-index: -1;padding-top: 4rem!important;">
             <p style="font-family: RalewayLight!important;   " class="who-text"><?php
                    $text = str_replace('<p>','',$wwa_main_descr->text);
                    $text = str_replace('</p>','<br><br>',$text);
                    echo $text;
                 ?>
             </p>

           </div>
                       <div class="col-12 text-center">
             <a style="font-family: RalewayLight;padding-left: 5.625rem;padding-right: 5.625rem;color: #fff;background-color: #56be60;border-color: #56be60;border-bottom: 2px solid #4ca754;" class="btn btn-warning" href="/about/about-long">Learn more</a>
           </div>


         </div>

         <img alt="image" class="img-fluid img-ipad" src="/public/img/ipad.png">

       </div>
     </div>
   </div>
</section>
</div>
@endsection
@section('script')
@include('template.script_template')
@endsection
