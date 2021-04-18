@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>stations</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">stations</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- stations wrapper start -->
<div class="treanding_songs_wrapper stations_wrapper ms_cover">
	<div class="container">
		<div class="row">
			<div><!-- RadioBOSS Cloud Player Widget (Start) -->
				<div id='rbcloud_player4153'></div>
				<script src='https://c13.radioboss.fm/w/player.js?u=https%3A%2F%2Fc13.radioboss.fm%3A18043%2Fstream&amp;wid=4153'></script> 
				<!-- RadioBOSS Cloud Player Widget (End) --></div>
			
		</div>
	</div>
</div>
<!-- stations wrapper start --> 

@endsection