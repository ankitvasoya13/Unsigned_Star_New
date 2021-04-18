@extends('layouts.index')

@section('content')
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>{{ $competitionDetails->competition_name }}</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('/competitions') }}">Competitions</a></li>
						<li class="breadcrumb-item">{{ $competitionDetails->competition_name }}</li>
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
					<h2>About the Competition</h2>
					<?php if (!empty($competitionDetails->venue)) { ?>
					<br/><b>Venue: {{ $competitionDetails->venue }}</b><br/>
				<?php } ?>

						<b>Start Date: {{ date('m/d/Y H:i', strtotime($competitionDetails->start_datetime)) }}</b><br/>
						<b>End Date: {{ date('m/d/Y H:i', strtotime($competitionDetails->end_datetime)) }}</b><br/>

					<p style="padding-bottom: 20px">{!!html_entity_decode($competitionDetails->short_description)!!}</p>

					{!!html_entity_decode($competitionDetails->description)!!}

				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="event_single_slider ">
					 <img src="{{ asset('/uploads/'.$competitionDetails->featured_image) }}" alt="blog_img" class="img-responsive w-100">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- prs es about wrapper End -->

@endsection