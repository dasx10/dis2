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
            <div class="card box-shadow">
                <div class="card-header " style="padding-top:  0.9375rem;padding-bottom: 0.9375rem;">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center ">
                            <h5 style="margin-bottom:0;font-size:1.125rem; margin-right:25px;">OPERATIONS</h5>
                            <form action="" method="GET" class="search_order_form" style="display:flex;width:400px;">
                                <input name="find_by_order" value="" type="search" id="global_filter_order" placeholder="Search..." class="form-control search global_filter" /><span id="search_btn_order" style="float:right;cursor: pointer; background:#4c6897;border:0.0625rem solid #d7d7d7;border-left:none;width: 2.5rem;height: 2.0625rem;text-align:center;"><img
                                            src="/public/img/admin/ico_search.png" alt="" style="width:1.125rem;height:1.125rem;vertical-align:-0.375rem;">
                                            </span>
                                <input id="hide_search_order" style="display: none;" type="submit" value="">
                            </form>
                        </div>
                    </div>
                </div>
            @foreach($orders as $key=>$order)
                    <div class="card-block">
                        <div class="table-responsive-lg">
                        <table class="table table-striped" id="table_orders_adm">
                            <thead>
                            <th class="RalewaySemiBold text-left" style="padding-left:1.16em;width:15%;font-size: 1.125rem;cursor:pointer;"><span>{{$key}}</span> Orders</th>
                            <th class="RalewaySemiBold" style="font-size: 1.125rem;">POL</th>
                            <th class="RalewaySemiBold" style="font-size: 1.125rem;">POD</th>
                            <th class="RalewaySemiBold" style="font-size: 1.125rem;">ETD</th>
                            <th class="RalewaySemiBold" style="font-size: 1.125rem;">ETA</th>
                            @if($role!='purchase')
                                <th class="RalewaySemiBold" style="font-size: 1.125rem;text-align:center;cursor:pointer;">Amount</th>
                            @endif
                            <th class="RalewaySemiBold" style="width:15%;text-align:center;font-size: 1.125rem;cursor:pointer;">Payment terms</th>
                            {{--<th class="RalewaySemiBold" style="font-size: 1.125rem;cursor:pointer;">Date</th>--}}
                            <th class="RalewaySemiBold" style="width:20%;text-align:center;cursor: pointer;font-size: 1.125rem;">Status</th>
                            <th data-orderable="false" class="RalewaySemiBold" style="width:18%;text-align:center;font-size: 1.125rem;cursor:default;">Options</th>
                            @if($role!='customer_service' && $role!='purchase_assistant')
                            <th data-orderable="false" class="RalewaySemiBold" style="width: 5%;font-size: 1.125rem;"></th>
                            @endif

                            </thead>
                            <tbody>
                            @foreach($order as $item)
                                <tr>
                                    <td style="padding-left:1.16em; font-family: RalewayMedium; font-size:1.25rem;">{{$item->dis_ref}}</td>
                                    <td class="RalewayMedium" style="font-size: 1.25rem;">{{$item->pol}}</td>
                                    <td class="RalewayMedium" style="font-size: 1.25rem;">{{$item->pod}}</td>
                                    <td class="RalewayMedium" style="font-size: 1.25rem;">{{$item->etd}}</td>
                                    <td class="RalewayMedium" style="font-size: 1.25rem;">{{$item->eta}}</td>
                                    @if($role!='purchase')
                                        <td class="text-center RalewayMedium" style="font-size:1.25rem;">$
                                            @if($item->pay_with_points!=0 && $item->pay_with_points>0)
                                                {{$item->total_amount-$item->pay_with_points*200}} <br>( {{$item->pay_with_points}} points )
                                            @else
                                                {{$item->total_amount}}
                                            @endif
                                        </td>
                                    @endif
                                    <td class="text-center RalewaySemiBold" style="font-size:1.125rem;">{{$item->payment_terms}}</td>
                                    @if($item->status=='Paid')
                                        <td class="text-center" style="font-family: RalewayLight; font-size:1.25rem;color:#1bcc1b;">{{ucfirst($item->status)}}</td>
                                    @elseif($item->status=='Unpaid')
                                        <td class="text-center" style="font-family: RalewayLight; font-size:1.25rem;color:red;">{{ucfirst($item->status)}}</td>
                                    {{--@elseif($item->status=='Paid in Full')--}}
                                        {{--<td class="text-center" style="font-family: RalewayLight; font-size:1.25rem;">Paid in Full</td>--}}
                                    @else
                                        <td class="text-center" style="font-family: RalewayLight; font-size:1.25rem;">{{ucfirst($item->status)}}</td>
                                    @endif
                                    {{--<td class="text-center RalewayLight" style="font-size:1.125rem;">{{date('d M o',strtotime($item->created_at))}}</td>--}}
                                    <td class="text-center" style="font-size:1.125rem;">
                                        @if(!empty($item->files))
                                            <a href="/panel/admin/orders/documents/{{$item->id}}" class="a_view">Documents</a>
                                            <a data-files="{{$item->files}}" onclick="download_files(this)" href="#downloadfiles" class="a_track">Track</a>
                                        @else
                                            <a href="/panel/admin/orders/documents/{{$item->id}}" class="a_view" style="border-right:none;">Documents</a>
                                        @endif
                                    </td>
                                    @if($role!='customer_service' && $role!='purchase_assistant')
                                    <td style="font-size: 1.125rem;"><button onclick="delete_order('{{$item->id}}')" class="btn_gray" >
                                            <img src="/public/img/admin/ico_delete.png" alt=""></button></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
            @endforeach
            </div>
        </div>
    </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(window).scroll(function() {
            var  box1 = $(document).scrollTop();

            if(box1 > 10){
                console.log(1);
            } else{
                console.log(0);
            }

        });

        $(document).ready(function(){
            $("#global_filter_order").keyup(function(){
                _this = this;

                $.each($("#table_orders_adm tbody tr"), function() {
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }});
            });
        });
        $('form.search_order_form').on('submit',function(e) {
            e.preventDefault();
        });

        $( "#search_btn_order" ).click(function() {
            $( "#hide_search_order" ).click();
        });
        function download_files(btn) {
            var files = $(btn).attr('data-files').split(',');
            for(var k in files){
               window.open(files[k], '_blank');
            }
        }
        $(document).ready(function() {
            $('#table_orders_adm').DataTable({
                aaSorting: [[6, "asc"]],
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

        function delete_order(id) {
            $.sweetModal.confirm('Are you sure you want to delete this?', function() {
                $.ajax({
                    url: "/api/orders/delete",
                    type: "POST",
                    data: {
                        orders_id: id,
                        token:'{{$token}}'
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        '_token': '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success: function (data) {
		            console.log(data);
                        if (data.success == true) {
                            sweet_modal('Success', 'success', 1000);
                            setTimeout(function () {
                                window.location = '/panel/admin/orders';
                            }, 1000);
                        } else {
                            sweet_modal(data.message, 'error', 1000);
                        }
                        $(".btn_submit").removeAttr('disabled');
                    }, error: function (data) {
                        console.log(data);
                        sweet_modal('Something went wrong', 'error', 1000);
                        $(".btn_submit").removeAttr('disabled');
                    }
                })
            })
        }
        $(document).ready(function () {
            $(".header_text").html('Orders');
        });

        $('th').click(function(){
            var table = $(this).parents('table').eq(0)
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
            this.asc = !this.asc
            if (!this.asc){rows = rows.reverse()}
            for (var i = 0; i < rows.length; i++){table.append(rows[i])}
        });
        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index), valB = getCellValue(b, index)
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
            }
        }
        function getCellValue(row, index){ return $(row).children('td').eq(index).text() }
    </script>
@endsection