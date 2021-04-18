@extends('layouts.index')

@section('content')
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Events List</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">Events List</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End -->
<!-- event list wrapper start-->
<div class="blog_category_wrapper ms_cover">
	<div class="container">
		<div class="row"> @foreach($events as $event)
			<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
				<div class="blog_category_box_wrapper blog_box_wrapper2 float_left">
					<div class="blog_news_img_wrapper float_left"> <img src="{{ asset('/uploads/'.$event->featured_image) }}" alt="blog_img"> </div>
					<div class="lest_news_cont_wrapper float_left">
						<div class="blog_heaidng_top">
							<?php
							$eventDate = date('d F, Y', strtotime($event->start_datetime));
							?>
							<span> <i class="flaticon-calendar"></i>{{ $eventDate }}</span>
							<h3> <a href="{{ url('/events/eventDetails/'.$event->id) }}">{{ $event->event_name }}</a></h3>
						</div>
						<div class="blog-single_cntnt"> {!!html_entity_decode($event->description)!!} <a href="{{ url('/events/eventDetails/'.$event->id) }}"> read more</a> </div>
					</div>
				</div>
			</div>
			@endforeach </div>
			{{ $events->links("pagination::bootstrap-4") }}
	</div>
</div>
@endsection