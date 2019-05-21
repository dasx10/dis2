@extends('layout.user')
@section('head')
@include('template.head_user_template')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
#t-order{
  border-bottom: 2px solid #fff;
}
</style>
@endsection
@section('content')
@include('user.header')
<div class="app-body">
  @include('user.sidebar')
  <main class="main">
    <div class="main_container_fluid">
      <div class="row">
        <div class="col-12" style="font-family: RalewayMedium;display: inline-block">
          <div class="row" style="padding-bottom: 1rem;">
            <div class="col-md-6">
              <input type="text" id="YQNum" class="form-control m-b-10" value="{{$dis_ref}}" style="padding: 0.375rem 0.75rem!important;" placeholder="Insert DIS ref. to track your shipment">
            </div>
            <div class="col-md-6">
              <input type="button" class="btn btn-primary" value="Track Shipment" />
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div style="width: 100%" id="YQContainer"></div>
            </div>
          </div>
        </div>
        @if(!empty($orders_data))
          <div class="col-12" style="font-family: RalewayMedium;">
            <div class="card">
              <div class="card-header text-center">
                <p style="font-family: RalewaySemiBold;" class="m-0">Tracking Order #{{$orders_data->dis_ref}}</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="shipment">Shipment Addresses</h4>
                    <div class="row">
                      <div class="col-lg-5 col-md-6">
                        <div class="shipment-border-right">
                          <p style="font-family: RalewayLight;">Ship date: <b style="font-family: RalewaySemiBold;">{{(!empty($orders_data->etd))?$orders_data->etd:'-'}}</b></p>
                          <p style="font-family: RalewaySemiBold;" class="text-uppercase special_color">{{(!empty($orders_data->shipping_company))? $orders_data->shipping_company:'-'}}</p>
                        </div>

                      </div>
                      <div class="col-lg-7 col-md-6">
                        <div class="">
                          <p style="font-family: RalewayLight;">Ship date: <b style="font-family: RalewaySemiBold;">
                              @if(!empty($orders_data->eta))
                                {{$orders_data->eta}}
                              @else
                                Pending
                              @endif
                            </b></p>
                          <p style="font-family: RalewaySemiBold;" class="text-uppercase special_color">{{(!empty($orders_data->pod))?$orders_data->pod:'-'}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h4 class="shipment">Shipment Facts</h4>
                    <div class="row">
                      <div class="col-4">
                        <p> BL Number </p>
                      </div>
                      <div class="col-8">
                        <p style="font-family: RalewayMedium;"> <b>{{(!empty($orders_data->bl_number))?$orders_data->bl_number:'-'}}</b></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p> Shipping Company </p>
                      </div>
                      <div class="col-8">
                          <p style="font-family: RalewayMedium;"> <b>{{(!empty($orders_data->shipping_company))?$orders_data->shipping_company:'-'}}</b></p>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col">
                    <h4 class="shipment">Shipment Progress</h4>
                    <div class="row bs-wizard horizantal-timeline" style="border-bottom:0; margin:0px; font-family: RalewayMedium;">
                        @if(in_array('Order Confirmed',$orders_statuses) || in_array('In Production',$orders_statuses) || in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                          <div class="col-md-3 text-left bs-wizard-step complete">
                        @else
                            <div class="col-md-3 text-left bs-wizard-step disabled">
                        @endif

                          <div style="font-family: RalewayRegular;" class="text-left bs-wizard-stepnum">Order Confirmed</div>
                          <div class="progress" style="width: 140%;"><div class="progress-bar"></div></div>
                          <a style="left:13%" href="#" class="bs-wizard-dot text-center">1</a>
                        </div>

                              @if(in_array('In Production',$orders_statuses) || in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                        <div class="col-md-3 bs-wizard-step complete"><!-- complete -->
                          @else
                            <div class="col-md-3 bs-wizard-step disabled">
                          @endif
                          <div style="font-family: RalewayRegular;" class="text-center bs-wizard-stepnum">In Production</div>
                          <div class="progress" style="position: relative;left: 56%;">
                            <div class="progress-bar"></div></div>
                            <a style="left:53%" href="#" class="bs-wizard-dot text-center">2</a>
                          </div>

                            @if(in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                          <div class="col-md-3 bs-wizard-step complete"><!-- complete -->
                            @else
                              <div class="col-md-3 bs-wizard-step disabled">
                            @endif
                            <div style="font-family: RalewayRegular;" class="text-center bs-wizard-stepnum">Ready to be shipped</div>
                            <div class="progress" style="left: 55%;width:135%;"><div class="progress-bar"></div></div>
                            <a style="left:53%" href="#" class="bs-wizard-dot text-center">3</a>
                          </div>

                              @if(in_array('Shipped',$orders_statuses))
                          <div class="col-md-3 bs-wizard-step complete"><!-- active -->
                            @else
                              <div class="col-md-3 bs-wizard-step disabled">
                              @endif
                            <div style="font-family: RalewayRegular;" class="text-right bs-wizard-stepnum">Shipped</div>
                            <div class="progress" style="width: 0%;"><div class="progress-bar"></div></div>
                            <a style="left:93%" href="#" class="bs-wizard-dot text-center">4</a>
                          </div>
                      </div>


                      <div style="display:none; font-family: RalewayMedium;" class="row vertical-timeline">
                        <div class="timeline">
                          @if(in_array('Order Confirmed',$orders_statuses) || in_array('In Production',$orders_statuses) || in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                            <div class="timeline-item active">
                          @else
                                <div class="timeline-item ">
                          @endif
                            <div class="timeline-icon">
                              <span style="top: 13px;position: relative;left: 42%;">1</span>
                            </div>
                            <div class="timeline-content">
                              <p class="timeline-content-date">Order Confirmed</p>
                            </div>
                          </div>

                          @if(in_array('In Production',$orders_statuses) || in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                            <div class="timeline-item active">
                          @else
                                <div class="timeline-item">
                          @endif
                            <div style="top:20%;" class="timeline-icon">
                              <span style="top: 13px;position: relative;left: 42%;">2</span>
                            </div>
                            <div class="timeline-content right">
                              <p class="timeline-content-date">In Production</p>
                            </div>
                          </div>

                          @if(in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                            <div class="timeline-item active">
                          @else
                                <div class="timeline-item">
                          @endif
                            <div style="top:20%;" class="timeline-icon">
                              <span style="top: 13px;position: relative;left: 42%;">3</span>
                            </div>
                            <div class="timeline-content">
                              <p class="timeline-content-date">Ready to be shipped</p>
                            </div>
                          </div>

                          @if(in_array('Shipped',$orders_statuses))
                            <div class="timeline-item active">
                          @else
                                <div class="timeline-item">
                          @endif
                            <div style="top:21%;" class="timeline-icon">
                              <span style="top: 13px;position: relative;left: 42%;">4</span>
                            </div>
                            <div class="timeline-content right">
                              <p class="timeline-content-date">Shipped</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12">
                          <table id="tracking" class="table table-responsive">
                            <tbody>

                              <tr>
                                <th scope="row">1</th>
                                <td style="width: 370px;">Order Confirmed</td>
                                @if(in_array('Order Confirmed',$orders_statuses) || in_array('In Production',$orders_statuses) || in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                              <td style="width: 390px;" class="text-center"><img src="/public/img/ico-ok.png" alt=""></td>
                                @else
                                    <td class="text-center"><b>Current step</b></td>
                                @endif
                                @if(in_array('Order Confirmed',$orders_statuses) || in_array('In Production',$orders_statuses) || in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                              <td style="width: 770px; font-family: RalewayRegular;" class="text-right">Notifications was sent</td>
                                @endif
                            </tr>
                            <tr>
                              <th scope="row">2</th>
                              <td>In Production</td>
                              @if(in_array('In Production',$orders_statuses) || in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                              <td class="text-center"><img src="/public/img/ico-ok.png" alt=""></td>
                              @else
                                @if(count(array_intersect(['Shipped'],$orders_statuses))==0 && !in_array('Order Confirmed',$orders_statuses))
                                  <td class="text-center">awaiting</td>
                                @else
                                  <td class="text-center"><b>Current step</b></td>
                                @endif
                              @endif
                              @if(in_array('In Production',$orders_statuses) || in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                              <td style="font-family: RalewayRegular;" class="text-right">Notifications was sent</td>
                              @endif
                            </tr>
                            <tr class="active-prog">
                              <th scope="row">3</th>
                              <td>Ready to be shipped</td>
                              @if(in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                                <td class="text-center"><img src="/public/img/ico-ok.png" alt=""></td>
                              @else
                                @if(count(array_intersect(['Shipped'],$orders_statuses))==0 && !in_array('In Production',$orders_statuses))
                                  <td class="text-center">awaiting</td>
                                @else
                                  <td class="text-center"><b>Current step</b></td>
                                @endif
                              @endif
                              @if(in_array('Shipped',$orders_statuses) || in_array('Ready to be shipped',$orders_statuses))
                              <td style="font-family: RalewayRegular;" class="text-right">Notifications was sent</td>
                              @endif
                            </tr>
                            <tr>
                              <th scope="row">4</th>
                              <td>Shipped</td>
                              @if(in_array('Shipped',$orders_statuses))
                                <td class="text-center"><img src="/public/img/ico-ok.png" alt=""></td>
                              @else
                                @if(count(array_intersect(['Shipped'],$orders_statuses))==0 && !in_array('Ready to be shipped',$orders_statuses))
                                  <td class="text-center">awaiting</td>
                                @else
                                  <td class="text-center"><b>Current step</b></td>
                                @endif
                              @endif
                              <td class="text-right">
                                @if(!empty($link))
                                  <button style="margin-top:0.2rem;" onclick=" window.open('{{$link}}','_blank')" type="button" class="btn btn-table btn-secondary" >Track Shipment</button>
                                @else
                                  <button style="margin-top:0.2rem;" type="button" class="btn btn-table btn-secondary-disable" disabled="">Track Shipment</button>
                                @endif


                                @if(!empty($files_src))
                                  <a style="margin-top:0.2rem;"type="button" download="{{$files_src}}" href="{{$files_src}}" class=" btn btn-table btn-secondary">See documents</a>
                                  @else
                                    <a  style="margin-top:0.2rem;"type="button" class="btn btn-table btn-secondary-disable" disabled>See documents</a>
                                @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </main>
</div>
@endsection
@section('script')
@include('template.script_user_template')
<script type="text/javascript" src="//www.17track.net/externalcall.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $( function() {
      var availableTags = [
          @foreach($orders as $order)
            "{{$order->dis_ref}}",
          @endforeach
      ];
      $( "#YQNum" ).autocomplete({
          source: availableTags,
          select: function( event, ui ) {
              window.location = '/panel/user/track-your-orders/'+ui.item.label;
          }
      });

  } );

  function download_files(btn) {
      var files_str = $(btn).attr('data-files');
      if(files_str){
          var arr = files_str.split(',');
          for(var k in arr){
//                          $('.downloadfile').attr('href',arr[k]);
              downloadFile(arr[k]);
          }
      }
  }

  function downloadFile(filePath){
      var link=document.createElement('a');
      link.href = filePath;
      link.target = '_blank';
      link.download = filePath;
      console.log(link);
      link.click();

  }

//    function doTrack() {
//        var num = document.getElementById("YQNum").value;
//        if(num===""){
//            alert("Enter your number.");
//            return;
//        }
//        YQV5.trackSingle({
//            //Обязательно, укажите id контейнера.
//            YQ_ContainerId:"YQContainer",
//            //Не обязательно, укажите высоту результата отслеживания, максимальная высота 800px, Значение по умолчанию - 560 пикселей.
//            YQ_Height:560,
//            //Не обязательно, выберите перевозчика, по умолчанию - автоопределение.
//            YQ_Fc:"0",
//            //Не обязательно, укажите язык пользовательского интерфейса, по умолчанию язык будет определен по настройкам браузера.
//            YQ_Lang:"en",
//            //Обязательно, укажите номер, который необходимо отслеживать.
//            YQ_Num:num
//        });
//    }
</script>
@endsection
