@extends('layouts.index')

@section('content')
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Profile</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">profile</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End -->
<!-- top artist wrapper start -->
<div class="contact_section treanding_songs_wrapper ms_cover">
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				@if(Session::has('error'))
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{!! session('error') !!}
				</div>
				@endif
				@if(Session::has('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{!! session('success') !!}
				</div>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px;">
				<div class="ms_heading_wrapper artist_dashboard">
					<h1>Profile Details</h1>
				</div><br clear="all"/> 
				@if ($userDetails->user_type == 1 && count($transactions) <= 0)
				@foreach ($packagesDetails as $pack)
					<a href="{{ url('payment/process/'.$pack->id) }}" class="submitForm" style="float: right; margin:1px 1px;">{{$pack->title}}</a>	
				@endforeach				
				@endif
				
			</div>
		</div>

		<div class=" row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
				<ul class="nav nav-tabs text-center" id="myTab" role="tablist">
					<li class="nav-item col-xl-2"> <a class="nav-link active" id="artist-tab" data-toggle="tab" href="#artist" role="tab" aria-controls="artist" aria-selected="true"><i class="flaticon-vinyl"></i> My Profile</a> </li>
					<li class="nav-item col-xl-2"> <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false"><i class="fa fa-eye"></i> Password</a> </li>
					@if($userDetails->user_type == 1)
					<li class="nav-item col-xl-2"> <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="false"><i class="flaticon-playlist-3"></i> Order History</a> </li>
					<li class="nav-item col-xl-2"> <a class="nav-link" id="track-tab" data-toggle="tab" href="#track" role="tab" aria-controls="track" aria-selected="false"><i class="flaticon-playlist"></i> Tracks</a> </li>
					<li class="nav-item col-xl-2"> <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false"><i class="flaticon-play-button-1"></i> Video</a> </li>
					<li class="nav-item col-xl-2"> <a class="nav-link" id="add-pic-tab" data-toggle="tab" href="#add-pic" role="tab" aria-controls="add-pic" aria-selected="false"><i class="fa fa-picture-o"></i> Photos</a> </li>
					@endif
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="artist" role="tabpanel" aria-labelledby="artist-tab">
						<div class="ms_heading_wrapper ms_cover text-center mt-4">
							<h1>Profile Details</h1>
						</div>
						<form class="form-horizontal" method="post" action="{{ url('/update-profile/'.$userDetails->id) }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<input type="text" class="form-control require" name="first_name" required="" placeholder="First Name *" value="{{ $userDetails->first_name }}" required="">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<input type="text" class="form-control require" name="last_name" required="" placeholder="Last Name *" value="{{ $userDetails->last_name }}" required="">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											@php
											$genreArray = array('Jazz', 'Rock', 'Pop', 'Folk', 'Classical', 'Heavy Metal', 'Punk Rock', 'Soul', 'Hip Hop', 'Reggae', 'Funk', 'Disco', 'Techno', 'Instrumental');
											@endphp
											<select class="form-control form-control-lg" name="genre">
												<option value="">Favourite Genre</option>
												@foreach($genreArray as $genre)
												<option value="{{ $genre }}" @if ($genre==$userDetails->genre) selected @endif>{{ $genre }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											@php
											$countryArray = array("Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania","Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe");
											@endphp
											<select class="form-control form-control-lg" name="country">
												@foreach($countryArray as $country)
												<option value="{{ $country }}" @if ($country==$userDetails->country) selected @endif>{{ $country }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											{{-- @php
											$cityArray = array('Sydney', 'Thimphu', 'Curitiba', 'Chicago', 'Brooks', 'Berlin', 'Blida', 'Ahmedabad', 'Auckland', 'Kathmandu', 'Geneva', 'Stockholm ', 'Istanbul', 'New York');
											@endphp
											<select class="form-control form-control-lg" name="city">
												@foreach($cityArray as $city)
												<option value="{{ $city }}" @if ($city==$userDetails->city) selected @endif>{{ $city }}</option>
												@endforeach
											</select> --}}
											<input type="text" class="form-control form-control-lg" name="city" placeholder="City" value="{{ $userDetails->city }}">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											<input type="email" class="form-control require" name="email" required="" placeholder=" demo@gmail.com *" data-valid="email" data-error="Email should be valid." readonly value="{{ $userDetails->email }}">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-s">
											<label for="birth-date">Birth Date</label>

										<?php
										$birthdate = date('m/d/Y', strtotime($userDetails->birthdate));
										?>
										<div class="form-group i-dob">
											<input type="text" class="form-control require" name="birthdate" required="" placeholder="Date of Birth *" onfocus="(this.type='date')" value="{{ $birthdate }}">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 mb-2">
									<div class="">
										<!--class:custom-file-upload-->
										<label for="file-upload" class="custom-file-upload1">Profile Photo</label>
										<input type="file" id="file-upload" name="profile_image">
										
										<!-- <div id="file-upload-filename"></div> -->
									</div>
									<small>Image must be 500 x 500 pixel and format must be .jpg.</small>
								</div>
								@if($userDetails->user_type == 1 || $userDetails->user_type == 2)
								<div class="col-lg-12 col-md-12">
									<div class="form-s">
										<div class="form-group i-dob">
											<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Biography" name="biography">{{ $userDetails->biography }}</textarea>
										</div>
									</div>
								</div>
								@endif
								<!-- <div class="col-lg-12 col-md-12">
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="terms_condition">
										<label class="custom-control-label" for="customControlAutosizing">Accept Terms & Condition</label>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 mt-2">
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="customControlAutosizing1" name="newsletters">
										<label class="custom-control-label" for="customControlAutosizing1">Receive Newsletters</label>
									</div>
								</div> -->
								<div class="col-md-12">
									<div class="tb_es_btn_div">
										<div class="tb_es_btn_wrapper">
											<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> submit !</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<div class="ms_heading_wrapper ms_cover text-center mt-4">
							<h1>Change Password</h1>
						</div>
						<form class="form-horizontal" method="post" action="{{ url('/change-password/'.$userDetails->id) }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="col-lg-12 col-md-12">
								<div class="form-pos">
									<div class="form-group i-name">
										<input type="password" class="form-control require" name="current_password" required="" placeholder="Current Password *">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-pos">
									<div class="form-group i-name">
										<input type="password" id="password" onfocusout="comparePassword()" class="form-control require" name="new_password" required="" placeholder="New Password *" data-error="Email should be valid.">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-pos">
									<div class="form-group i-name">
										<input type="password" class="form-control require" onfocusout="comparePassword()" id="confirm_password" name="confirm_password" required="" placeholder="Confirm Password *">
										<span id="passwordError"></span>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="tb_es_btn_div">
									<div class="tb_es_btn_wrapper">
										<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> submit !</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					@if($userDetails->user_type == 1)
					<div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
						<table class="table table-bordered mt-5 table-responsive">
							<thead>
								<tr>
									<th scope="col" width="100">Order Id</th>
									<th scope="col">Package</th>
									<th scope="col">Track Limit</th>
									<th scope="col">Package Amount</th>
									<th scope="col">Order Date</th>
								</tr>
							</thead>
							<tbody>
								@php
								$totalItem = 0;	
								$totalAmount = 0;
								@endphp
								@foreach($transactions as $i => $transaction)
								@php
								$totalItem = $totalItem + $transaction->item;
								$totalAmount = $totalAmount + $transaction->payment_amount;
								@endphp
								<tr>
									<th scope="row">{{ $i + 1 }}</th>									
									<td>{{ $transaction->package_name }}</td>
									<td>{{ $transaction->item }}</td>
									<td>{{ $transaction->payment_amount.' '.$transaction->currency }}</td>
									<td>{{ date($transaction->created_at) }}</td>
								</tr>
								@endforeach
								<tr style="font-weight: 700">
									<td></td>
									<td style="text-align: right">Total</td>
									<td>{{$totalItem}}</td>
									<td>{{$totalAmount}} AUD</td>
									<td></td>
								</tr>								
							</tbody>
						</table>
					</div>
					<div class="tab-pane fade" id="track" role="tabpanel" aria-labelledby="track-tab">
						<table class="table table-bordered mt-5 text-center">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Track Name</th>
									<th scope="col">Delete Track</th>
								</tr>
							</thead>
							<tbody>
								@foreach($trackDetails as $i => $track)
								<tr>
									<th scope="row">{{ $i+1 }}</th>
									<td>{{ $track->track_name }}</td>
									<td><a href="{{ url('/delete-track/'.$track->id) }}" onclick="return confirm('Are you sure? You want to delete.')"><i class="flaticon-trash"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>

						<div class="col-lg-12 col-md-12 mb-2 mt-4 pl-0">
							<form class="form-horizontal" method="post" action="{{ url('/upload-track') }}" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="">
									<!--class:custom-file-upload-->
									<input type="hidden" name="id" value="{{ $userDetails->id }}">
									<div class="col-lg-6 col-md-6">
										<div class="form-pos">
											<div class="form-group i-name">
												<label class="form-label">Track Name</label>
												<input type="text" class="form-control require" name="track_name" required="" placeholder="Track Name" value="">
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-pos">
											<div class="form-group i-name">
												<label>Upload .mp3 File : &nbsp;</label><input type="file" name="track_file" value="" required="">
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-pos">
											<div class="form-group i-name">
												<label>Upload Cover Image : &nbsp;</label><input type="file" name="cover_image" value="">
											</div>
										</div>
									</div>
									{{-- <div class="col-lg-6 col-md-6">
										<div class="form-pos">
											<div class="form-group i-name">
												<label class="form-label">Track Views</label>
												<input type="text" class="form-control require" name="track_views" placeholder="Track Views" value="">
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-pos">
											<div class="form-group i-name">
												<label class="form-label">Track Likes</label>
												<input type="text" class="form-control require" name="track_likes" placeholder="Track Likes" value="">
											</div>
										</div>
									</div> --}}
									{{-- <div class="col-lg-6 col-md-6">
										<div class="form-pos">
											<div class="form-group i-name">
												<label class="form-label">Status</label>
												<select class="form-control">
													<option value="1">Enable</option>
													<option value="0">Disable</option>
												</select>
											</div>
										</div>
									</div> --}}
									<!-- <label for="file-upload" class="custom-file-upload1">Upload Tracks</label> -->
									<!-- <div id="file-upload-filename"></div> -->
									<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> submit !</button>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
						<form class="mt-4" method="post" action="{{ url('/upload-video') }}" enctype="multipart/form-data">
							<div class="row">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $userDetails->id }}">
								<p style="text-align: center; padding-bottom: 20px;">Video E.g.: https://www.youtube.com/watch?v=1onmPIe07yo (Copy code after "v=" and paste it in the video box) </p>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										
										<div class="form-group i-name">

											<label class="form-label">Video 1</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_1" required="" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_1)) { echo $videoDetails->video_file_1; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 2</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_2" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_2)) { echo $videoDetails->video_file_2; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 3</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_3" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_3)) { echo $videoDetails->video_file_3; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 4</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_4" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_4)) { echo $videoDetails->video_file_4; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 5</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_5" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_5)) { echo $videoDetails->video_file_5; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 6</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_6" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_6)) { echo $videoDetails->video_file_6; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 7</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_7" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_7)) { echo $videoDetails->video_file_7; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 8</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_8" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_8)) { echo $videoDetails->video_file_8; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 9</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_9" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_9)) { echo $videoDetails->video_file_9; } ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<label class="form-label">Video 10</label>
											<input type="text" class="form-control require text-lowercase" name="video_file_10" placeholder="Video URL" value="<?php if(!empty($videoDetails->video_file_10)) { echo $videoDetails->video_file_10; } ?>">
										</div>
									</div>
								</div>
								<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> Update !</button>
							</div>
						</form>
					</div>
					<div class="tab-pane fade" id="add-pic" role="tabpanel" aria-labelledby="add-pic-tab">
						<div class="row mt-5">
							<form class="form-horizontal" method="post" action="{{ url('/upload-photos') }}" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="col-md-6">
									<input type="hidden" name="id" value="{{ $userDetails->id }}">
									<input type="file" id="images" name="photo_file[]" onchange="preview_images();" multiple required=""/>
									<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> submit !</button>
								</div>
							</form>
						</div>
						<div class="row" id="image_preview">
							@foreach($photoDetails as $photoDetail)
							<div class="col-lg-3 col-md-6 col-sm-12 col-12">
    							<div class="feature_artist_image text-center py-4">
    								<img src="{{ asset('/uploads/photos/'.$photoDetail->photo_file) }}" class="img-responsive" alt="img" height="224px"><br/><br/>
									<a href="{{ url('/delete-photo/'.$photoDetail->id) }}" onclick="return confirm('Are you sure? You want to delete.')"><i class="flaticon-trash"></i></a>
    							</div>
    						</div>
    						@endforeach
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<!-- top artist wrapper start -->

@endsection
<script>
		function comparePassword() {
		var password = $("input[name='new_password']").val();
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
</script>