<?php $__env->startSection('content'); ?>
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
					<h2><?php if($userDetails->user_type == '1'): ?>Artist: <?php elseif($userDetails->user_type == '2'): ?>Panel:
						<?php elseif($userDetails->user_type == '3'): ?>Fan:
						<?php endif; ?><?php echo e($userDetails->first_name.' '.$userDetails->last_name); ?></h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
						<li class="breadcrumb-item"><?php echo e($userDetails->first_name.' '.$userDetails->last_name); ?></li>
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
						<h2><?php echo e($userDetails->first_name.' '.$userDetails->last_name); ?></h2>
						<?php if($userDetails->user_type == '1' && Session()->get('userId') <> null &&
							Session()->get('userType') != '1'): ?>
							<div class="lang_apply_btn footer_cont_btn mb-4">
								<ul>
									<?php if($isFollower === 1): ?>
									<li><a href="<?php echo e(url('/unfollow/'.$userDetails->id)); ?>"> <i
												class="flaticon-play-button"></i>Unfollow</a></li>
									<!-- <a href="<?php echo e(url('/unfollow/'.$userDetails->id)); ?>">Unfollow</a> -->
									<?php else: ?>
									<li><a href="<?php echo e(url('/follow/'.$userDetails->id)); ?>"> <i
												class="flaticon-play-button"></i>Follow</a></li>
									<!-- <a href="<?php echo e(url('/follow/'.$userDetails->id)); ?>">Follow</a> -->
									<?php endif; ?>
								</ul>
							</div>
							<?php endif; ?>
					</div>
					<div class="profile-pic mb-4">
						<?php if(!empty($userDetails->profile_image)): ?>
						<img src="<?php echo e(asset('/uploads/'.$userDetails->profile_image)); ?>" alt="img" class="img-fluid"
							width="120px;">
						<?php else: ?>
						<img src="<?php echo e(asset('images/tp3.png')); ?>" alt="img" class="img-fluid" width="120px;">
						<?php endif; ?>
					</div>
					<h4 class="mb-2">
						<?php if(!empty($userDetails->city)): ?>
						<?php echo e($userDetails->city.', '.$userDetails->country); ?>

						<?php else: ?>
						<?php echo e($userDetails->country); ?>

						<?php endif; ?></h4>

					<?php if(!empty($userDetails->genre)): ?>
					<h5 class="mb-4">
						Favorite Genre: <?php echo e($userDetails->genre); ?>

					</h5>
					<?php endif; ?>
					<p><?php echo html_entity_decode($userDetails->biography); ?></p>
					<!-- <div class="lang_apply_btn footer_cont_btn">
						<ul>
							<li><a href="#"> <i class="flaticon-play-button"></i>read more</a></li>
						</ul>
					</div> -->
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 art-social-blog">
				<?php if(session('success')): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?php echo e(session('success')); ?>

					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif; ?>

				<?php if(session('error')): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php echo e(session('error')); ?>

					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif; ?>

				<?php if($userDetails->user_type == '1'): ?>
				<div class="art_social_details">
					<table class="table">
						<tr>
							<th scope="col">Followers</th>
							<th scope="col">Likes</th>
							<th scope="col">Share</th>
							<?php if(Session()->has('userType') && Session()->get('userType') == '2'): ?>
							<th scope="col">Message</th>
							<?php endif; ?>
						</tr>
						<tr>
							<td class="artist-follower"><img src="/images/followers_icon.png"
									style="width: 30px !important; height: 20px !important;" /> (<?php echo e($totalFollower); ?>)
							</td>
							
							<?php if(Session()->get('userId') <> null && Session()->get('userType') !== '1'): ?>
								<?php if($isLike == '1'): ?>
								<td class="artist-like"><a href="<?php echo e(url('/dislike/'.$userDetails->id)); ?>"><i
											class="fas fa-heart"></i> (<?php echo e($totalLikes); ?>)</a></td>
								<?php else: ?>
								<td class="artist-dislike"><a href="<?php echo e(url('/like/'.$userDetails->id)); ?>"><i
											class="fas fa-heart"></i> (<?php echo e($totalLikes); ?>)</a></td>
								<?php endif; ?>
								<?php else: ?>
								<td class="artist-dislike"><i class="fas fa-heart"></i>(<?php echo e($totalLikes); ?>)</td>
								<?php endif; ?>

								<td class="artist-share">
									<div class="addthis_inline_share_toolbox"></div>
								</td>

								<?php if(Session()->has('userType') && Session()->get('userType') == '2'): ?>
								<td class="artist-message"><a
										href="<?php echo e(url('/profile/'.$userDetails->id.'/message')); ?>"><i
											class="flaticon-close-envelope"></i></a></td>
								<?php endif; ?>
						</tr>
					</table>
					<?php endif; ?>


					<?php if($userDetails->user_type == '1'): ?>
					<?php if(count($followerDetails) > 0): ?>
					<h5 class="mt-4">Fans</h5>
					<div class="row mt-3">
						<?php $__currentLoopData = $followerDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3" style="text-align: center;color:darkblue">
							<a
								href="<?php echo e(url('/profile/'.$follower->id.'/'.$follower->first_name . '-' . $follower->last_name)); ?>">
								<img src="<?php echo e(asset('uploads/'.$follower->profile_image)); ?>"
									alt="<?php echo e($follower->first_name.' '.$follower->last_name); ?>" class="img-fluid"></a>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php elseif($userDetails->user_type == '2' || $userDetails->user_type == '3'): ?>

				<?php if(count($followingDetails) > 0): ?>
				<div class="art_social_details">
					<h5>Following</h5>
					<div class="row mt-3">
						<?php $__currentLoopData = $followingDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $following): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3" style="text-align: center;color:darkblue">
							<a
								href="<?php echo e(url('/profile/'.$following->id.'/'.$following->first_name . '-' . $following->last_name)); ?>">
								<img src="<?php echo e(asset('uploads/'.$following->profile_image)); ?>"
									alt="<?php echo e($following->first_name.' '.$following->last_name); ?>" class="img-fluid"> </a>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<?php endif; ?>

				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
