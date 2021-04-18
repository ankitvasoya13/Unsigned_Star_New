@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>@foreach($pages as $page)

							@if($page->id == 4)
						{!!html_entity_decode($page->title)!!}
						@endif @endforeach</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">
						@foreach($pages as $page)

							@if($page->id == 4)
						{!!html_entity_decode($page->title)!!}
						@endif @endforeach</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- About wrapper start -->
<div class="about_us_wrapper about-contain">
	<div class="container">
		<div class="row align-items-center">
			@foreach($pages as $page)
			
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pl-5 about-text-blog">
				<div class="artist_wrapper_text">
					<div class="artist_wrapper_left"> 
						@if($page->id == 4)
						{!!html_entity_decode($page->content)!!}
						@endif 
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
<!-- About wrapper End --> 
@endsection