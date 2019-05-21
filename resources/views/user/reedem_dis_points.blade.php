@extends('layout.user')
@section('head')
    @include('template.head_user_template')
    <link rel="stylesheet" href="/public/css/jquery.webui-popover.css">
    <style>
        .circle{
            background-color: #e9ecef;
            color:black;
            min-width: 35px;
            height: 35px;
            border-radius: 50%;
            text-align: center;
            float: right;
            position: relative;;
            z-index: 2;
            padding: 5px ;



        }
        .circle0{
            background-color: #4c6897;
            color:black;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            text-align: center;
            float:left;
            position: relative;
            z-index: 2;
            padding: 5px;
        }
        .matr{
            width: 100%;
        }
        .table td, .table th{
            padding: 0!important;
            vertical-align: top;
            border-top: 0px solid #dee2e6;
        }
        .progress-end{
            height: 6px;
            background-color: #e9ecef;
            position: relative;
            right: 2px;
            top:15px;
        }
        .progress0{
            height: 6px;
            background-color: #e9ecef;
            position: relative;
            top: 15px;
            width: 100%;}

        .completed{
            background-color: #4c6897!important;
            color:white!important;
        }
        .start{
            width: 100%;
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
            <div class="col-12" style="font-family: RalewayMedium;">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div>
                      <img style="margin-left: 1rem;" src="/public/img/active-dis.png" alt="">
                    </div>
                    <div style="font-family:RalewayRegular;" class="col">
                      <p>Congratulations! You have <b>{{$count}}</b> DIS points. <br>
                        @if($l_points>0)
                            <b>{{$l_points}}</b> more points to go to our <b>BIG prizes</b></p>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <p><b>My DIS Points History:</b></p>
                      <table class="table">
                          <tbody class="matr">
                          <tr class="line" style="width: 100%;">

                                      @foreach($array_points as $key => $point)
                                          @if($key==0)
                                              @if(!empty($point['orders_name']))
                                                    <td><div class='circle0 completed'>0</div><div class="progress0 completed "></div></td>
                                                    <td><div class='circle titles{{$key}} completed'>{{$point['count']}}</div><div class="progress-end completed "></div></td>
                                              @else
                                                     <td><div class='circle0 completed'>0</div><div class="progress0 completed "></div></td>
                                                    <td><div class='circle  '>10</div><div class="progress-end  "></div></td>
                                              @endif
                                          @else
                                              @if(!empty($point['orders_name']))
                                                  <td><div class='circle titles{{$key}} completed'>{{$point['count']}}</div><div class="progress-end completed "></div></td>
                                              @else
                                                  <td><div class='circle '>{{$point['count']}}</div><div class="progress-end  "></div></td>
                                              @endif
                                          @endif
                                      @endforeach
                                  </tr>
                          </tbody>
                          </table>
                      {{--<input class="free-points" type="text">--}}
                      {{--<button onclick="addTable();">Добавить</button>--}}

                                  <p><b>Our Prizes Catalog:</b></p>
                      @foreach($prizes as $prize)
                        <div class="row">
                          <div class="img-block">
                            <img style="width: 100px;height: 100px; border-radius: 50%;" src="{{$prize->src}}" alt="">
                            @if($sum_points>=$prize->points*$user_money_spent)
                              <span onclick="set_cost('{{$prize->points*$user_money_spent}}','{{$prize->id}}','{{$prize->end_date}}')" class="dis-point">{{$prize->points*$user_money_spent}}</span>
                            @else
                              <span  class="dis-point-disabled">{{$prize->points*$user_money_spent}}</span>
                            @endif
                          </div>
                          <div style="font-family:RalewayItalic;" class="col">
                            <b style="margin-right: 0.5rem;">{{$prize->points*$user_money_spent}} DIS Points:</b>{{$prize->title}}<br>
                            {{$prize->descr}}
                          </div>
                            <div class="col text-right ">
                                <p><b>End Date: </b>{{$prize->end_date}}</p>
                            </div>
                        </div>
                      @endforeach
                  </div>
                </div>

              </div>
            </div>
        </div>
      </main>
        </div>
        @endsection
        @section('script')
            @include('template.script_user_template')
            <script src="/public/js/jquery.webui-popover.js"></script>
            <script>
                @foreach($array_points as $key => $point)
                    $('.titles{{$key}}').webuiPopover({placement:'bottom',trigger: "hover",content:'<div class="text-center"><p class="m-0">{{$point['orders_date']}}</p> <p class="special_color m-0">{{$point['orders_name']}}</p></div>'});
                @endforeach

                var i = 1;
                function addTable(){
                    // var i = $('.free-points').val();
                    $('.line').append("<td><div class='circle'>"+ i +"</div><div class='progress-end'></div></td>")
                    $('.progress0').addClass("start");

                }

                function set_cost(cost,id,end_date) {
                    $.sweetModal.confirm('DIS Points','Are you sure you want to spend '+cost+' points?', function() {
                        $.ajax({
                            url:"/api/user/prize/buy",
                            type:"POST",
                            data:{
                                prize_id : id,
                                cost : cost,
                                end_date : end_date,
                                token : '{{$token}}'
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                '_token' : '{{ csrf_token() }}'
                            },
                            dataType: 'JSON',
                            success:function (data) {
                                console.log(data);
                                if(data.success==true){
                                    sweet_modal('Success','success',1000);
                                    setTimeout(function () {
                                        window.location = location;
                                    },1000);
                                }else{
                                    sweet_modal(data.message,'error',1000);
                                }
                                $(".btn_submit").removeAttr('disabled');
                            },error:function (data) {
                                console.log(data);
                                sweet_modal('Something went wrong','error',1000);
                                $(".btn_submit").removeAttr('disabled');
                            }
                        })
                    });
                    $('.costs').html(cost);
                }

            </script>
        @endsection