<!-- artist page wrapper End -->
<!-- event wrapper start -->
<?php if($userDetails->user_type == '1'): ?>
<div class="art_work_list_wrapper">
	<?php if(count($videoDetails) > 0 || count($top_songs) > 0 || count($photoDetails) > 0): ?>
	<div class="concert_overlay"></div>
	<?php endif; ?>
	<div class="container">
		<div class="row">

			<div class="col-lg-7 col-md-12 col-sm-12 col-12">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<?php if(count($top_songs) > 0): ?>
					<h4 class="mb-3 text-center">Tracks</h4>

					


					<div id="topSongs">
						<?php $__currentLoopData = $top_songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="top_songs_list ms_cover">
							<div class="top_songs_list_left">
								<div class="treanding_slider_main_box top_lis_left_content">
									<div class="top_songs_list0img">
										<img src="<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>" alt="img"
											width="50px" height="50px">
										<div class="ms_treanding_box_overlay">
											<div class="ms_tranding_box_overlay"></div>

											<div class="tranding_play_icon">
												
												<i class="flaticon-play-button"
													onclick="playSong('<?php echo e($song->track_name); ?>','<?php echo e($song->first_name.' '.$song->last_name); ?>','<?php echo e(url('uploads/tracks/'.$song->track_file)); ?>','<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>','<?php echo e($song->id); ?>')"></i>
												
											</div>
										</div>
									</div>
									<div class="release_content_artist top_list_content_artist"
										onclick="playSong('<?php echo e($song->track_name); ?>','<?php echo e($song->first_name.' '.$song->last_name); ?>','<?php echo e(url('uploads/tracks/'.$song->track_file)); ?>','<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>','<?php echo e($song->id); ?>')"
										style="cursor: pointer;">
										<p><a
												title="<?php echo e($song->track_name); ?>"><?php echo e(substr($song->track_name,0,15)); ?>...</a>
										</p>
										<p class="various_artist_text"><a
												href="#"><?php echo e($song->first_name.' '.$song->last_name); ?></a></p>
									</div>

								</div>
								<script>
									getDuration("<?php echo e(url('uploads/tracks/'.$song->track_file)); ?>", function(length) {							
									document.getElementById("duration<?php echo e($song->id); ?>").textContent = Math.trunc(length / 60) + ":" + Math.trunc(length % 60);
								});
								</script>
								<div class="top_list_tract_time" id="duration<?php echo e($song->id); ?>">
								</div>
							</div>
							<div class="top_songs_list_right">
								<div class="top_list_tract_view">
									<p><?php echo e($song->views); ?> Plays</p>
								</div>
								<div class="top_song_list_picks">
									<div class="ms_tranding_more_icon">
										<i class="flaticon-menu"></i>
									</div>
									<ul class="tranding_more_option">
										<li
											onclick="addPlayList('<?php echo e($song->track_name); ?>','<?php echo e($song->first_name.' '.$song->last_name); ?>','<?php echo e(url('uploads/tracks/'.$song->track_file)); ?>','<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>','<?php echo e($song->id); ?>')">
											<a><span class="opt_icon"><i class="flaticon-playlist"></i></span>Add To
												playlist</a></li>
										<!-- <li><a href="#"><span class="opt_icon"><i class="flaticon-share"></i></span>share</a></li>
										<li><a href="#"><span class="opt_icon"><i class="flaticon-heart"></i></span>like</a></li> -->
									</ul>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-5 col-md-12 col-sm-12 col-12">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-lg-0 mt-4">
					<?php if(count($videoDetails) > 0): ?>
					<h4 class="mb-3 text-center">Videos</h4>

					<div class="event_single_slider">
						<div class="owl-carousel owl-theme">
							<?php $__currentLoopData = $videoDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($video->video_file_1 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_1.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_2 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_2.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_3 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_3.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_4 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_4.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_5 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_5.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_6 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_6.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_7 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_7.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_8 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_8.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_9 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_9.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php if($video->video_file_10 != null): ?>
							<div class="item">
								<iframe id="youtube" width="100%" height="350"
									src="<?php echo e('https://www.youtube.com/embed/'.$video->video_file_10.'/?showinfo=0'); ?>"
									frameborder="0" allowfullscreen style="margin-bottom: 30px;"></iframe>
							</div>
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>


					
					<?php endif; ?>
				</div>
				<div class="clearfix"></div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<?php if(count($photoDetails) > 0): ?>
					<h4 class="mb-3 text-center">Photos</h4>

					<?php if(count($photoDetails) > 1): ?>
					<div class="event_single_slider">
						<div class="owl-carousel owl-theme heightCls">
							<?php $__currentLoopData = $photoDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item"> <img src="<?php echo e(asset('/uploads/photos/'.$photo->photo_file)); ?>"
									alt="blog_img"> </div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
					<?php else: ?>
					<div class="event_single_slider col-12 px-0 ">
						<?php $__currentLoopData = $photoDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<img src="<?php echo e(asset('/uploads/photos/'.$photo->photo_file)); ?>" alt="blog_img"
							class="img-responsive w-100">
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php endif; ?>
					
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</div>
<?php endif; ?>
<!-- event wrapper end -->

<?php $__env->stopSection(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
	function playSong(title, artist, mp3, poster, song_id) {
		var userId = '<?php echo e(Session::get('userId')); ?>';
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
		var artist_id = <?php echo e($userDetails['id']); ?>;
		$.ajax({
			type: "GET",
			url: "<?php echo e(url('songViewCounter')); ?>",
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
		var userId = '<?php echo e(Session::get('userId')); ?>';
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
				var artist_id = <?php echo e($userDetails['id']); ?>;
				$.ajax({
					type: "GET",
					url: "<?php echo e(url('songViewCounter')); ?>",
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
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>