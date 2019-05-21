@extends('layout.main')
@section('head')
    @include('template.head_template')
    <link rel="stylesheet" href="/public/css/jquery.sweet-modal.css">
    <link rel="stylesheet" href="/public/css/intlTelInput.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
@endsection
@section('content')
    @include('main.header')
    <section class="main-content">
        <div class="container">
            <div class="row text-center p-t-b  " style="padding-bottom: 5rem;">
                <div class="col-md-12 mr-t-b text-center" style="margin-bottom: 1rem;">
                    <h2 style="font-family: RalewayBold;color: #253756;">JOIN US</h2>
                </div>
                <div class="card" style="box-shadow: 0px 0px 50px -8px rgba(0,0,0,0.75); border-radius: 10px; max-width: 900px;margin: 0 auto;">

                    <div class="col-lg-12">
                        <div class="row" style="margin-right: -15px!important; margin-left: -15px!important;">
                            <div class="col-lg-4" style="background-color: #f7f7f7; border-top-left-radius: 10px;">
                                <div class="card-body text-left" style="padding: 3rem 1.25rem 1rem 1.25rem;">
                                        @switch($_GET['join-type'])
                                            @case('1')
                                            <p class="text-center" style="color: #253756; font-family: RalewayMedium; font-size: 18px;">BUY FROM US</p>
                                        <p style="font-family: RalewayLight;color: #334461;">D.I.S. is dedicated to providing its customers with a competitive quality to price, consistency of supply, tailored and good quality packaging. It also developed efficient delivery systems to align with your business & Market needs. We welcome your inquiries, questions or orders. You may choose to fill this form and have one of our team members get back to you or simply register online as a buyer and benefit from our rewards program and features such as tracking your orders, access your order’s archived documents.</p>
                                            @break

                                            @case('2')
                                        <p class="text-center" style="color: #253756; font-family: RalewayMedium; font-size: 18px;">PARTNER WITH US</p>
                                        <p style="font-family: RalewayLight;color: #334461;">D.I.S. knowledge of cultures and business practices, combined with market connections a developed image, will provide your business with more opportunities. D.I.S. is also open to new products that fit its industries and open up new markets. We welcome your partnership as a product or service supplier because union makes us stronger. You may choose to fill this form and have one of our team members get back to you or simply send us an
                                            <a href="mailto:info@dis-company.com">email</a></p>
                                            @break

                                            @case('3')
                                        <p class="text-center" style="color: #253756; font-family: RalewayMedium; font-size: 18px;">JOIN OUR TEAM</p>
                                        <p style="font-family: RalewayLight;color: #334461;">If you are a person who wants to be a positive force and develop professionally, D.I.S. is a constantly growing company and can offer you a lot of opportunities for skill set expansion and stepping outside your comfort zone thanks to its exciting and solid work environment. D.I.S. offers its employees the chance to wear different hats, giving them the opportunity to expend their skill set and knowledge. You’ll be highly welcomed to bring in your ideas and take initiative. Your desire to innovate and experiment will always be encouraged. You’ll work with highly committed colleagues and passionate about what they do. Our team is very proud of our brands & products and is ready to go beyond what is needed to contribute to the company’s success. Send us an <a href="mailto:info@dis-company.com">email</a> or drop your CV directly along with this form.</p>
                                            @break

                                            @default()
                                        <p class="text-center" style="color: #253756; font-family: RalewayMedium; font-size: 18px;">BUY FROM US</p>
                                        <p style="font-family: RalewayLight;color: #334461;"> D.I.S. is dedicated to providing its customers with a competitive quality to price, consistency of supply, tailored and good quality packaging. It also developed efficient delivery systems to align with your business & Market needs. We welcome your inquiries, questions or orders. You may choose to fill this form and have one of our team members get back to you or simply register online as a buyer and benefit from our rewards program and features such as tracking your orders, access your order’s archived documents.</p>
                                            @break
                                        @endswitch
                                </div>
                            </div>
                            <form class="contact" style="display: contents">
                                @switch($_GET['join-type'])
                                    @case('1')
                                <div class="col-lg-4">
                                    <div class="card-body" style="padding: 3rem 1.25rem 1rem 1.25rem;">
                                        <label class="sr-only" for="validationCustom02">*Company Name </label>
                                        <div class="form-group">
                                            <input style="height:39.5px; " type="text" name="company_name" class="form-control" id="validationCustom02" placeholder="*Company Name" required>
                                        </div>
                                        <label class="sr-only" for="validationCustom03">*Contact Name </label>
                                        <div class="form-group">
                                            <input style="height:39.5px; " type="text" name="contact_name" class="form-control" id="validationCustom03" placeholder="*Contact Name" required>
                                        </div>
                                        <label class="sr-only" for="validationCustom04">*Email </label>
                                        <div class="form-group">
                                            <input style="height:39.5px;" type="email" name="email" class="form-control" id="validationCustom04" placeholder="*Email" required>
                                        </div>
                                        <label class="sr-only" for="validationCustom05">*Country </label>
                                        <div class="form-group">
                                            <select id="address-country-2" name="country" class="form-control dropdown-edit mb-3" style="height: 39.5px;"required>
                                        </div>
                                        <label class="sr-only" for="validationCustom06">*Telephone </label>
                                        <div class="form-group">
                                            <input style="padding:.375rem .75rem;width:100%;height: 39.5px;border: 1px solid #ced4da;color: #878c92!important; border-bottom-right-radius: .25rem;border-top-right-radius: .25rem;" type="tel" name="phone_number" class="" id="phone-2" required>
                                        </div>
                                        <p class="text-left" style="margin-bottom: 2.3rem; color:red;">*required fields</p>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-body" style="padding: 3rem 1.25rem 1rem 1.25rem;">
                                        <label class="sr-only" for="validationCustom08">Position </label>
                                        <div class="form-group">
                                            <input style="height:39.5px; " type="text" class="form-control" name="position" id="validationCustom08" placeholder="Position">
                                        </div>
                                        <label class="sr-only" for="validationCustom09">Company website</label>
                                        <div class="form-group">
                                            <input style="height:39.5px; " type="text" class="form-control" name="company_website" id="validationCustom09" placeholder="Company website">
                                        </div>
                                        <label class="sr-only" for="validationCustom010">Industry</label>
                                        <div class="form-group">
                                            <select name="business_scope" class="form-control form-select dropdown-edit" style="height: 39.5px;" required>
                                                <option value="">*Type of business</option>
                                                <option value="End user / Manufacturer">End user / Manufacturer</option>
                                                <option value="Importer / Distributor">Importer / Distributor</option>
                                                <option value="Trader">Trader </option>
                                                <option value="Agent / Professional service provider">Agent / Professional service provider</option>
                                            </select>
                                        </div>
                                        <label class="sr-only" for="validationCustom07">*Inquiry </label>
                                        <div class="form-group">
                                            <textarea cols="5" rows="6" type="text" name="inquiry" class="form-control" id="validationCustom07" placeholder="*Inquiry" required></textarea>
                                        </div>


                                    </div>
                                </div>
                                    @break
                                    @case('2')
                                    <div class="col-lg-4">
                                        <div class="card-body" style="padding: 3rem 1.25rem 1rem 1.25rem;">
                                            <label class="sr-only" for="validationCustom02">*Company Name </label>
                                            <div class="form-group">
                                                <input style="height:39.5px; " type="text" name="company_name" class="form-control" id="validationCustom02" placeholder="*Company Name" required>
                                            </div>
                                            <label class="sr-only" for="validationCustom03">*Contact Name </label>
                                            <div class="form-group">
                                                <input style="height:39.5px; " type="text" name="contact_name" class="form-control" id="validationCustom03" placeholder="*Contact Name" required>
                                            </div>
                                            <label class="sr-only" for="validationCustom04">*Email </label>
                                            <div class="form-group">
                                                <input style="height:39.5px;" type="email" name="email" class="form-control" id="validationCustom04" placeholder="*Email" required>
                                            </div>
                                            <label class="sr-only" for="validationCustom05">*Country </label>
                                            <div class="form-group">
                                                <select id="address-country-2" name="country" class="form-control dropdown-edit mb-3" style="height: 39.5px;"required>
                                            </div>
                                            <label class="sr-only" for="validationCustom06">*Telephone </label>
                                            <div class="form-group">
                                                <input style="padding:.375rem .75rem;width:100%;height: 39.5px;border: 1px solid #ced4da;color: #878c92!important; border-bottom-right-radius: .25rem;border-top-right-radius: .25rem;" type="tel" name="phone_number" class="" id="phone-2" required>
                                            </div>
                                            <p class="text-left" style="margin-bottom: 2.3rem; color:red;">*required fields</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-body" style="padding: 3rem 1.25rem 1rem 1.25rem;">
                                            <label class="sr-only" for="validationCustom08">Position </label>
                                            <div class="form-group">
                                                <input style="height:39.5px; " type="text" class="form-control" name="position" id="validationCustom08" placeholder="Position">
                                            </div>
                                            <label class="sr-only" for="validationCustom09">Company website</label>
                                            <div class="form-group">
                                                <input style="height:39.5px; " type="text" class="form-control" name="company_website" id="validationCustom09" placeholder="Company website">
                                            </div>
                                            <label class="sr-only" for="validationCustom010">Industry</label>
                                            <div class="form-group">
                                                <select name="business_scope" class="form-control form-select dropdown-edit" style="height: 39.5px;" required>
                                                    <option value="">*Type of business</option>
                                                    <option value="End user / Manufacturer">End user / Manufacturer</option>
                                                    <option value="Importer / Distributor">Importer / Distributor</option>
                                                    <option value="Trader">Trader </option>
                                                    <option value="Agent / Professional service provider">Agent / Professional service provider</option>
                                            </div>
                                            <label class="sr-only" for="validationCustom07">*Inquiry </label>
                                            <div class="form-group">
                                                <textarea cols="5" rows="6" type="text" name="inquiry" class="form-control" id="validationCustom07" placeholder="*Inquiry" required></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    @break
                                    @case('3')
                                    <div class="col-lg-4">
                                        <div class="card-body" style="padding: 3rem 1.25rem 1rem 1.25rem;">
                                            <label class="sr-only" for="validationCustom03">Name</label>
                                            <div class="form-group">
                                                <input style="height:39.5px; " type="text" name="contact_name" class="form-control" id="validationCustom03" placeholder="Name" required>
                                            </div>
                                            <label class="sr-only" for="validationCustom03">Surname</label>
                                            <div class="form-group">
                                                <input style="height:39.5px; " type="text" name="surname" class="form-control" id="validationCustom03" placeholder="Surname" required>
                                            </div>
                                            <label class="sr-only" for="validationCustom05">*Country </label>
                                            <div class="form-group">
                                                <select id="address-country-2" name="country" class="form-control dropdown-edit mb-3" style="height: 39.5px;"required>
                                            </div>
                                            <label class="sr-only" for="validationCustom06">*Telephone </label>
                                            <div class="form-group">
                                                <input style="padding:.375rem .75rem;width:100%;height: 39.5px;border: 1px solid #ced4da;color: #878c92!important; border-bottom-right-radius: .25rem;border-top-right-radius: .25rem;" type="tel" name="phone_number" class="" id="phone-2" required>
                                            </div>
                                            <p class="text-left" style="margin-bottom: 2.3rem; color:red;">*required fields</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-body" style="padding: 3rem 1.25rem 1rem 1.25rem;">
                                            <label class="sr-only" for="validationCustom04">*Email </label>
                                            <div class="form-group">
                                                <input style="height:39.5px;" type="email" name="email" class="form-control" id="validationCustom04" placeholder="*Email" required>
                                            </div>
                                            <div class="form-group">
                                            <div class="custom-file">
                                                <input style="height: 39.5px;" type="file" name="file" class="custom-file-input form-control" id="customFile">
                                                <label class="custom-file-label" for="customFile">*Upload CV</label>
                                            </div>
                                        </div>
                                            <label class="sr-only" for="validationCustom07">*Write about yourself </label>
                                            <div class="form-group">
                                                <textarea cols="5" rows="6" type="text" name="inquiry" class="form-control" id="validationCustom07" placeholder="*Write about yourself" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                @endswitch
                                <div class="col-lg-4" style="background-color: #f7f7f7; border-bottom-left-radius: 10px;"></div>
                                <div class="col-lg-8 text-center mb-5">
                                    <button type="submit" style="font-family: RalewayLight;padding: 0.35rem 5.625rem;color: #fff;background-color:#56be60;border-color: #56be60; border-bottom: 2px solid #4ca754;cursor: pointer;" class="btn btn-warning align-self-end btn_submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    @include('template.script_template')
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="/public/js/intlTelInput.js"></script>
    <script src="/public/js/jquery.sweet-modal.js"></script>
    <script>
        $('form.contact').on('submit',function(e){
            e.preventDefault();
            $('.sk-circle').css('display','block');
            $(".btn_submit").attr('disabled','disabled');
            var form = $('form.contact')[0];
            var formData = new FormData(form);
            $.ajax({
                url:"/api/join_send",
                type:"POST",
                contentType: false,
                processData: false,
                data:formData,
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
                            window.location = '/join-popup?join-type={{$_GET['join-type']}}';
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

        var countryData = $.fn.intlTelInput.getCountryData(),
            telInput = $("#phone-2"),
            addressDropdown = $("#address-country-2");

        // init plugin
        telInput.intlTelInput();

        // populate the country dropdown
        $.each(countryData, function(i, country) {
            addressDropdown.append($("<option></option>").attr("value", country.iso2).text(country.name));
        });

        // listen to the telephone input for changes
        telInput.change(function() {
            var countryCode = telInput.intlTelInput("getSelectedCountryData").iso2;
            addressDropdown.val(countryCode);
        });

        // trigger a fake "change" event now, to trigger an initial sync
        telInput.change();

        // listen to the address dropdown for changes
        addressDropdown.change(function() {
            var countryCode = $(this).val();
            telInput.intlTelInput("selectCountry", countryCode);
        });
    </script>
@endsection