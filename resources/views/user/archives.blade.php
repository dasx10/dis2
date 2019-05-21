@extends('layout.user')
@section('head')
@include('template.head_user_template')
@endsection
@section('content')
@include('user.header')
<div class="app-body">
  @include('user.sidebar')
  <main class="main" >
    <div class="main_container_fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs" role="tablist">
                Select Orders by year:
                <?php
                      $i=0;
                ?>
                @foreach($response as $key=>$item)
                  @if($i==0)
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#{{$key}}" role="tab" aria-controls="{{$key}}">{{$key}}</a>
                  </li><span>|</span>
                  @else
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#{{$key}}" role="tab" aria-controls="{{$key}}">{{$key}}</a>
                    </li><span>|</span>
                  @endif
                  <?php
                    $i++;
                  ?>
                @endforeach
                {{--<li class="nav-item">--}}
                  {{--<a class="nav-link" data-toggle="tab" href="#2016" role="tab" aria-controls="profile">2016</a>--}}
                {{--</li><span>|</span>--}}
                {{--<li class="nav-item">--}}
                  {{--<a class="nav-link" data-toggle="tab" href="#2015" role="tab" aria-controls="messages">2015</a>--}}
                {{--</li>--}}
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <?php
                  $j=0;
                ?>
                @foreach($response as $key=>$item)
                  @if($j==0)
                    <div class="tab-pane active" id="{{$key}}" role="tabpanel">
                  @else
                    <div class="tab-pane" id="{{$key}}" role="tabpanel">
                  @endif
                  <table class="table table-responsive table-striped" id="table_archives">
                    <thead style="font-size:1.2rem;">
                      <tr style="font-family:RalewaySemiBold;">
                        <th style="width:229px" scope="col">Ref #</th>
                        <th style="width:344px" scope="col">Status</th>
                        <th style="width:308px" scope="col">Order Amount</th>
                        <th style="width:418px" scope="col">Arrival Date</th>
                        <th style="width:227px" scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($item as $order)
                      <tr>
                        <th scope="row">Ref {{$order->dis_ref}}</th>
                        <td style="font-family:RalewayLight;">Arrived, <span class="color-green">Paid Fully</span></td>
                        <th scope="row">$
                            @if($order->pay_with_points!=0 && $order->pay_with_points>0)
                                {{$order->total_amount-$order->pay_with_points*200}} <br>( {{$order->pay_with_points}} points )
                            @else
                                {{$order->total_amount}}
                            @endif
                        </th>
                        <td style="font-family:RalewayLight;">{{$order->arrival_date}}</td>
                        <td><u onclick="window.location='/panel/user/current-orders/{{$order->id}}?return=archives'">View</u> <span>|</span> <u onclick="window.location='/panel/user/track-your-orders/{{$order->dis_ref}}'">Track</u></td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                  <?php
                    $j++;
                  ?>
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
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#table_archives').DataTable({
              "order":[[0,"desc"]],
              "language": {
                  "zeroRecords": "There are no products to list",
                  "paginate": {
                      "next": ">",
                      "previous": "<"
                  }
              },
              "lengthMenu": [15],
              "pagingType": "simple_numbers"
          });
      } );
  </script>
  @endsection
