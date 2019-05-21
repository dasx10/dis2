@extends('layout.main')
@section('head')
    @include('template.head_template')
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/public/css/jquery.sweet-modal.css">

    <link rel="stylesheet" href="/public/css/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="/public/build/css/intlTelInput.css">
    <style>
.main-content{

  height: auto!important;
}
</style>
@endsection
@section('content')
    <div class="main-content">
    @include('main.header')
    <section>
        <div class="container">
            <div class="row mr-t-b">
                <div class="col-md-12 text-center">
                    <h2 style="font-family: RalewayBold;color:#253756;" class="mr-t-b-sm">CONTACT US</h2>
                    <div style="font-family: RalewayRegular!important;font-size: 1.1rem!important;color:#253756!important;">
                        <?php echo $contact_descr->text?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12" style="background: url(../public/img/bg-map.png);position: relative;background-size: 100% 100%;background-repeat: no-repeat;">
                    <div id="chartdiv" style="margin:0 auto;">
                        {{--<img class="img-fluid" src="{{$contact_descr->src}}" alt="">--}}
                    </div>
                    <div class="legend" style="padding:5px 10px;max-width:130px; width: 100%; height: 100%; max-height: 75px;border:1px solid #888390;color:#fff; border-radius: 3px; position: absolute;background: #888390; bottom: 20px; float: left;">
                        <p class="m-0 text-right"> Offices: <img style="width:35px;" src="../public/img/placeholder (1).svg" alt=""></p>
                        <p class="m-0 text-right"> Markets: <img style="margin: 0 10px;width: 15px;" src="../public/img/markets.svg" alt=""></p>

                    </div>
                </div>
            </div>
            <form class="mr-t-b contact">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="validationDefault01" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" id="phone" placeholder="" required>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" id="validationDefault03" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <select required name="department" class="form-control">
                                <option value="" selected disabled>Select Department</option>
                                <option value="Sales">Sales</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Customer Support">Customer Support</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea required name="message" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Your message here.."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="mr-5">Subject:</label>
                            <div class="custom-control mr-5 custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="subject" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">General Inquiry</label>
                            </div>
                            <div class="custom-control mr-5 custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="subject" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Purchase Order</label>
                            </div>
                            <div class="custom-control mr-5 custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="subject" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline3">Request a Quote</label>
                            </div>
                            {{--<select required name="subject" class="form-control">--}}
                                {{--<option value="" disabled selected>Subject:</option>--}}
                                {{--<option value="General Inquiry">General Inquiry</option>--}}
                                {{--<option value="Purchase Order">Purchase Order</option>--}}
                                {{--<option value="Request a Quote">Request a Quote</option>--}}
                            {{--</select>--}}
                        </div>
                        <div class="row text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-green btn_submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    </div>

@endsection
@section('script')
    @include('template.script_template')
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/continentsLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
    <script src="/public/js/jquery.sweet-modal.js"></script>
    {{--<script src="/public/js/jquery-jvectormap.js"></script>--}}
    {{--<script src="/public/js/jquery-jvectormap-2.0.3.min.js"></script>--}}
    {{--<script src="/public/js/jquery-jvectormap-world-mill.js"></script>--}}
    <script>
        @if (session('status'))
            @if(session('status')=='true')
                sweet_modal('Message sent successfully!','success',2000);
            @else
                sweet_modal('Something went wrong!','error',2000);
            @endif
        @endif


        $('form.contact').on('submit',function(e){
            e.preventDefault();
            $('.sk-circle').css('display','block');
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/contact_send",
                type:"POST",
                data:$(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    $('.sk-circle').css('display','none');
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success!','success',1000);
                        setTimeout(function () {
                            window.location = '/contact';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',3000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    $('.sk-circle').css('display','none');
                    console.log(data);
                    sweet_modal('Something went wrong','error',3000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })

        });

        function sweet_modal(message,icon,timeout) {
            $.sweetModal({
                content: message,
                icon: icon,
                timeout: timeout
            });
        }
        var map = AmCharts.makeChart( "chartdiv", {
            "type": "map",
            "theme": "none",
            "projection": "miller",
            "addClassNames": true,
            "dataProvider": {
                "map": "worldLow",
                "getAreasFromMap": true,
                "areas": [{}],
                "images": [
                        @foreach($markers as $marker)
                        @if($marker->type=='office')
                    {

                        "id": "china",
                        "color": "#b417b3",
                        "latitude": parseFloat('{{$marker->lat}}'),
                        "longitude": parseFloat('{{$marker->lng}}'),
                        // "zoomLevel":1,
                        "imageURL": "/public/img/placeholder (1).svg",
                        "width": 50,
                        "height": 50,
                        customData: "<div class='row'><div class='col-lg-12'><p class='mt-3'><b class='mb-3'>{{$marker->title}}</b><br><br><b>Address:</b> <br>{{$marker->content}}</p></div></div>",
                        "title": "[[customData]]"
                    },
                    @else
        {
                        "id": "china",
                        "color": "#b417b3",
                        "latitude": parseFloat('{{$marker->lat}}'),
                        "longitude": parseFloat('{{$marker->lng}}'),
                        // "zoomLevel":1,
                        "imageURL": "/public/img/markets.svg",
                        "width": 20,
                        "height": 25,
                        customData: "<div class='row'><div class='col-lg-12'><p class='mt-3'><b class='mb-3'>{{$marker->title}}</b><br> {{$marker->content}}</p></div></div>",
                        "title": "[[customData]]"
                    },
                    @endif
                    @endforeach
                ]
            },
            // "valueAxes": [{
            //     "axisAlpha": 0,
            //     "position": "left",
            //     "ignoreAxisWidth": true
            // }],
            // "dragMap": false,
            "areasSettings": {
                "unlistedAreasColor": "#fff",
                "colorSolid":"#fff",
                "color": "#fff",
                "autoZoom": true,
                "outlineColor" : "F2EEFF",
                // "balloonText": "[[customData]]",
                "rollOverColor": "#089282",
                "rollOverOutlineColor": "#089282",
                "selectedColor": "#089282",

            },

            "balloon": {
                "borderThickness": 0,
                "borderAlpha": 0,
                "fillAlpha": 0,
                "horizontalPadding": 0,
                "verticalPadding": 0,
                "shadowAlpha": 0,
                "textAlign": "left"
            },

            // "imagesSettings": {
            //     "color": "#e9e925"
            // }
        });
        map.addListener("clickMapObject", function(event) {
            //more code goes here
            // alert(1);
        });
        // map.areasSettings = {
        //
        // };
        window.onload=function(){
            $('a[href="http://www.amcharts.com/javascript-maps/"]').hide();
            var x = document.querySelectorAll(".amcharts-map-image");
            x.forEach(function(element){
                element.setAttribute('y','-5%')});
        };

    </script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="/public/build/js/intlTelInput.js"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: document.body,
            // excludeCountries: ["us"],
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            // hiddenInput: "full_number",
            // initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            utilsScript: "/public/build/js/utils.js",

        });
    </script>
@endsection
