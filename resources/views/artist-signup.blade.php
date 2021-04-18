@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Artist Membership</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">Artist Membership</li>
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
							<h3>Artist Membership</h3>
						</div>
						<p>With today’s technology, music executives are searching for a quicker, efficient and more convenient way to discover and get in direct contact with unsigned talent. unsignedstar.com was created to connect you, the aspiring artist with talent-seeking VIPs in the music industry. </p>
						<p>The concept is simple, an artist will be given exposure on the site by uploading their material. As a basic marketing rule, each artist should present their best quality of promotional material which includes tracks, videos and photographs. </p>
						<p>If you don’t have original material, we also accept cover songs as they capable of showing off your vocal ability and talent. </p>
					
						<div class="ms_heading_wrapper ms_cover text-left">
							<h3>How will I be seen? </h3>
						</div>

						
						<p>Our panel of Label Executives, Managers, Producers, Songwriters etc are always browsing for new talent on our platform. </p>
						<p>We hold frequent competitions and talent search’s connecting you, the unsigned artist, with the industry. Our competitions are generally recording deals, productions deals, demo deals etc. </p>
						<p>It’s quite simple. </p>
						<p>1. Join unsignedstar.com<br/>2. Upload your material, remember best material so you can make an impression. </p>


						<div class="ms_heading_wrapper ms_cover text-left">
							<h3>Competitions</h3>
						</div>

						<p>Included in your artist membership you are automatically entered in our competitions and talent searches, which are always announced every couple of months as they commence.   </p>
						<p>When a competition end date is reached, we take the top ten artists from the “Top Songs Chart” and also 10 panel selected artists in which these artists became the final 20. The Top 20 artists will be announced on the website. </p>

						<div class="ms_heading_wrapper ms_cover text-left">
							<h3>How do I make the Top Songs Chart?</h3>
						</div>
						
						<p>If you get the most unique listens on one of your songs, you will enter our Top Songs Charts as it is based on how many plays you have received.  You will also be guaranteed to be heard and receive feedback via a video review by one of our panel members. </p>
						<p>Our team will then carefully assess the top 20 artists and choose the winner! You can view <a href="/competitions">Our Current Competition Here!</a></p>


						<div class="ms_heading_wrapper ms_cover text-left">
							<h3>Other features</h3>
						</div>
						
						<p>In addition to this you are free to browse and connect with thousands of unsigned talented acts all over the globe! </p>
						<p>Access to our exclusive member only seminars and webinars presented by the music industry elite.</a></p>
						<p>So, whether you are an artist, a band, producer, DJ, songwriter, the unsignedstar.com family welcome you to our exciting platform. </a></p>
					
						<p>For only USD$99 annually you get:  </p>
						

							<p>Your profile on the #1 unsigned artist platform </p>
	    					<p>Automatic submission to all our competitions and talent search’s </p>
	    					<p>Constructive, and insightful feedback to aspiring musicians* </p>
	    					<p>Access to our exclusive member only seminars and webinars presented by the music industry elite </p>
	    					<p>Browse, network & connect to other unsigned artists worldwide </p>
	    					
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
						<form class="form-horizontal" method="post" id="registerForm" action="{{ url('/artist-signup') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<input type="text" class="form-control require" name="first_name" required placeholder="First Name *">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<input type="text" class="form-control require" name="last_name" required placeholder="Last Name *">
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											<input type="email" id="email" onfocusout="checkEmail()" class="form-control require" name="email" required placeholder=" Email *" data-valid="email" data-error="Email should be valid.">
											<span id="emailError"></span>
										</div>
										
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											<input type="email" id="confirm_email" onfocusout="compareEmail()" class="form-control require" name="confirm_email" required placeholder=" Confirm Email *" data-valid="email" data-error="Email should be valid.">
											<span id="emailConfError"></span>
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-6 col-md-6">
									<div class="form-s">
										<div class="form-group i-password">
											<input type="password" onfocusout="comparePassword()" id="password" class="form-control require" name="password" required placeholder="Password *">
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-6 col-md-6">
									<div class="form-s">
										<div class="form-group i-password">
											<input type="password" onfocusout="comparePassword()" id="confirm_password" class="form-control require" name="confirm_password" required placeholder="Confirm Password *">
											<span id="passwordError"></span>
										</div>
									</div>
								</div>
								<!-- /.col-md-12 -->
								<div class="col-lg-12 col-md-12">
									<div class="form-s">
										<div class="form-group i-dob">
											<input type="text" class="form-control require" name="birthdate" required placeholder="Date of Birth *" onfocus="(this.type='date')">
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