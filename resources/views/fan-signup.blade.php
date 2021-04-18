@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Fan Membership</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">Fan Membership</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- form tab start -->
<div class="contact_section artist_section ms_cover jion-form">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="artist_wrapper_content ms_cover">
					<div class="artist_wrapper_left profile-contain">
						<div class="ms_heading_wrapper ms_cover text-left">
							<h1>Fans Join Free!</h1>
						</div>
						<p>Browse & listen to Unsigned Artists Worldwide</p>
						<ul>
							<li>Create playlists on your personalized music player</li>
							<li>Vote for your favourite artists and help them chart and get heard!</li>
							<li>Access to purchase exclusive music</li>
							<li>VIP Access to your favorite artist shows</li>
							<li>Competitions</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="ms_heading_wrapper ms_cover text-center mt-4">
							<h1>Join Now</h1>
							
						</div>
						@if(session('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{session('success')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif
					
						@if(session('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								{{session('error')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif
						<form class="form-horizontal" method="post" action="{{ url('/fan-signup') }}" id="registerForm" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<input type="text" class="form-control require" name="first_name" required="" placeholder="First Name *">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<input type="text" class="form-control require" name="last_name" required="" placeholder="Last Name *">
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											<input type="email" id="email" onfocusout="checkEmail()" class="form-control require" name="email" required="" placeholder=" Email *" data-valid="email" data-error="Email should be valid.">
											<span id="emailError"></span>
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											<input type="email" id="confirm_email" onfocusout="compareEmail()" class="form-control require" name="confirm_email" required="" placeholder=" Confirm Email *" data-valid="email" data-error="Email should be valid.">
											<span id="emailConfError"></span>
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-6 col-md-6">
									<div class="form-s">
										<div class="form-group i-password">
											<input type="password"  onfocusout="comparePassword()" id="password" class="form-control require" name="password" required="" placeholder="Password *">
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-6 col-md-6">
									<div class="form-s">
										<div class="form-group i-password">
											<input type="password"  onfocusout="comparePassword()" id="confirm_password" class="form-control require" name="confirm_password" required="" placeholder="Confirm Password *">
											<span id="passwordError"></span>											
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-12 col-md-12">
									<div class="form-s">
										<div class="form-group i-dob">
											<input type="text" class="form-control require" name="birthdate" required="" placeholder="Date of Birth *" onfocus="(this.type='date')">
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-md-12">
									<div class="tb_es_btn_div">
										<div class="response"></div>
										<div class="tb_es_btn_wrapper">
											<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> submit</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script>
	function checkEmail() {
		var email = jQuery.trim($("form input[name='email']").val());
		var _token = $("input[name='_token']").val();
		var datastring = 'email='+ email+'&_token='+ _token;
		jQuery.ajax({
		url: "check_email",
		type: "POST",
		data: datastring,
		success: function(data) {
			if (data["message"] == "exist") {
				$("#emailError").html('Email is already used. please try with diffrent email.');
				$("form input[name='email']").val('');
			}
			else{
				$("#emailError").html('');
			}
		},
		});	
	}
	function comparePassword() {
		var password = $("input[name='password']").val();
		var confirm_password = $("input[name='confirm_password']").val();
		if ((password != '') && (confirm_password != '')) {
			if (password != confirm_password) {
				//$("input[name='password']").val('');
				$("input[name='confirm_password']").val('');
				$("#passwordError").html('Confirm password is not matched');
			}else{
				$("#passwordError").html('');
			}
		}		
	}
	function compareEmail() {
		var email = $("input[name='email']").val();
		var confirm_email = $("input[name='confirm_email']").val();
		if ((email != '') && (confirm_email != '')) {
			if (email != confirm_email) {
				//$("input[name='email']").val('');
				$("input[name='confirm_email']").val('');
				$("#emailConfError").html('Confirm Email is not matched');
			}else{
				$("#emailConfError").html('');
			}
		}		
	}
</script>