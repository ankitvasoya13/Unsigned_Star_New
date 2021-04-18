@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Our Panel</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">Our Panel</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- Our Panel Page wrapper Start -->
<div class="our_panel_wrapper">
	<div class="container">
		<div class="row align-items-center text-center">
			@foreach($userDetails as $user)
			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
				@if(!empty($user->profile_image))
				<a href="{{ url('/profile/'.$user->id) }}"><img src="{{ asset('/uploads/'.$user->profile_image) }}" alt="img" class="w-100"></a>
				@else
				<a href="{{ url('/profile/'.$user->id) }}"><img src="{{ asset('images/ft3.jpg') }}" alt="img" class="w-100"></a>
				@endif
			</div>
			@endforeach
			<!--<div class="col-md-12 pl-0 text-center mt-2">
				<div class="tb_es_btn_div">
					<div class="tb_es_btn_wrapper">
						<button type="button" class="joinNow"><i class="flaticon-play-button"></i> Load More !</button>
					</div>
				</div>
			</div>-->
		</div>
	</div>
</div>
<!-- artist page wrapper End --> 
@endsection