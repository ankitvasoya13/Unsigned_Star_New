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
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- Our Panel Page wrapper Start -->
<div class="our_panel_wrapper">
	<div class="container">
		<div id="searchResult" class="row align-items-center text-center">
			@foreach($userDetails as $user)
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="blog_category_box_wrapper blog_box_wrapper2 float_left">
					<div class="blog_news_img_wrapper float_left">
						@if(!empty($user->profile_image))
							<a href="{{ url('/profile/'.$user->id) }}"><img src="{{ asset('/uploads/'.$user->profile_image) }}" alt="img" class="w-100"></a>
						@else
							<a href="{{ url('/profile/'.$user->id) }}"><img src="{{ asset('images/ft3.jpg') }}" alt="img" class="w-100"></a>
						@endif
					</div>
					<div class="lest_news_cont_wrapper float_left">
						<div class="blog_heaidng_top">
							<h3> <a href="{{ url('/profile/'.$user->id) }}">{{ $user->first_name.' '.$user->last_name }}</a></h3>
						</div>
						
					</div>
				</div>				
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>	 
  $(window).on("load", function() {
    searchPanel();
  });
  
   function searchPanel(limit = null) {    
    $.ajax({
      type: "GET",
      url: "searchPanel",
      data: { limit:limit },
      success: function(data) {
        $("#searchResult").html(data);
      },
    });
  }
</script>