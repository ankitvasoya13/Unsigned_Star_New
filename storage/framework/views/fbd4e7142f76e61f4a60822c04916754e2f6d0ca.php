<?php $__env->startSection('content'); ?> 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Top Songs</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
						<li class="breadcrumb-item">Top Songs</li>						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- About wrapper start -->
<div class="about_us_wrapper top-contain">
	<div class="container">
		<div class="row justify-content-md-center">			
			
			
			<div class="col-xl-7 col-lg-7 coll-md-7 col-sm-7 col-12">
				<div id="topSongs">
					
				</div>				
			</div>
			
		</div>
	</div>
</div>
<!-- About wrapper End --> 
<?php $__env->stopSection(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
	
	$(document).ready(function(){
		TopSongList(19);
	});
	function TopSongList(limit = null) {
		$.ajax({
			type: "GET",
			url: "<?php echo e(url('TopSongList')); ?>",
			data: { limit: limit },
			success: function(data) {
				console.log('data=',data)
				$("#topSongs").html(data);						
			},
		});
	}

	function playSong(title,artist,mp3,poster,song_id,limit) {
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
				
				setTimeout(function(){ 
					adonisPlaylist.play(0);
				}, 1500);

				var id = song_id
				$.ajax({
					type: "GET",
					url: "<?php echo e(url('TopSongList')); ?>",
					data: { id: id, limit: limit },
					success: function(data) {
						$("#topSongs").html(data);						
					},
				 });				 
	}
	function addPlayList(title,artist,mp3,poster,song_id,limit) {
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
				// if (adonisAllPlaylists[1].length == 1) {
				// 	setTimeout(function(){
				// 		adonisPlaylist.play(0);
				// 	}, 1500);
				// }				
				 
				var id = song_id
				$.ajax({
					type: "GET",
					url: "<?php echo e(url('TopSongList')); ?>",
					data: { id: id, limit: limit },
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
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>