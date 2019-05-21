@extends('layout.main')
@section('head')
	@include('template.head_template')
    <style>
        /*.alert{*/
            /*background-color: #2f466d !important;*/
            /*border-radius:0;*/
        /*}*/
    </style>
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
						<p class="container text-left mr-p-t-b text-center">Please enter the password to complete the registration.</p>
						<div class="row">
							<form class="container" id="needs-validation" >
								<div class="row">

									<div class="col-md-6 mb-3">
										<label class="sr-only" for="validationCustom01">Password</label>
										<div class="input-group mb-2 mb-sm-0">
											<div class="input-group-addon"><img src="/public/img/contact.png" alt=""></div>
											<input type="password" name="password" class="form-control" id="validationCustom01" placeholder="*Password" required>
										</div>
									</div>
									<input type="hidden" value="{{$token}}"  name="token">
									<div class="col-md-6 mb-3">
										<label class="sr-only" for="validationCustom02">Confirm password</label>
										<div class="input-group mb-2 mb-sm-0">
											<div class="input-group-addon"><img src="/public/img/company.png" alt=""></div>
											<input type="password" name="confirm_password" class="form-control" id="validationCustom02" placeholder="*Confirm password" required>
										</div>
									</div>
								</div>
								<p style="margin-left: 2.5rem!important;" class="text-danger text-left">*required fields</p>
								<button class="btn btn-success btn_submit" type="submit">Submit </button>
							</form>
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
	<script>
        $('form').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/signup/clients",
                type:"POST",
                data:$(this).serialize(),
                dataType: 'JSON',
                success:function (data) {
		    	console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        window.location = location;
                    }else{
                        sweet_modal(data.message,'error',1000000000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
            console.log(data);
                    sweet_modal('Something went wrong','error',1000);
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
    </script>
@endsection
