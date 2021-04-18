@extends('layouts.index')

@section('content')
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Success Stories</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">Success Stories</li>
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
		<div class="row">
			@foreach($stories as $story)
			<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
				<div class="blog_category_box_wrapper blog_box_wrapper2 float_left">
					<div class="blog_news_img_wrapper float_left">
						<img src="{{ asset('/uploads/'.$story->featured_image) }}" alt="blog_img">
					</div>
					<div class="lest_news_cont_wrapper float_left">
						<div class="blog_heaidng_top">
							<?php
                            $storyDate = date('d F, Y', strtotime($story->created_at));
                            ?>
							<span> <i class="flaticon-calendar"></i>{{ $storyDate }}</span>
							<h3> <a href="{{ url('/success-stories/storyDetails/'.$story->id) }}">{{ $story->title }}</a></h3>
						</div>
						<div class="blog-single_cntnt">
							{!!html_entity_decode($story->description)!!}
							<a href="{{ url('/success-stories/storyDetails/'.$story->id) }}"> read more</a>
						</div>

					</div>

				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
<!-- new release wrapper end -->
@endsection