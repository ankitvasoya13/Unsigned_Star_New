@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>404 error</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">404 error</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- error wrapper start -->
<div class="error_wrapper ms_cover">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center"> <img src="images/error.png" alt="img" class="img-responsive">
				<div class="error_page_cntnt ms_cover">
					<h3>Sorry, This Page Isn't available :(</h3>
					<p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. A Aenean sollicitudin, lorem quis bibend Aenean sollicitudin, lorem . </p>
					<div class="lang_apply_btn home_btn ms_cover">
						<ul>
							<li> <a href="#">home page</a> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- error wrapper End -->  
@endsection