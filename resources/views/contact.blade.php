@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>contact us</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">contact us</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- contact_wrapper start -->
<div class="contact_section ms_cover">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-10 offset-lg-1 col-md-12 col-sm-12">
				@if(session()->has('success'))
					<div class="alert alert-success col-md-12 col-sm-12">
						{{ session()->get('success') }}
					</div>
				@endif
				@if(Session::has('error'))
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{!! session('error') !!}
				</div>
				@endif
				<div class="ms_heading_wrapper ms_cover text-center">
					<h1>GET IN TOUCH</h1>
					<p>We would love to hear from you! Email us at <a href="mailto=feeback@unsignedstar.com">feeback@unsignedstar.com</a> or use the form below.</p>
				</div>
			</div>
			<div class="col-lg-10 offset-lg-1 col-md-12 col-sm-12 col-12">
				<form class="form-horizontal" id="form-contact" method="post" action="{{ url('/contact-us') }}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-pos">
								<div class="form-group i-name">
									<input type="text" class="form-control require" name="first_name" required="" placeholder="First Name*">
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-pos">
								<div class="form-group i-name">
									<input type="text" class="form-control require" name="last_name" required="" placeholder="last Name*">
								</div>
							</div>
						</div>
						<!-- /.col-md-12 -->
						<div class="col-lg-6 col-md-6">
							<div class="form-e">
								<div class="form-group i-email">
									<input type="email" class="form-control require" name="email" required="" placeholder=" Email *" data-valid="email" data-error="Email should be valid.">
								</div>
							</div>
						</div>
						<!-- /.col-md-12 -->
						<div class="col-lg-6 col-md-6">
							<div class="form-s">
								<div class="form-group i-subject">
									<input type="text" class="form-control require" name="subject" required="" placeholder="subject*">
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12">
							<div class="form-e">
								<div class="form-group i-email">
									<style>
										select {
											display: block !important;
											margin: 0;
											border: 0;
											padding: 0;
											height: 1px;
											opacity: 1;
											position: relative;
										}
									
										.nice-select {
											display: none
										}
									</style>
									<select class="form-control form-control-lg" name="support_type" required="" >
										<option disabled selected value="">Select Contact Reason</option>
										<option value="Account">Account</option>
										<option value="Advertise">Advertise</option>
										<option value="Feedback">Feedback</option>
										<option value="Membership">Membership</option>
										<option value="Report an issue">Report an issue</option>
										<option value="Tech Support">Tech Support</option>
										<option value="L.A. Office">L.A. Office</option>
										<option value="London Office">London Office</option>
										<option value="NYC Office">NYC Office</option>
										<option value="ATL Office">ATL Office</option>
										<option value="Asia Pacific Office">Asia Pacific Office</option>
									</select>
								</div>
							</div>
						</div>
						<!-- /.col-md-12 -->
						<div class="col-md-12">
							<div class="form-m">
								<div class="form-group i-message">
									<textarea class="form-control require" name="message" required="" rows="5" id="messageTen" placeholder=" Message*"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-m">
								<div class="form-group i-message">
									<div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY')  }}" data-callback="recaptchaCallback"></div>
									<span class="recaptcha-error" style="color: red;display: none;">Please fill Re-Captcha.</span>
									@if ($errors->has('g-recaptcha-response'))
										<span class="invalid-feedback" style="display: block">
											<strong>{{$errors->first('g-recaptcha-response')}}</strong>
										</span>
									@endif
									<span id="err"></span>
								</div>
							</div>
						</div>
						
						<!-- /.col-md-12 -->
						<div class="col-md-12">
							<div class="tb_es_btn_div">
								<div class="response"></div>
								<div class="tb_es_btn_wrapper">
									<button type="submit" class="submitForm" id="submitBtn"><i class="flaticon-play-button"></i> send</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- contact_wrapper end -->
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
	$(".recaptcha-error").hide();
	var recaptchachecked;
	function recaptchaCallback() {	
		recaptchachecked = true;
		$(".recaptcha-error").hide();
	}

	$(document).on("submit", "#form-contact", function(e) {
    if (recaptchachecked == true) {
      $(".recaptcha-error").hide()
    }else{
      $(".recaptcha-error").show()
      e.preventDefault();
    }    
  });

</script>