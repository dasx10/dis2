@extends('layout.main')
@section('head')
	@include('template.head_template')
	<link rel="stylesheet" href="/public/css/intlTelInput.css">
@endsection
@section('content')
	<div class="main-content">
		@include('main.header')
		<section id="register">
			{{--<div class=" alert alert-cookies alert-dismissible fade show  bg-primary-dark" role="alert">--}}
			{{--<div class="row container m-auto">--}}
			{{--<div class="col-1">--}}
			{{--<img src="/public/img/cookies.png" alt="">--}}
			{{--</div>--}}
			{{--<div class="col-9 text-white">--}}
			{{--<p>This website use cookies. Fore the best possible web experience, please provide your --}}
			{{--authorization to use our cookies and to permanently remove this message.</p>--}}
			{{--</div>--}}
			{{--<div class="col-2 text-center">--}}
			{{--<button class="accept-close btn" data-dismiss="alert" aria-label="Close">Accept & Close </button>--}}
			{{--<a class="more-info" href="#" role="button"> More info </a>--}}
			{{--</div>--}}
			{{--</div>--}}


			{{--</div>--}}
			<div class="container">
				<div class="row mr-t-b">
					<div class="card m-auto" style="width: 50rem">

						<div class="card-body text-center">
							<div class="row">
								<div class="col-lg-12">
									<p style="font-family: RalewaySemiBold;" class="container text-left mr-p-t-b">Please fill the form with your information below, then click “Submit”, we will check your
										personal data and send you your Login and Password. </p>
								</div>
							</div>

							<div class="row">
								<form class="container" id="needs-validation">
									<div class="row">
										<div class="col-lg-6">
											<div class="col-lg-12 mb-3">
												<div class="input-group mb-2 mb-sm-0">
													<div class="input-group-addon"><img src="/public/img/contact.png" alt=""></div>
													<input type="text" name="contact_name" class="form-control" id="validationCustom01" placeholder="*Contact name" required>
												</div>
											</div>
											<div class="col-lg-12 mb-3">
												<div class="input-group mb-2 mb-sm-0">
													<div class="input-group-addon"><img src="/public/img/position.png" alt=""></div>
													<input type="text" name="position" class="form-control" placeholder="Position">
												</div>
											</div>
											<div class="col-lg-12 mb-3">
												<div class="input-group mb-2 mb-sm-0">
													<div class="input-group-addon"><img src="/public/img/country.png" alt=""></div>
													<select id="address-country" name="countrys" class="form-control dropdown-edit" style="height: 39.5px;"required>
													</select>
												</div>
											</div>
											<input type="hidden" name="country">
											<input type="hidden" name="referal_id" value="{{$referal_id}}">
											<div class="col-lg-12 mb-3">
												<div class="input-group mb-2 mb-sm-0">
													<div class="input-group-addon"><img src="/public/img/phone.png" alt=""></div>
													<input style="padding: .375rem .75rem;width: 100%;height: 39.5px;border: 1px solid #ced4da; color: #878c92!important; border-bottom-right-radius:.25rem;border-top-right-radius:.25rem;border-top-left-radius: 0rem;border-bottom-left-radius: 0rem;display: block;font-size: 1rem;line-height: 1.5;background-color: #fff;background-image: none;background-clip: padding-box;
												transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;" type="tel" name="phone_number" class="" id="phone" required>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="col-lg-12 mb-3">
												<div class="input-group mb-2 mb-sm-0">
													<div class="input-group-addon"><img src="/public/img/web.png" alt=""></div>
													<input type="text" name="company_website" class="form-control" placeholder="Website">
												</div>
											</div>
											<div class="col-lg-12 mb-3">
												<div class="input-group mb-2 mb-sm-0">
													<div class="input-group-addon"><img src="/public/img/company.png" alt=""></div>
													<input type="text" name="company_name" class="form-control" id="validationCustom02" placeholder="*Company Name" required>
												</div>
											</div>
											<div class="col-lg-12 mb-3">
												<div class="input-group mb-2 mb-sm-0">
													<div class="input-group-addon"><img src="/public/img/type.png" alt=""></div>
													<select name="bisiness_scope" class="form-control form-select dropdown-edit" style="height: 39.5px;" required>
														<option value="" disabled selected>*Type of business</option>
														<option value="End user / Manufacturer">End user / Manufacturer</option>
														<option value="Importer / distributor">Importer / Distributor</option>
														<option value="Trader">Trader </option>
														<option value="Agent / professional service provider">Agent / Professional service provider</option>
													</select>
												</div>
											</div>
											{{--<input type="hidden" name="bisiness_scope">--}}
											<div class="col-lg-12 mb-3"><div class="input-group mb-2 mb-sm-0">
													<div class="input-group-addon"><img src="/public/img/email.png" alt=""></div>
													<input type="email" name="email" class="form-control" id="validationCustom02" placeholder="*Email" required>
												</div>
											</div>
										</div>

										{{--<div class="row">--}}


										<p style="margin-left: 2.5rem!important;font-family: RalewaySemiBold;" class="text-danger text-left">*required fields</p>
										<div class="col-lg-12">
											<button class="btn btn-success btn_submit" type="submit" style="border-radius: 5px;background-color: rgb(86, 190, 96);color: #fff;border-bottom: 2px solid #508755; max-width: 237px;width: 100%;height: 40px;font-family: RalewaySemiBold;" >Submit </button>
											<button style="display:none; font-family: RalewaySemiBold;" class="btn btn-success btn_modal" type="button" data-toggle="modal" data-target="#exampleModal">Submit </button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div id="exampleModalLabel" class="modal-body text-center">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h6>Tank you for submitting.</h6>
							<p>Soon, you will receive your Login and access information.</p>
							<div class="text-center">
								<button type="button" data-dismiss="modal"  class="btn btn-success text-center">Ok</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

@endsection
@section('script')
	@include('template.script_template')
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="/public/js/intlTelInput.js"></script>
	<script src="/public/js/jquery.sweet-modal.js"></script>
	<script>

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                var form = document.getElementById('needs-validation');
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }, false);
        })();

        $('form').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            $('input[name="country"]').val($( "#address-country option:selected" ).text());
//            console.log($(this).serialize());
            $.ajax({
                url:"/api/admin/clients/main_page/add",
                type:"POST",
                data:$(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
//				    $('.btn_modal').click();
                        sweet_modal("Thank you! <br> We will contact you shortly.",'success',2500);
                        setTimeout(function () {
                            window.location = '/login';
                        },2500);
                    }else{
                        sweet_modal(data.message,'error',2000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    console.log(data);
                    sweet_modal('Something went wrong','error',2000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })

        });


        function sweet_modal(text,type,time) {
            $.sweetModal({
                content: text,
                icon: type,
                timeout:time
            });
        }

        var countryData = $.fn.intlTelInput.getCountryData(),
            telInput = $("#phone"),
            addressDropdown = $("#address-country");

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