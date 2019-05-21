@extends('layout.user')
@section('head')
    @include('template.head_user_template')
@endsection
@section('content')
    @include('user.header')
<div class="app-body">
  @include('user.sidebar')
      <main class="main">
        <div class="main_container_fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <table class="table table-responsive table-striped" id="table_orders">
                    <thead style="font-size:1.2rem;" >

                      <tr style="font-family:RalewaySemiBold;">
                          <th style="width: 10%;" scope="col">Ref #</th>
                          <th style="" scope="col">POL</th>
                          <th style="" scope="col">POD</th>
                          <th style="" scope="col">ETD</th>
                          <th style="" scope="col">ETA</th>
                          <th style="" scope="col">Amount</th>
                          <th style="width:15%" scope="col">Payment Terms</th>
                          <th style="width:12%" scope="col">Status</th>
                          <th style="" scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                      <tr>
                        <th scope="row">{{$order->dis_ref}}</th>
                          <td style="font-family:RalewayLight;">{{(!empty($order->pol))?$order->pol:'-'}}</td>
                          <td style="font-family:RalewayLight;">{{(!empty($order->pod))?$order->pod:'-'}}</td>
                          <td style="font-family:RalewayLight;">{{(!empty($order->etd))?$order->etd:'-'}}</td>
                          <td style="font-family:RalewayLight;">{{(!empty($order->eta))?$order->eta:'-'}}</td>
                          {{--{{date('M d, o h:i a',strtotime($order->created_at.' +10 day'))}}--}}
                          <th scope="row"> <span class="special_color">$</span>
                              @if($order->pay_with_points!=0 && $order->pay_with_points>0)
                                {{$order->total_amount-$order->pay_with_points*200}} <br>( {{$order->pay_with_points}} points )
                              @else
                                {{$order->total_amount}}
                            @endif
                        </th>

                  <td> {{$order->payment_terms}}</td>
                        @if($order->status=='Paid')
                          <td style="font-family:RalewayLight;" class="color-green">{{$order->status}}</td>
                        @elseif($order->status=='Unpaid')
                          <td style="font-family:RalewayLight;color: red">{{$order->status}}</td>
                        @else
                          <td style="font-family:RalewayLight;">{{$order->status}}</td>
                        @endif
                        <td><u onclick="window.location='/panel/user/current-orders/{{$order->id}}'">View</u> <span>|</span> <u onclick="window.location='/panel/user/track-your-orders/{{$order->id}}'">Track</u></td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
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
                    $('#table_orders').DataTable({
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
