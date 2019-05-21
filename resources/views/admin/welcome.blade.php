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
                <div class="card-block" style="font-family: RalewayRegular;">
                        @if(in_array($role,['super_admin','sales','opm','customer_service','finance','purchase','admin']))
                            <div>
                        @else
                            <div style="display:none;">
                        @endif
                        <p class="m-0" style="font-size: 1.25rem;font-family: RalewayMedium;">Business volume<p>
                        <hr>
                        <div class="row d-flex  flex-wrap">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 2rem;">
                                <div class="row">
                                    <div class="col d-flex ">
                                        <div class="chart">
                                            <canvas id="BusinessCountry"></canvas>
                                            <span class="chart-text">per <br> Country</span>
                                        </div>
                                        <div class="stats-chart">
                                            @foreach($users_per_country as $key=>$val)
                                                <p><span class="chart-span" style="background: {{$val['color']}};"></span><b class="chart-stats-number">{{$val['count']}}</b> from {{$key}} ({{$val['proc']}}%)</p>
                                            @endforeach
                                            {{--<p><span class="chart-span" style="background: #568fb6;"></span><b class="chart-stats-number">75,312</b> from Canada (25%)</p>--}}
                                            {{--<p><span class="chart-span" style="background: #cdc964;"></span><b class="chart-stats-number">33,312</b> from China (17%)</p>--}}
                                            {{--<p><span class="chart-span" style="background: #6ec174;"></span><b class="chart-stats-number">33,312</b> from Germany (13%)</p>--}}
                                            {{--<p><span class="chart-span" style="background: #4c6897;"></span><b class="chart-stats-number">33,312</b> from Germany (13%)</p>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 2rem;">
                                <div class="row">
                                    <div class="col d-flex ">
                                        <div class="chart">
                                            <canvas id="BusinessClient"></canvas>
                                            <span class="chart-text">per <br> Client</span>
                                        </div>
                                        <div class="stats-chart" style="margin-top: 4.375rem;">
                                            <?php
                                                $i=0;
                                            ?>
                                            @foreach($per_client_arr as $key=>$val)
                                                @if($i==0)
                                                    <p><span class="chart-span" style="background: #5eadce;"></span><b class="chart-stats-number">{{$val['value']}}</b> {{ucfirst($val['type'])}} ({{$val['proc']}}%)</p>
                                                @else
                                                    <p><span class="chart-span" style="background: #4c6897;"></span><b class="chart-stats-number">{{$val['value']}}</b> {{ucfirst($val['type'])}} ({{$val['proc']}}%)</p>
                                                @endif
                                                <?php
                                                    $i++;
                                                ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 2rem;">
                                <div class="row">
                                    <div class="col d-flex ">
                                        <div class="chart">
                                            <canvas id="BusinessBrand"></canvas>
                                            <span class="chart-text">per <br> Brand</span>
                                        </div>
                                        <div class="stats-chart">
                                            @foreach($per_brand_arr as $key=>$item)
                                                <p><span class="chart-span" style="background: {{$item['color']}};"></span><b class="chart-stats-number">{{$item['value']}}</b> from {{$key}}  ({{$item['proc']}}%)</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 2rem;">
                                <div class="row">
                                    <div class="col d-flex ">
                                        <div class="chart">
                                            <canvas id="BusinessPayment"></canvas>
                                            <span class="chart-text">per Payment <br> term</span>
                                        </div>
                                        <div class="stats-chart" style="margin-top: 2.5rem;">
                                            @foreach($per_term_arr as $key=>$item)
                                                <p><span class="chart-span" style="background: {{$item['color']}};"></span><b class="chart-stats-number">{{$item['value']}}</b> from {{$key}} ({{$item['proc']}}%)</p>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 2rem;">
                                <div class="row">
                                    <div class="col d-flex ">
                                        <div class="chart">
                                            <canvas id="BusinessProduct"></canvas>
                                            <span class="chart-text">per <br> Products</span>
                                        </div>
                                        <div class="stats-chart">
                                            @foreach($per_prod_arr as $key=>$item)
                                                <p><span class="chart-span" style="background: {{$item['color']}};"></span><b class="chart-stats-number">{{$item['value']}}</b> from {{$key}} ({{$item['proc']}}%)</p>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(in_array($role,['super_admin','opm','customer_service','finance','purchase','admin','sales']))
                        <div>
                    @else
                        <div style="display: none">
                    @endif
                        <p class="m-0" style="font-size: 1.25rem;font-family: RalewayMedium;">Number of Shipments<p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 2rem;">
                                <div class="row">
                                    <div class="col d-flex ">
                                        <div class="chart">
                                            <canvas id="ShipmentsCountry"></canvas>
                                            <span class="chart-text">per <br> Country</span>

                                        </div>
                                        <div class="stats-chart">
                                            @foreach($per_country_ship_arr as $key=>$item)
                                                <p><span class="chart-span" style="background: {{$item['color']}};"></span><b class="chart-stats-number">{{$item['value']}}</b> from {{$key}} ({{$item['proc']}}%)</p>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 2rem;">
                                <div class="row">
                                    <div class="col d-flex ">
                                        <div class="chart">
                                            <canvas id="ShipmentsRegion"></canvas>
                                            <span class="chart-text">per <br> Region</span>
                                        </div>
                                        <div class="stats-chart">
                                            @foreach($per_regione_ship_arr as $key=>$item)
                                                <p><span class="chart-span" style="background: {{$item['color']}};"></span><b class="chart-stats-number">{{$item['value']}}</b> from {{$key}} ({{$item['proc']}}%)</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 2rem;">
                                <div class="row">
                                    <div class="col d-flex ">
                                        <div class="chart">
                                            <canvas id="ShipmentsProduct"></canvas>
                                            <span class="chart-text">per <br> Products</span>
                                        </div>
                                        <div class="stats-chart">
                                            @foreach($per_prod_arr as $key=>$item)
                                                <p><span class="chart-span" style="background: {{$item['color']}};"></span><b class="chart-stats-number">{{$item['value']}}</b> from {{$key}} ({{$item['proc']}}%)</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>


                    @if(in_array($role,['super_admin','purchase','finance','opm','customer_service','sales','admin']))
                        <div class="row">
                    @else
                        <div class="row" style="display: none">
                    @endif
                        <div class="col-12 col-xl-2 total-block">
                            <p><b class="total">Total Visitors:</b> {{$visitors}}</p>
                                <p><b class="total">Total Buyers:</b> {{$users_count}}</p>
                                <p><b class="total">Total Sum:</b> USD {{$total_sum}}</p>
                                <p><b class="total">Total Products:</b> {{$total_prod}}</p>
                                <p><b class="total">Total Orders:</b> {{$total_orders}}</p>
                                <p><b class="total">Total Documents:</b> {{$doc_count}}</p>



                        </div>
                        <div class="col-12 col-lg-12 col-xl-10">
                                <div id="chartContainer" style="height:250px;">
                                </div>
                                <span class="hide_text"></span>
                    </div>
                    </div>

            </div>
        </div>
    </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="/public/js/canvas.js"></script>
    {{--<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
    <script>

        // google.charts.load('current', {'packages':['corechart']});
        // google.charts.setOnLoadCallback(drawChart);
        //
        // function drawChart() {
        //     var dataTable = new google.visualization.DataTable();
        //     dataTable.addColumn('string', 'Client');
        //     dataTable.addColumn('number', 'Money');
        //     dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
        //     dataTable.addRows([
        //         ['Client 1', 7500, '<div><b>Client One</b><br>USD <strong>7500</strong><br><p>1 Shipment</p></div>'],
        //         ['Client 2', 7500, '<div><b>Client Two</b><br>USD <strong>7500</strong><br><p>1 Shipment</p></div>'],
        //         ['Client 3', 7500, '<div><b>Client Thre</b><br>USD <strong>7500</strong><br><p>1 Shipment</p></div>'],
        //         ['Client 4', 7300, '<div><b>Client Four</b><br>USD <strong>7300</strong> <p>1 Shipment</p></div>'],
        //         ['Client 5', 7200, '<div><b>Client Five</b><br>USD <strong>7200</strong><br>105 Shipment</div>'],
        //         ['Client 6', 7280, '<div><b>Client Six</b><br>USD <strong>7280</strong><br>105 Shipment</div>'],
        //         ['Client 7', 5200, '<div><b>Client Seven </b><br>USD <strong>5200</strong><br>105 Shipment</div>'],
        //         ['Client 8', 5180, '<div><b>Client Eight   </b><br>USD <strong>5180</strong><br>105 Shipment</div>'],
        //         ['Client 9', 5200, '<div><b>Client Nine</b><br>USD <strong>5200</strong><br>105 Shipment</div>'],
        //         ['Client 10', 5200, '<div><b>Client Ten</b><br>USD <strong>5200</strong><br>105 Shipment</div>'],
        //         ['Client 11', 5200, '<div><b>Client Eleven</b><br>USD <strong>5200</strong><br>105 Shipment</div>'],
        //         ['Client 12', 5200, '<div><b>Client Twelve</b><br>USD <strong>5200</strong><br>105 Shipment</div>'],
        //         ['Client 13', 5200, '<div><b>Client Thirteen</b><br>USD <strong>5200</strong><br>105 Shipment</div>'],
        //         ['Client 14', 4200, '<div><b>Client Fourteen</b><br>USD <strong>4200</strong><br>105 Shipment</div>'],
        //         ['Client 15', 4200, '<div><b>Client Fifteen</b><br>USD <strong>4200</strong><br>105 Shipment</div>'],
        //         ['Client 16', 4200, '<div><b>Client Sixteen</b><br>USD <strong>4200</strong><br>105 Shipment</div>'],
        //         ['Client 17', 4200, '<div><b>Client Seventeen</b><br>USD <strong>4200</strong><br>105 Shipment</div>'],
        //         ['Client 18', 4200, '<div><b>Client Eighteen</b><br>USD <strong>4200</strong><br>105 Shipment</div>'],
        //         ['Client 19', 4200, '<div><b>Client Nineteen</b><br>USD <strong>4200</strong><br>105 Shipment</div>'],
        //         ['Client 20', 3000, '<div><b>Client Twenty </b><br>USD <strong>3000</strong><br>105 Shipment</div>'],
        //         ['Client 21', 3000, '<div><b>Client Twenty One</b><br>USD <strong>3000</strong><br>105 Shipment</div>'],
        //         ['Client 22', 3200, '<div><b>Client Twenty Two</b><br>USD <strong>3200</strong><br>105 Shipment</div>'],
        //         ['Client 23', 3200, '<div><b>Client Twenty Three</b><br>USD <strong>3200</strong><br>105 Shipment</div>'],
        //         ['Client 24', 3200, '<div><b>Client Twenty Four</b><br>USD <strong>3200</strong><br>105 Shipment</div>'],
        //         ['Client 25', 3200, '<div><b>Client Twenty Five</b><br>USD <strong>3200</strong><br>105 Shipment</div>'],
        //         ['Client 26', 3200, '<div><b>Client Twenty Six</b><br>USD <strong>3200</strong><br>105 Shipment</div>'],
        //         ['Client 27', 2200, '<div><b>Client Twenty Seven</b><br>USD <strong>2200</strong><br>105 Shipment</div>'],
        //         ['Client 28', 2200, '<div><b>Client Twenty Eight </b><br>USD <strong>2200</strong><br>105 Shipment</div>'],
        //         ['Client 29', 2200, '<div><b>Client Twenty Nine</b><br>USD <strong>2200</strong><br>105 Shipment</div>'],
        //         ['Client 30', 2200, '<div><b>Client Thirty </b><br>USD <strong>2200</strong><br><span>105 Shipment</span></div>']
        //
        //     ]);
        // //
        //     var options = {
        //         tooltip: {isHtml: true},
        //         hAxis : {
        //             textStyle : {
        //                 fontSize: 9 // or the number you want
        //             }
        //
        //         },
        //         vAxis : {
        //             textStyle : {
        //                 fontSize: 9 // or the number you want
        //             }
        //         },
        //         legend:'none',
        //         colors: ['#6ec174']
        //     };
        //     var chart = new google.visualization.ColumnChart (document.getElementById('tooltip_action'));
        //     chart.draw(dataTable, options);
        // }


        window.onload = function () {
            CanvasJS.addColorSet("myColor",
                [//colorSet Array

                    "rgba(110,	193,	116, 0.9)"

                ]);

            var chart = new CanvasJS.Chart("chartContainer",
                {
                    toolTip: {
                        fontColor: "#44484c",
                        content: "<span style='\"'margin-left:0.8rem;color:black;'\"'>" + "{label}</span>" +
                        "<br/> " +
                        "<span style='\"'margin-left:0.8rem;'\"'>" + "USD <b style='\"'color: black;'\"'>{y}</b>" + "</span>  " +
                        "<br/> " +
                        "<span style='\"'margin-left:0.8rem;'\"'>{s} Shipment</span>",
                        borderColor:"#c6c6c6"

                    },
                    axisX:{
                        interval: 1,
                        lineDashType: "dash",
                        labelAngle: 0
                    },
                    axisY:{
                        lineThickness:0,
                        gridDashType: "dash"
                    },
                    colorSet: "myColor",
                    data: [
                        {
                            type: "column",
                            indexLabelFontColor: "#6ec174",
                            dataPoints: [
                                @foreach($users_data  as $user)
                                    { s:"{{$user->count_orders}}",label: "{{$user->contact_name}}", y: parseInt("{{$user->total_sum}}",10) ,indexLabel: "{{$user->total_sum}}" },
                                @endforeach

                            ]
                        }
                    ]
                });


            chart.render();
        }


        // window.onload = function () {
        //     var chart = new CanvasJS.Chart("chartContainer",{
        //         data: [
        //             {
        //                 type: "column",
        //                 showInLegend: true,
        //                 //axisYIndex: 0, //Defaults to Zero
        //                 name: "Axis Y-1",
        //                 xValueFormatString: "####",
        //                 dataPoints: [
        //                     { x: 2006, y: 6 },
        //                     { x: 2007, y: 2 },
        //                     { x: 2008, y: 5 },
        //                     { x: 2009, y: 7 },
        //                     { x: 2010, y: 1 },
        //                     { x: 2011, y: 5 },
        //                     { x: 2012, y: 5 },
        //                     { x: 2013, y: 2 },
        //                     { x: 2014, y: 2 }
        //                 ]
        //             },
        //             {
        //                 type: "column",
        //                 showInLegend: true,
        //                 //axisYIndex: 0, //Defaults to Zero
        //                 name: "Axis Y2-1",
        //                 xValueFormatString: "####",
        //                 dataPoints: [
        //                     { x: 2006, y: 12 },
        //                     { x: 2007, y: 20 },
        //                     { x: 2008, y: 28 },
        //                     { x: 2009, y: 34 },
        //                     { x: 2010, y: 24 },
        //                     { x: 2011, y: 45 },
        //                     { x: 2012, y: 15 },
        //                     { x: 2013, y: 34 },
        //                     { x: 2014, y: 22 }
        //                 ]
        //             },
        //         ]
        //     });
        //
        //     chart.render();
        // }



        $(document).ready(function () {
            $(".header_text").html('Dashboard');
        });

//---------------------------------- Chart ---- BusinessCountry  ------------------------------------

        //Per Country
        var config = {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [
                        @foreach($users_per_country as $val)
                            '{{$val['count']}}',
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach($users_per_country as $key=>$val)
                            "{{$val['color']}}",
                        @endforeach
                    ]
                }]
            },
            options: {
                responsive:true,
                tooltips: {enabled: false},
                hover: {mode: null},
                cutoutPercentage:80,
                elements: {
                    arc: {
                        borderWidth: 0
                    },
                    cutoutPercentage:70,
                    center: {
                        text: 'per Country',
                        color: 'black',
                        fontStyle: 'Arial',
                        sidePadding: 40
                    }
                }
            }
        };
        var ctx = document.getElementById("BusinessCountry").getContext("2d");
        var BusinessCountry = new Chart(ctx, config);



        //---------------------------------- Chart ---- BusinessClient  ------------------------------------

        //Per Client
        var config = {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [
                        @foreach($per_client_arr as $key=>$val)
                            {{$val['value']}},
                        @endforeach
                    ],
                    backgroundColor: [
                        "#5eadce",
                        "#4c6897"
                    ]
                }]
            },
            options: {
                responsive:true,
                tooltips: {enabled: false},
                hover: {mode: null},
                cutoutPercentage:80,
                elements: {
                    arc: {
                        borderWidth: 0
                    },
                    cutoutPercentage:70,
                    center: {
                        text: 'per Client',
                        color: 'black',
                        fontStyle: 'Arial',
                        sidePadding: 40
                    }
                }
            }
        };


        var ctx = document.getElementById("BusinessClient").getContext("2d");
        var BusinessClient = new Chart(ctx, config);

        //---------------------------------- Chart ---- BusinessBrand  ------------------------------------

        //Per Brand
        var config = {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [
                        @foreach($per_brand_arr as $key=>$item)
                            '{{$item['value']}}',
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach($per_brand_arr as $key=>$item)
                            '{{$item['color']}}',
                        @endforeach
                    ]
                }]
            },
            options: {
                responsive:true,
                tooltips: {enabled: false},
                hover: {mode: null},
                cutoutPercentage:80,
                elements: {
                    arc: {
                        borderWidth: 0
                    },
                    cutoutPercentage:70,
                    center: {
                        text: 'per Brand',
                        color: 'black',
                        fontStyle: 'Arial',
                        sidePadding: 40
                    }
                }
            }
        };


        var ctx = document.getElementById("BusinessBrand").getContext("2d");
        var BusinessBrand = new Chart(ctx, config);


        //---------------------------------- Chart ---- BusinessPayment  ------------------------------------
        //Per Payment Term
        var config = {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [
                        @foreach($per_term_arr as $key=>$item)
                            '{{$item['value']}}',
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach($per_term_arr as $key=>$item)
                            '{{$item['color']}}',
                        @endforeach
                    ]
                }]
            },
            options: {
                responsive:true,
                tooltips: {enabled: false},
                hover: {mode: null},
                cutoutPercentage:80,
                elements: {
                    arc: {
                        borderWidth: 0
                    },
                    cutoutPercentage:70,
                    center: {
                        text: 'per Payment term',
                        color: 'black',
                        fontStyle: 'Arial',
                        sidePadding: 40
                    }
                }
            }
        };


        var ctx = document.getElementById("BusinessPayment").getContext("2d");
        var BusinessPayment = new Chart(ctx, config);



        //---------------------------------- Chart ---- BusinessProduct  ------------------------------------

        //Per Products
        var config = {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [
                        @foreach($per_prod_arr as $key=>$item)
                        '{{$item['value']}}',
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach($per_prod_arr as $key=>$item)
                            '{{$item['color']}}',
                        @endforeach
                    ]
                }]
            },
            options: {
                responsive:true,
                tooltips: {enabled: false},
                hover: {mode: null},
                cutoutPercentage:80,
                elements: {
                    arc: {
                        borderWidth: 0
                    },
                    cutoutPercentage:70,
                    center: {
                        text: 'per Product',
                        color: 'black',
                        fontStyle: 'Arial',
                        sidePadding: 40
                    }
                }
            }
        };


        var ctx = document.getElementById("BusinessProduct").getContext("2d");
        var BusinessProduct = new Chart(ctx, config);


        //---------------------------------- Chart ---- ShipmentsCountry  ------------------------------------
        //Ship per country
        var config = {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [
                        @foreach($per_country_ship_arr as $key=>$item)
                            '{{$item['value']}}',
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach($per_country_ship_arr as $key=>$item)
                            '{{$item['color']}}',
                        @endforeach
                    ]
                }]
            },
            options: {
                responsive:true,
                tooltips: {enabled: false},
                hover: {mode: null},
                cutoutPercentage:80,
                elements: {
                    arc: {
                        borderWidth: 0
                    },
                    cutoutPercentage:70,
                    center: {
                        text: 'per Country',
                        color: 'black',
                        fontStyle: 'Arial',
                        sidePadding: 40
                    }
                }
            }
        };


        var ctx = document.getElementById("ShipmentsCountry").getContext("2d");
        var ShipmentsCountry = new Chart(ctx, config);


        //---------------------------------- Chart ---- ShipmentsRegion  ------------------------------------
        var config = {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [
                        @foreach($per_regione_ship_arr as $key=>$item)
                            '{{$item['value']}}',
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach($per_regione_ship_arr as $key=>$item)
                            '{{$item['color']}}',
                        @endforeach
                    ]
                }]
            },
            options: {
                responsive:true,
                tooltips: {enabled: false},
                hover: {mode: null},
                cutoutPercentage:80,
                elements: {
                    arc: {
                        borderWidth: 0
                    },
                    cutoutPercentage:70,
                    center: {
                        text: 'per Region',
                        color: 'black',
                        fontStyle: 'Arial',
                        sidePadding: 40
                    }
                }
            }
        };


        var ctx = document.getElementById("ShipmentsRegion").getContext("2d");
        var ShipmentsRegion = new Chart(ctx, config);


        //---------------------------------- Chart ---- ShipmentsProduct  ------------------------------------
        //123123
        var config = {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [
                        @foreach($per_prod_arr as $key=>$item)
                            '{{$item['value']}}',
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach($per_prod_arr as $key=>$item)
                            '{{$item['color']}}',
                        @endforeach
                    ]
                }]
            },
            options: {
                responsive:true,
                tooltips: {enabled: false},
                hover: {mode: null},
                cutoutPercentage:80,
                elements: {
                    arc: {
                        borderWidth: 0
                    },
                    cutoutPercentage:70,
                    center: {
                        text: 'per Product',
                        color: 'black',
                        fontStyle: 'Arial',
                        sidePadding: 40
                    }
                }
            }
        };


        var ctx = document.getElementById("ShipmentsProduct").getContext("2d");
        var ShipmentsProduct = new Chart(ctx, config);





        // var ctx = document.getElementById("ChartClients").getContext('2d');
        // var Chart_clients = new Chart(ctx, {
        //     type: 'bar',
        //     data: {
        //         labels: ["Client 1", "Client 2", "Client 3", "Client 4", "Client 5", "Client 6","Client 7", "Client 8", "Client 9", "Client 10", "Client 11","Client 12", "Client 13", "Client 14", "Client 15", "Client 16","Client 17", "Client 18", "Client 19","Client 20", "Client 21", "Client 22","Client 23", "Client 24", "Client 25", "Client 26", "Client 27","Client 28", "Client 29", "Client 30"],
        //         datasets: [{
        //
        //             label: [],
        //             data: [7500 , 7499, 7450 , 7440 ,7380, 6470,7500 , 7499, 7450 , 7440 ,7380,7500 , 7499, 7450 , 7440 ,7380,7500 , 7499, 7450 , 7440 ,7380,7500 , 7499, 7450 , 7440 ,7380,7500 , 7499, 7450 , 7440],
        //             backgroundColor: [
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)",
        //                 "rgb(110,	193,	116, 0.8)"
        //
        //
        //             ]
        //         }]
        //     },
        //     options: {
        //         responsive:false,
        //         hover: {mode: null},
        //         tooltips: {
        //             caretSize:8,
        //             yAlign: 'bottom',
        //             xAlign: 'center',
        //             cornerRadius:2,
        //             displayColors:false,
        //             xPadding: 20,
        //             backgroundColor:'white',
        //             titleFontColor:'black',
        //             bodyFontColor:'black',
        //             borderColor:'#c6c6c6',
        //             borderWidth:1,
        //             callbacks: {
        //
        //                 label: function(tooltipItem){
        //
        //                     return 'USD ' + tooltipItem.yLabel ;
        //                 },
        //                 afterLabel:function(tooltipItem){
        //                     return '115 ' + 'Shipments' ;
        //                 }
        //             }
        //
        //         },
        //         legend:false,
        //         scales: {
        //             yAxes: [{
        //                 gridLines: {
        //                     borderDash: [6, 5],
        //                     color: "#cccccc"
        //                 },
        //                 ticks: {
        //                     beginAtZero:true
        //                 }
        //             }],
        //             xAxes : [ {
        //                 gridLines : {
        //                     display : 0
        //                 }
        //
        //             } ]
        //         }
        //     }
        // });
    </script>
@endsection