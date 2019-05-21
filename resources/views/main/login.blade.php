@extends('layout.main')
@section('head')
	@include('template.head_template')
@endsection
@section('content')
<div class="main-content">
	@include('main.header')
	<section id="register">
		<div class="container">
			<div class="row mr-t-b-lg">
				<div class="card m-auto" style="width: 30rem;-webkit-box-shadow: 0px 0px 27px -8px rgba(0,0,0,0.75);-moz-box-shadow: 0px 0px 27px -8px rgba(0,0,0,0.75);box-shadow: 0px 0px 27px -8px rgba(0,0,0,0.75);">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<form style="padding-top: 4rem;padding-bottom: 4rem;" class="container text-center p-t-b p-r-l" action="/api/login" method="POST">
									<div class="form-group">
										<label class="sr-only" for="validationCustom01">Email</label>
										<div class="input-group">
											<div class="input-group-addon"><img src="/public/img/contact.png" alt=""></div>
											<input type="email" value="" name="email" class="form-control" id="validationCustom01" placeholder="Email" required>
										</div>
									</div>
									<div class="form-group">
										<label class="sr-only" for="validationCustom02">Password</label>
										<div class="input-group">
											<div class="input-group-addon"><img src="/public/img/password.png" alt=""></div>
											<input type="password" value="" name="password" class="form-control" id="validationCustom02" placeholder="Password" required>
										</div>
										<input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
									</div>
									<div class="form-check text-left">
										<label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
											<input type="checkbox" class="custom-control-input">
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description" style="font-family: RalewaySemiBold;">Remember me</span>
										</label>
									</div>
									<div class="row text-center">
									<button type="submit" class="btn_submit  btn-block btn btn-success" style="font-family:RalewaySemiBold;margin:15px auto;border-radius: 5px;background-color: rgb(86, 190, 96);color: #fff;border-bottom: 2px solid #508755;width: 100%;height: 40px;">Log in</button>
								</div>
									<p  style="font-family: RalewaySemiBold;margin-top: 0.5rem;">Don’t  have an account? <span class="fixed-signup">Then <a style="color:#2f466d!important;text-decoration:underline;" class="sign_up" href="/sign-up">Sign Up</a></span></p>
								</form>
							</div>
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
			url:"/api/login",
			type:"POST",
			data:$(this).serialize(),
			dataType: 'JSON',
			success:function (data) {
	//		    console.log(data);
				if(data.success==true){
					sweet_modal('Success','success',1000);
					window.location = location;
				}else{
					sweet_modal(data.message,'error',3000);
				}
				$(".btn_submit").removeAttr('disabled');
			},error:function (data) {
	            console.log(data);
				sweet_modal('Something went wrong','error',3000);
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
