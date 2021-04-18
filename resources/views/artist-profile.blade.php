@extends('layouts.index')

@section('content')
<!--inner Title Start -->
<style>
	.heightCls > div{
		height: auto !important;
	}
</style>
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>@if($userDetails->user_type == '1')Artist: @elseif($userDetails->user_type == '2')Panel:
						@elseif($userDetails->user_type == '3')Fan:
						@endif{{ $userDetails->first_name.' '.$userDetails->last_name }}</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">{{ $userDetails->first_name.' '.$userDetails->last_name }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End -->
<!-- Artist Page wrapper Start -->
<div class="art_details_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="art_personal_details">
					<div class="art_name">
						<h2>{{ $userDetails->first_name.' '.$userDetails->last_name }}</h2>
						@if($userDetails->user_type == '1' && Session()->get('userId') <> null &&
							Session()->get('userType') != '1')
							<div class="lang_apply_btn footer_cont_btn mb-4">
								<ul>
									@if ($isFollower === 1)
									<li><a href="{{ url('/unfollow/'.$userDetails->id) }}"> <i
												class="flaticon-play-button"></i>Unfollow</a></li>
									<!-- <a href="{{ url('/unfollow/'.$userDetails->id) }}">Unfollow</a> -->
									@else
									<li><a href="{{ url('/follow/'.$userDetails->id) }}"> <i
												class="flaticon-play-button"></i>Follow</a></li>
									<!-- <a href="{{ url('/follow/'.$userDetails->id) }}">Follow</a> -->
									@endif
								</ul>
							</div>
							@endif
					</div>
					<div class="profile-pic mb-4">
						@if(!empty($userDetails->profile_image))
						<img src="{{ asset('/uploads/'.$userDetails->profile_image) }}" alt="img" class="img-fluid"
							width="120px;">
						@else
						<img src="{{ asset('images/tp3.png') }}" alt="img" class="img-fluid" width="120px;">
						@endif
					</div>
					<h4 class="mb-2">
						@if(!empty($userDetails->city))
						{{ $userDetails->city.', '.$userDetails->country }}
						@else
						{{ $userDetails->country }}
						@endif</h4>

					@if(!empty($userDetails->genre))
					<h5 class="mb-4">
						Favorite Genre: {{ $userDetails->genre }}
					</h5>
					@endif
					<p>{!!html_entity_decode($userDetails->biography)!!}</p>
					<!-- <div class="lang_apply_btn footer_cont_btn">
						<ul>
							<li><a href="#"> <i class="flaticon-play-button"></i>read more</a></li>
						</ul>
					</div> -->
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 art-social-blog">
				@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{session('success')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif

				@if(session('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{{session('error')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif

				@if($userDetails->user_type == '1')
				<div class="art_social_details">
					<table class="table">
						<tr>
							<th scope="col">Followers</th>
							<th scope="col">Likes</th>
							<th scope="col">Share</th>
							@if (Session()->has('userType') && Session()->get('userType') == '2')
							<th scope="col">Message</th>
							@endif
						</tr>
						<tr>
							<td class="artist-follower"><img src="/images/followers_icon.png"
									style="width: 30px !important; height: 20px !important;" /> ({{$totalFollower}})
							</td>
							{{-- <td class="artist-like"><i class="fas fa-heart"></i></td> --}}
							@if (Session()->get('userId') <> null && Session()->get('userType') !== '1')
								@if ($isLike == '1')
								<td class="artist-like"><a href="{{ url('/dislike/'.$userDetails->id) }}"><i
											class="fas fa-heart"></i> ({{$totalLikes}})</a></td>
								@else
								<td class="artist-dislike"><a href="{{ url('/like/'.$userDetails->id) }}"><i
											class="fas fa-heart"></i> ({{$totalLikes}})</a></td>
								@endif
								@else
								<td class="artist-dislike"><i class="fas fa-heart"></i>({{$totalLikes}})</td>
								@endif

								<td class="artist-share">
									<div class="addthis_inline_share_toolbox"></div>
								</td>

								@if (Session()->has('userType') && Session()->get('userType') == '2')
								<td class="artist-message"><a
										href="{{ url('/profile/'.$userDetails->id.'/message') }}"><i
											class="flaticon-close-envelope"></i></a></td>
								@endif
						</tr>
					</table>
					@endif


					@if($userDetails->user_type == '1')
					@if (count($followerDetails) > 0)
					<h5 class="mt-4">Fans</h5>
					<div class="row mt-3">
						@foreach ($followerDetails as $follower)
						<div class="col-lg-3 col-md-3 col-sm-3 col-3" style="text-align: center;color:darkblue">
							<a
								href="{{ url('/profile/'.$follower->id.'/'.$follower->first_name . '-' . $follower->last_name)}}">
								<img src="{{ asset('uploads/'.$follower->profile_image) }}"
									alt="{{$follower->first_name.' '.$follower->last_name}}" class="img-fluid"></a>
						</div>
						@endforeach
					</div>
					@endif
				</div>
				@elseif($userDetails->user_type == '2' || $userDetails->user_type == '3')

				@if (count($followingDetails) > 0)
				<div class="art_social_details">
					<h5>Following</h5>
					<div class="row mt-3">
						@foreach ($followingDetails as $following)
						<div class="col-lg-3 col-md-3 col-sm-3 col-3" style="text-align: center;color:darkblue">
							<a
								href="{{ url('/profile/'.$following->id.'/'.$following->first_name . '-' . $following->last_name)}}">
								<img src="{{ asset('uploads/'.$following->profile_image) }}"
									alt="{{$following->first_name.' '.$following->last_name}}" class="img-fluid"> </a>
						</div>
						@endforeach
					</div>
				</div>
				@endif

				@endif

			</div>
		</div>
	</div>
</div>
<!-- artist page wrapper End -->
<!-- event wrapper start -->
@if($userDetails->user_type == '1')
<div class="art_work_list_wrapper">
	@if(count($videoDetails) > 0 || count($top_songs) > 0 || count($photoDetails) > 0)
	<div class="concert_overlay"></div>
	@endif
	<div class="container">
		<div class="row">

			<div class="col-lg-7 col-md-12 col-sm-12 col-12">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					@if(count($top_songs) > 0)
					<h4 class="mb-3 text-center">Tracks</h4>

					{{-- <ul class="mt-3 p-0 list-group">
							@foreach($trackDetails as $i => $track)
							<li style="cursor: pointer" class="list-group-item" onclick="playSong('{{ $track->track_name }}','{{ $track->first_name.' '.$track->last_name }}','{{ url('/uploads/tracks/'.$track->track_file) }}','{{ url('/'.$track->cover_image) }}','{{ $track->id }}')">{{ $i+1 }}.
					{{ $track->track_name }}</li>
					@endforeach
					</ul> --}}


					<div id="topSongs">
						@foreach($top_songs as $song)
						<div class="top_songs_list ms_cover">
							<div class="top_songs_list_left">
								<div class="treanding_slider_main_box top_lis_left_content">
									<div class="top_songs_list0img">
										<img src="{{ url('uploads/tracks/imgs/'.$song->cover_image) }}" alt="img"
											width="50px" height="50px">
										<div class="ms_treanding_box_overlay">
											<div class="ms_tranding_box_overlay"></div>

											<div class="tranding_play_icon">
												{{-- <a href="#"> --}}
												<i class="flaticon-play-button"
													onclick="playSong('{{ $song->track_name }}','{{ $song->first_name.' '.$song->last_name }}','{{ url('uploads/tracks/'.$song->track_file) }}','{{ url('uploads/tracks/imgs/'.$song->cover_image) }}','{{ $song->id }}')"></i>
												{{-- </a> --}}
											</div>
										</div>
									</div>
									<div class="release_content_artist top_list_content_artist"
										onclick="playSong('{{ $song->track_name }}','{{ $song->first_name.' '.$song->last_name }}','{{ url('uploads/tracks/'.$song->track_file) }}','{{ url('uploads/tracks/imgs/'.$song->cover_image) }}','{{ $song->id }}')"
										style="cursor: pointer;">
										<p><a
												title="{{ $song->track_name }}">{{ substr($song->track_name,0,15) }}...</a>
										</p>
										<p class="various_artist_text"><a
												href="#">{{ $song->first_name.' '.$song->last_name }}</a></p>
									</div>

								</div>
								<script>
									getDuration("{{ url('uploads/tracks/'.$song->track_file) }}", function(length) {							
									document.getElementById("duration{{ $song->id }}").textContent = Math.trunc(length / 60) + ":" + Math.trunc(length % 60);
								});
								</script>
								<div class="top_list_tract_time" id="duration{{ $song->id }}">
								</div>
							</div>
							<div class="top_songs_list_right">
								<div class="top_list_tract_view">
									<p>{{ $song->views }} Plays</p>
								</div>
								<div class="top_song_list_picks">
									<div class="ms_tranding_more_icon">
										<i class="flaticon-menu"></i>
									</div>
									<ul class="tranding_more_option">
										<li
											onclick="addPlayList('{{ $song->track_name }}','{{ $song->first_name.' '.$song->last_name }}','{{url('uploads/tracks/'.$song->track_file) }}','{{ url('uploads/tracks/imgs/'.$song->cover_image) }}','{{ $song->id }}')">
											<a><span class="opt_icon"><i class="flaticon-playlist"></i></span>Add To
												playlist</a></li>
										<!-- <li><a href="#"><span class="opt_icon"><i class="flaticon-share"></i></span>share</a></li>
										<li><a href="#"><span class="opt_icon"><i class="flaticon-heart"></i></span>like</a></li> -->
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					{{-- @else
					<div class="text-center">
						<h6>No tracks available</h6>
					</div> --}}
					@endif
				</div>
			</div>
			<div class="col-lg-5 col-md-12 col-sm-12 col-12">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-lg-0 mt-4">
					@if(count($videoDetails) > 0)
					<h4 class="mb-3 text-center">Videos</h4>

					<div class="event_single_slider">
						<div class="owl-carousel owl-theme">
							@foreach($videoDetails as $video)
							@if($video->video_file_1 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_1.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_2 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_2.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_3 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_3.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_4 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_4.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_5 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_5.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_6 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_6.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_7 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_7.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_8 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_8.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_9 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_9.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@if($video->video_file_10 != null)
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="{{ 'https://www.youtube.com/embed/'.$video->video_file_10.'/?showinfo=0' }}"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							@endif
							@endforeach
						</div>
					</div>


					{{-- @else
					<div class="text-center">
						<h6 style="margin-bottom: 30px;">No videos available</h6>
					</div> --}}
					@endif
				</div>
				<div class="clearfix"></div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					@if(count($photoDetails) > 0)
					<h4 class="mb-3 text-center">Photos</h4>

					@if(count($photoDetails) > 1)
					<div class="event_single_slider">
						<div class="owl-carousel owl-theme heightCls">
							@foreach($photoDetails as $photo)
							<div class="item"> <img src="{{ asset('/uploads/photos/'.$photo->photo_file) }}"
									alt="blog_img"> </div>
							@endforeach
						</div>
					</div>
					@else
					<div class="event_single_slider col-12 px-0 ">
						@foreach($photoDetails as $photo)
						<img src="{{ asset('/uploads/photos/'.$photo->photo_file) }}" alt="blog_img"
							class="img-responsive w-100">
						@endforeach
					</div>
					@endif
					{{-- @else
					<div class="text-center">
						<h6>No photos available</h6>
					</div> --}}
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@endif
<!-- event wrapper end -->

@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
	function playSong(title, artist, mp3, poster, song_id) {
		var userId = '{{ Session::get('userId') }}';
		if (!userId) {
			$('#login_modal').modal('show');
			return false;
		}
		if (poster === '') {
			poster = 'images/album.png';
		}
		adonisAllPlaylists[0].pop();
		adonisAllPlaylists[0].push({
			title: title,
			artist: artist,
			mp3: mp3,
			poster: poster
		});
		adonisPlaylist.setPlaylist(adonisAllPlaylists[0]);
		//adonisPlaylist.play(0);
		setTimeout(function(){
		adonisPlaylist.play(0);
		}, 1500);
		var id = song_id;
		var artist_id = {{$userDetails['id']}};
		$.ajax({
			type: "GET",
			url: "{{url('songViewCounter')}}",
			data: {
				id: id,
				artist_id:artist_id
			},
			success: function(data) {
				//alert(JSON.stringify(data))
				//alert(data);
				$("#topSongs").html(data);
			},
		});
	}
	function addPlayList(title,artist,mp3,poster,song_id) {
		var userId = '{{ Session::get('userId') }}';
		if (!userId) {
			$('#login_modal').modal('show');
			return false;
		}
			if (poster === '') {
				poster = 'images/album.png';
			}
			//adonisAllPlaylists[0].pop();
			var isExitPlayList = 'false';
			$.each(adonisAllPlaylists[1], function (key, value) {
				if (value['title'] === title) {
					isExitPlayList = 'true';
				}
			});
			if (isExitPlayList === 'true') {
				toastr.error('Song is already added in playlist!', 'Sorry!', {timeOut: 5000})
				return false;
			}

		    adonisAllPlaylists[1].push({
				title: title,
				artist: artist,
				mp3: mp3,
				poster: poster
				});
				adonisPlaylist.setPlaylist(adonisAllPlaylists[1]);	
				toastr.success('Song added in playlist', 'Success', {timeOut: 5000})
				if (adonisAllPlaylists[1].length == 1) {
					setTimeout(function(){
						adonisPlaylist.play(0);
					}, 1500);
				}				
				
				var id = song_id;
				var artist_id = {{$userDetails['id']}};
				$.ajax({
					type: "GET",
					url: "{{url('songViewCounter')}}",
					data: {
						id: id,
						artist_id:artist_id
					},
					success: function(data) {
						//alert(JSON.stringify(data))
						//alert(data);
						$("#topSongs").html(data);
					},
				 });
				 
	}

	function getDuration(src, cb) {
		var audio = new Audio();
		jQuery(audio).on("loadedmetadata", function() {
		cb(audio.duration);
		});
		audio.src = src;
		}
</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59b7c667c23913da"></script>