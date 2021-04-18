<style>
    .btn-load {
        display: inline-block;
        width: 160px;
        height: 45px;
        line-height: 42px;
        text-align: center;
        background: transparent;
        color: #111111;
        border: 1px solid #e6e6e6;
        cursor: pointer;
        margin-top: 50px;
        margin-bottom: 40px;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
    }

    .btn-load:hover {
        background: -moz-linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
        background: -webkit-linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
        background: linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
        color: #fff;
        border: 1px solid rgb(248, 71, 62);
    }
</style>
<?php if($topSongCount > 0): ?>
<?php $__currentLoopData = $top_songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="top_songs_list ms_cover">
    <div class="top_songs_list_left">
        <div class="treanding_slider_main_box top_lis_left_content">
            <div class="top_songs_list0img">
                <img src="<?php echo e(url('uploads/tracks/imgs/' . $song->cover_image)); ?>" alt="img" width="50px" height="50px">
                <div class="ms_treanding_box_overlay">
                    <div class="ms_tranding_box_overlay"></div>
                    <div class="tranding_play_icon">
                        <i class="flaticon-play-button"
                    onclick="playSong('<?php echo e($song->track_name); ?>', '<?php echo e($song->first_name . ' ' . $song->last_name); ?>', '<?php echo e(url('uploads/tracks/' . $song->track_file)); ?>', '<?php echo e(url('uploads/tracks/imgs/' . $song->cover_image)); ?>','<?php echo e($song->id); ?>','<?php echo e($limit); ?>')"
                            ></i>
                    </div>
                </div>
            </div>
            <div class="release_content_artist top_list_content_artist">
                <p onclick="playSong('<?php echo e($song->track_name); ?>','<?php echo e($song->first_name.' '.$song->last_name); ?>','uploads/tracks/<?php echo e($song->track_file); ?>','<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>','<?php echo e($song->id); ?>')"><a title="<?php echo e($song->track_name); ?>" style="cursor: pointer;"><?php echo e(substr($song->track_name,0,15)); ?> ...</a></p>
                <p class="various_artist_text"><a href="profile/<?php echo e($song->artist_id); ?>"><?php echo e($song->first_name . ' ' . $song->last_name); ?></a></p>
            </div>

        </div>
        <script>
            getDuration("<?php echo e($file_url . '/'. $song->track_file); ?>", function(length) {							
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
        <div class="top_song_list_picks" style="display: none;">
            <div class="ms_tranding_more_icon">
                <i class="flaticon-menu"></i>
            </div>
            <ul class="tranding_more_option">
                <li onclick="addPlayList('<?php echo e($song->track_name); ?>', '<?php echo e($song->first_name . ' ' . $song->last_name); ?>', '<?php echo e(url('uploads/tracks/' . $song->track_file)); ?>', '<?php echo e(url('uploads/tracks/imgs/' . $song->cover_image)); ?>','<?php echo e($song->id); ?>','<?php echo e($limit); ?>')">
                    <a><span class="opt_icon"><i class="flaticon-playlist"></i></span>Add To playlist</a></li>
            </ul>
        </div>
    </div>
</div>    
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if($total > $limit && $limit != null): ?>  
   <center> <button class="btn-load" onclick="TopSongList(<?php echo e($limit); ?>)">Show more song</button></center>
<?php endif; ?>
<?php else: ?>
    <div class="feature_artist_wrapper search-artist-contain">
        <div class="container">
            <div class="row text-center" id="searchResult"><p style="margin:0 auto;">No Records Found. Please try again.</p></div>
        </div>
    </div>
<?php endif; ?>