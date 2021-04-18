@extends('layouts.index')

@section('content')
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>{{ $eventDetails->event_name }}</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('/events') }}">Events</a></li>
						<li class="breadcrumb-item">{{ $eventDetails->event_name }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End -->
<!-- prs es about wrapper Start -->
<div class="prs_es_about_main_section_wrapper ms_cover">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="event_single_text_wrapper">
					<h2>About the Event</h2>
					<?php if (!empty($eventDetails->venue)) { ?>
					<br/><b>Venue: {{ $eventDetails->venue }}</b><br/>
				<?php } ?>

						<b>Start Date: {{ $eventDetails->start_datetime }}</b><br/>
						<b>End Date: {{ $eventDetails->end_datetime }}</b><br/><br/>

					{!!html_entity_decode($eventDetails->description)!!}
					<!-- <div class="lang_apply_btn footer_cont_btn">
						<ul>
							<li>
								<a href="#"> <i class="flaticon-play-button"></i>read more</a>
							</li>
						</ul>
					</div> -->
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="event_single_slider ">
					 <img src="{{ asset('/uploads/'.$eventDetails->featured_image) }}" alt="blog_img" class="img-responsive w-100">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- prs es about wrapper End -->
<!-- event wrapper start -->
@if(count($upcomingEvent) > 0)
<div class="download_wrapper ms_cover">
	<div class="concert_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="upcoming_event_wrapper ms_cover">
					@foreach($upcomingEvent as $event)
					<h2>Upcoming Events</h2>
					<h3>{{ date('F', strtotime($event->start_datetime)).', '.date('jS', strtotime($event->start_datetime)).' - '.date('jS', strtotime($event->end_datetime)).', '.date('Y', strtotime($event->start_datetime)) }}</h3>
					<p>Address : {{ $event->venue }}</p>
					<!-- <div class="prs_ec_ue_timer_wrapper upcoming_clickdiv">
						<div id="clockdiv">
							<div><span class="days"></span>
								<div class="smalltext">Days</div>
							</div>
							<div><span class="hours"></span>
								<div class="smalltext">Hours</div>
							</div>
							<div><span class="minutes"></span>
								<div class="smalltext">Mins</div>
							</div>
							<div><span class="seconds"></span>
								<div class="smalltext">Secs</div>
							</div>
						</div>
					</div> -->
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<!-- event wrapper end -->
@endsection