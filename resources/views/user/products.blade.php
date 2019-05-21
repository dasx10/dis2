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
                                <form class="search_prod_class">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-4">
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <input style="outline: none!important;box-shadow: none!important;z-index:0!important;" type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Search in product ">
                                                <div style="padding: 0rem 0.5rem;" class="input-group-addon"><img class="img-fluid" src="/public/img/search-logo.png" alt=""></div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                                <table class="table table-responsive table-striped" id="table_products">
                                    <thead style="font-size:1.2rem;">
                                    <tr style="font-family:RalewaySemiBold;">
                                        <th style="width:177px" scope="col">Product</th>
                                        <th style="width:198px" scope="col">Know more</th>
                                        <th style="width:180px" scope="col">TDS</th>
                                        <th style="width:180px" scope="col">MSDS</th>
                                        <th style="width:222px" scope="col">Brand</th>
                                        {{--<th style="width:150px" scope="col">Unit</th>--}}
                                        {{--<th style="width:150px" scope="col">MOQ</th>--}}
                                        {{--<th style="width:289px" scope="col">Packaging</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <th class="prod_search" style="padding: 1rem!important;" scope="row">{{$product->product_name}}</th>
                                            <td class="special_color"><u><a class="special_color" href="/panel/user/products/overview/{{$product->id}}">Know more</a></u></td>
                                            @if(!empty($product->tds))
                                                <td class="special_color"><a style="color: #7086ac!important;" href="{{$product->tds}}" download="$product->tds">TDS</a></td>
                                            @else
                                                <td>TDS</td>
                                            @endif
                                            @if(!empty($product->msds))
                                                <td class="special_color"><a style="color: #7086ac!important;" href="{{$product->msds}}" download="$product->tds">MSDS</a></td>
                                            @else
                                                <td>MSDS</td>
                                            @endif
                                            <th style="padding: 1rem!important;">{{$product->brand}}</th>
                                            {{--<td>MT</td>--}}
                                            {{--<th style="padding: 1rem!important;">{{$product->quantity_min}}</th>--}}
                                            {{--<td>{{$product->type_of_packaging}}</td>--}}
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
        var table;
        // var table = $('#table_products').DataTable();
        $(document).ready(function() {
            table = $('#table_products').DataTable({
                "language": {
                    "zeroRecords": "There are no products to list",
                    "paginate": {
                        "next": ">",
                        "previous": "<"
                    }
                },
                "lengthMenu": [20],
                "pagingType": "simple_numbers"
            });
        } );
        $("#inlineFormInputGroupUsername2").on('keyup', function() {
            table.column([0]).search($(this).val()).draw();
        });

    </script>
@endsection
