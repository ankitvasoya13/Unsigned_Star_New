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
				<div class="ms_heading_wrapper ms_cover text-center">
					<h1>GET IN TOUCH</h1>
					<p>We would love to hear from you! <a href="mailto=feeback@unsignedstar.com">feeback@unsignedstar.com</a> or use the form below.</p>
				</div>
			</div>
			<div class="col-lg-10 offset-lg-1 col-md-12 col-sm-12 col-12">
				<form class="form-horizontal" method="post" action="{{ url('/contact-us') }}" novalidate="novalidate" enctype="multipart/form-data">
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
									<input type="text" class="form-control require" name="subject" required="" placeholder="subject">
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12">
							<div class="form-e">
								<div class="form-group i-email">
									<select class="form-control form-control-lg" name="support_type">
										<option>Membership</option>
										<option>Tech Support</option>
										<option>Account</option>
										<option>L.A Office</option>
										<option>London Office</option>
										<option>NYC Office</option>
										<option>ATL Office</option>
										<option>Asia Pacific Office</option>
									</select>
								</div>
							</div>
						</div>
						<!-- /.col-md-12 -->
						<div class="col-md-12">
							<div class="form-m">
								<div class="form-group i-message">
									<textarea class="form-control require" name="message" required="" rows="5" id="messageTen" placeholder=" Message"></textarea>
								</div>
							</div>
						</div>
						<!-- /.col-md-12 -->
						<div class="col-md-12">
							<div class="tb_es_btn_div">
								<div class="response"></div>
								<div class="tb_es_btn_wrapper">
									<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> send !</button>
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