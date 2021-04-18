<?php $__env->startSection('content'); ?>
<!-- slider wrapper start -->
<div class="main_slider_wrapper slider-area">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="carousel-item <?php if($i==0): ?> active <?php endif; ?>">
				<div class="carousel-captions caption-3">
					<div class="container jn_container">
						<div class="row align-items-center">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
								<img src="<?php echo e(asset('images/main-banner.jpg')); ?>" alt="blog_img" class="w-100">
							</div>
							<!--<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 pr-0">
								<div class="content">
									<h1 data-animation="animated fadeInUp"><?php echo e($slider->heading_1); ?></h1>
									<h2 data-animation="animated fadeInUp"><?php echo e($slider->heading_2); ?></h2>
									<p data-animation="animated fadeInUp"><?php echo e(strip_tags($slider->description)); ?></p>
									<div class="slider_btn ms_cover">
										<div class="lang_apply_btn">
											<ul>
												<li data-animation="animated fadeInUp">
													<a href="<?php echo e($slider->button_url); ?>"> <i class="flaticon-play-button"></i>browse</a>
												</li>
											</ul>

										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
							<div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 px-0">
								<div class="content_img_wrapper">
									<img src="<?php echo e(asset('uploads/'.$slider->slider_image)); ?>" alt="img">
								</div>
							</div>-->

						</div>
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<!--<ol class="carousel-indicators">
				<?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li data-target="#carousel-example-generic" data-slide-to="<?php echo e($i); ?>" class="<?php if($i==0): ?> active <?php endif; ?>"><span class="number"></span>
				</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ol>-->
			<div class="carousel-nevigation">
				<a class="prev" href="#carousel-example-generic" role="button" data-slide="prev"> <span> prev</span> <i class="flaticon-arrow-1"></i>
				</a>
				<a class="next" href="#carousel-example-generic" role="button" data-slide="next"> <span> next</span> <i class="flaticon-arrow"></i>
				</a>
			</div>
		</div>
	</div>
</div>
<!--Start Design By J -->
<div class="music_details_wrapper">
	<div class="container">
		<div class="row text-center">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2">
				<div class="music-artist-search bg-white musicsearch-pad music_blog">
					<h5>Artist Search</h5>
					<br>
					<select name="country" id="artistCountry" class="col-lg-12 col-md-12 col-sm-12 col-12 js-example-basic-single country-border">
						<option>All Countries</option>
						<option value="United States of America">United States of America</option>
                    	<option value="Australia">Australia</option>
                    	<option value="United Kingdom">United Kingdom</option>
						<option value="Afganistan">Afghanistan</option>
						<option value="Albania">Albania</option>
						<option value="Algeria">Algeria</option>
						<option value="American Samoa">American Samoa</option>
						<option value="Andorra">Andorra</option>
						<option value="Angola">Angola</option>
						<option value="Anguilla">Anguilla</option>
						<option value="Antigua & Barbuda">Antigua & Barbuda</option>
						<option value="Argentina">Argentina</option>
						<option value="Armenia">Armenia</option>
						<option value="Aruba">Aruba</option>
						<option value="Austria">Austria</option>
						<option value="Azerbaijan">Azerbaijan</option>
						<option value="Bahamas">Bahamas</option>
						<option value="Bahrain">Bahrain</option>
						<option value="Bangladesh">Bangladesh</option>
						<option value="Barbados">Barbados</option>
						<option value="Belarus">Belarus</option>
						<option value="Belgium">Belgium</option>
						<option value="Belize">Belize</option>
						<option value="Benin">Benin</option>
						<option value="Bermuda">Bermuda</option>
						<option value="Bhutan">Bhutan</option>
						<option value="Bolivia">Bolivia</option>
						<option value="Bonaire">Bonaire</option>
						<option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
						<option value="Botswana">Botswana</option>
						<option value="Brazil">Brazil</option>
						<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
						<option value="Brunei">Brunei</option>
						<option value="Bulgaria">Bulgaria</option>
						<option value="Burkina Faso">Burkina Faso</option>
						<option value="Burundi">Burundi</option>
						<option value="Cambodia">Cambodia</option>
						<option value="Cameroon">Cameroon</option>
						<option value="Canada">Canada</option>
						<option value="Canary Islands">Canary Islands</option>
						<option value="Cape Verde">Cape Verde</option>
						<option value="Cayman Islands">Cayman Islands</option>
						<option value="Central African Republic">Central African Republic</option>
						<option value="Chad">Chad</option>
						<option value="Channel Islands">Channel Islands</option>
						<option value="Chile">Chile</option>
						<option value="China">China</option>
						<option value="Christmas Island">Christmas Island</option>
						<option value="Cocos Island">Cocos Island</option>
						<option value="Colombia">Colombia</option>
						<option value="Comoros">Comoros</option>
						<option value="Congo">Congo</option>
						<option value="Cook Islands">Cook Islands</option>
						<option value="Costa Rica">Costa Rica</option>
						<option value="Cote DIvoire">Cote DIvoire</option>
						<option value="Croatia">Croatia</option>
						<option value="Cuba">Cuba</option>
						<option value="Curaco">Curacao</option>
						<option value="Cyprus">Cyprus</option>
						<option value="Czech Republic">Czech Republic</option>
						<option value="Denmark">Denmark</option>
						<option value="Djibouti">Djibouti</option>
						<option value="Dominica">Dominica</option>
						<option value="Dominican Republic">Dominican Republic</option>
						<option value="East Timor">East Timor</option>
						<option value="Ecuador">Ecuador</option>
						<option value="Egypt">Egypt</option>
						<option value="El Salvador">El Salvador</option>
						<option value="Equatorial Guinea">Equatorial Guinea</option>
						<option value="Eritrea">Eritrea</option>
						<option value="Estonia">Estonia</option>
						<option value="Ethiopia">Ethiopia</option>
						<option value="Falkland Islands">Falkland Islands</option>
						<option value="Faroe Islands">Faroe Islands</option>
						<option value="Fiji">Fiji</option>
						<option value="Finland">Finland</option>
						<option value="France">France</option>
						<option value="French Guiana">French Guiana</option>
						<option value="French Polynesia">French Polynesia</option>
						<option value="French Southern Ter">French Southern Ter</option>
						<option value="Gabon">Gabon</option>
						<option value="Gambia">Gambia</option>
						<option value="Georgia">Georgia</option>
						<option value="Germany">Germany</option>
						<option value="Ghana">Ghana</option>
						<option value="Gibraltar">Gibraltar</option>
						<option value="Great Britain">Great Britain</option>
						<option value="Greece">Greece</option>
						<option value="Greenland">Greenland</option>
						<option value="Grenada">Grenada</option>
						<option value="Guadeloupe">Guadeloupe</option>
						<option value="Guam">Guam</option>
						<option value="Guatemala">Guatemala</option>
						<option value="Guinea">Guinea</option>
						<option value="Guyana">Guyana</option>
						<option value="Haiti">Haiti</option>
						<option value="Hawaii">Hawaii</option>
						<option value="Honduras">Honduras</option>
						<option value="Hong Kong">Hong Kong</option>
						<option value="Hungary">Hungary</option>
						<option value="Iceland">Iceland</option>
						<option value="Indonesia">Indonesia</option>
						<option value="India">India</option>
						<option value="Iran">Iran</option>
						<option value="Iraq">Iraq</option>
						<option value="Ireland">Ireland</option>
						<option value="Isle of Man">Isle of Man</option>
						<option value="Israel">Israel</option>
						<option value="Italy">Italy</option>
						<option value="Jamaica">Jamaica</option>
						<option value="Japan">Japan</option>
						<option value="Jordan">Jordan</option>
						<option value="Kazakhstan">Kazakhstan</option>
						<option value="Kenya">Kenya</option>
						<option value="Kiribati">Kiribati</option>
						<option value="Korea North">Korea North</option>
						<option value="Korea Sout">Korea South</option>
						<option value="Kuwait">Kuwait</option>
						<option value="Kyrgyzstan">Kyrgyzstan</option>
						<option value="Laos">Laos</option>
						<option value="Latvia">Latvia</option>
						<option value="Lebanon">Lebanon</option>
						<option value="Lesotho">Lesotho</option>
						<option value="Liberia">Liberia</option>
						<option value="Libya">Libya</option>
						<option value="Liechtenstein">Liechtenstein</option>
						<option value="Lithuania">Lithuania</option>
						<option value="Luxembourg">Luxembourg</option>
						<option value="Macau">Macau</option>
						<option value="Macedonia">Macedonia</option>
						<option value="Madagascar">Madagascar</option>
						<option value="Malaysia">Malaysia</option>
						<option value="Malawi">Malawi</option>
						<option value="Maldives">Maldives</option>
						<option value="Mali">Mali</option>
						<option value="Malta">Malta</option>
						<option value="Marshall Islands">Marshall Islands</option>
						<option value="Martinique">Martinique</option>
						<option value="Mauritania">Mauritania</option>
						<option value="Mauritius">Mauritius</option>
						<option value="Mayotte">Mayotte</option>
						<option value="Mexico">Mexico</option>
						<option value="Midway Islands">Midway Islands</option>
						<option value="Moldova">Moldova</option>
						<option value="Monaco">Monaco</option>
						<option value="Mongolia">Mongolia</option>
						<option value="Montserrat">Montserrat</option>
						<option value="Morocco">Morocco</option>
						<option value="Mozambique">Mozambique</option>
						<option value="Myanmar">Myanmar</option>
						<option value="Nambia">Nambia</option>
						<option value="Nauru">Nauru</option>
						<option value="Nepal">Nepal</option>
						<option value="Netherland Antilles">Netherland Antilles</option>
						<option value="Netherlands">Netherlands (Holland, Europe)</option>
						<option value="Nevis">Nevis</option>
						<option value="New Caledonia">New Caledonia</option>
						<option value="New Zealand">New Zealand</option>
						<option value="Nicaragua">Nicaragua</option>
						<option value="Niger">Niger</option>
						<option value="Nigeria">Nigeria</option>
						<option value="Niue">Niue</option>
						<option value="Norfolk Island">Norfolk Island</option>
						<option value="Norway">Norway</option>
						<option value="Oman">Oman</option>
						<option value="Pakistan">Pakistan</option>
						<option value="Palau Island">Palau Island</option>
						<option value="Palestine">Palestine</option>
						<option value="Panama">Panama</option>
						<option value="Papua New Guinea">Papua New Guinea</option>
						<option value="Paraguay">Paraguay</option>
						<option value="Peru">Peru</option>
						<option value="Phillipines">Philippines</option>
						<option value="Pitcairn Island">Pitcairn Island</option>
						<option value="Poland">Poland</option>
						<option value="Portugal">Portugal</option>
						<option value="Puerto Rico">Puerto Rico</option>
						<option value="Qatar">Qatar</option>
						<option value="Republic of Montenegro">Republic of Montenegro</option>
						<option value="Republic of Serbia">Republic of Serbia</option>
						<option value="Reunion">Reunion</option>
						<option value="Romania">Romania</option>
						<option value="Russia">Russia</option>
						<option value="Rwanda">Rwanda</option>
						<option value="St Barthelemy">St Barthelemy</option>
						<option value="St Eustatius">St Eustatius</option>
						<option value="St Helena">St Helena</option>
						<option value="St Kitts-Nevis">St Kitts-Nevis</option>
						<option value="St Lucia">St Lucia</option>
						<option value="St Maarten">St Maarten</option>
						<option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
						<option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
						<option value="Saipan">Saipan</option>
						<option value="Samoa">Samoa</option>
						<option value="Samoa American">Samoa American</option>
						<option value="San Marino">San Marino</option>
						<option value="Sao Tome & Principe">Sao Tome & Principe</option>
						<option value="Saudi Arabia">Saudi Arabia</option>
						<option value="Senegal">Senegal</option>
						<option value="Seychelles">Seychelles</option>
						<option value="Sierra Leone">Sierra Leone</option>
						<option value="Singapore">Singapore</option>
						<option value="Slovakia">Slovakia</option>
						<option value="Slovenia">Slovenia</option>
						<option value="Solomon Islands">Solomon Islands</option>
						<option value="Somalia">Somalia</option>
						<option value="South Africa">South Africa</option>
						<option value="Spain">Spain</option>
						<option value="Sri Lanka">Sri Lanka</option>
						<option value="Sudan">Sudan</option>
						<option value="Suriname">Suriname</option>
						<option value="Swaziland">Swaziland</option>
						<option value="Sweden">Sweden</option>
						<option value="Switzerland">Switzerland</option>
						<option value="Syria">Syria</option>
						<option value="Tahiti">Tahiti</option>
						<option value="Taiwan">Taiwan</option>
						<option value="Tajikistan">Tajikistan</option>
						<option value="Tanzania">Tanzania</option>
						<option value="Thailand">Thailand</option>
						<option value="Togo">Togo</option>
						<option value="Tokelau">Tokelau</option>
						<option value="Tonga">Tonga</option>
						<option value="Trinidad & Tobago">Trinidad & Tobago</option>
						<option value="Tunisia">Tunisia</option>
						<option value="Turkey">Turkey</option>
						<option value="Turkmenistan">Turkmenistan</option>
						<option value="Turks & Caicos Is">Turks & Caicos Is</option>
						<option value="Tuvalu">Tuvalu</option>
						<option value="Uganda">Uganda</option>
						<option value="Ukraine">Ukraine</option>
						<option value="United Arab Erimates">United Arab Emirates</option>
						<option value="Uraguay">Uruguay</option>
						<option value="Uzbekistan">Uzbekistan</option>
						<option value="Vanuatu">Vanuatu</option>
						<option value="Vatican City State">Vatican City State</option>
						<option value="Venezuela">Venezuela</option>
						<option value="Vietnam">Vietnam</option>
						<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
						<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
						<option value="Wake Island">Wake Island</option>
						<option value="Wallis & Futana Is">Wallis & Futana Is</option>
						<option value="Yemen">Yemen</option>
						<option value="Zaire">Zaire</option>
						<option value="Zambia">Zambia</option>
						<option value="Zimbabwe">Zimbabwe</option>							
					</select>
					<br><br>
					<select name="genres" id="artistGenres" class="col-lg-12 col-md-12 col-sm-12 col-12 js-example-basic-single">
						<option>All Genres</option>
						<option value="Jazz">Jazz</option>
	                    <option value="Rock">Rock</option>
	                    <option value="Pop">Pop</option>
	                    <option value="Folk">Folk</option>
	                    <option value="Classical">Classical</option>
	                    <option value="Heavy Metal">Heavy Metal</option>
	                    <option value="Punk Rock">Punk Rock</option>
	                    <option value="Soul">Soul</option>
	                    <option value="Hip Hop">Hip Hop</option>
	                    <option value="Reggae">Reggae</option>
	                    <option value="Funk">Funk</option>
	                    <option value="Disco">Disco</option>
	                    <option value="Techno">Techno</option>
	                    <option value="Instrumental">Instrumental</option>
					</select>
					<br><br>
					
						<div class="form-group">
							<input type="text" class="form-control" id="artistSearchText" placeholder="Search">
							<i class="fa fa-search search-icon" onclick="searchArtist(8)"></i>
						</div>
						<input type="hidden" name="type" value="home" id="artistType">
					
				</div>
				
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2 desktop">
				<div class="bg-white music_blog">
					<div class="music-artist-search musicsearch-pad">
						<h5>Our Panel</h5>
					</div>
					<div class="event_single_slider">
						<div class="owl-carousel owl-theme">
							<?php $__currentLoopData = $panelUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $panel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item">
								<a href="<?php echo e(url('/profile/'.$panel->id.'/'.$panel->first_name . '-' . $panel->last_name)); ?>">
									<?php if(!empty($panel->profile_image)): ?>
									<img src="<?php echo e(asset('/uploads/'.$panel->profile_image)); ?>" alt="blog_img">
									<?php else: ?>
									<img src="<?php echo e(asset('images/blog1.png')); ?>" alt="blog_img">
									<?php endif; ?>
								</a>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2 desktop">
				<div class="bg-white music_blog">
					<div class="music-artist-search musicsearch-pad">
						<h5>Competitions</h5>
					</div>
					<?php $__currentLoopData = $competitionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(url('/competitions/competitionDetails/'.$competition->id)); ?>"><img src="<?php echo e(asset('/uploads/'.$competition->featured_image)); ?>" class="img-responsive" width="269px"></a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2 desktop">
				<div class="bg-white music_blog">
					<div class="music-artist-search bg-white musicsearch-pad">
						<h5>Success Stories</h5>
					</div>
					<?php $__currentLoopData = $storyDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(url('/success-stories/storyDetails/'.$story->id)); ?>"><img src="<?php echo e(asset('/uploads/'.$story->featured_image)); ?>" class="img-responsive" width="269px"></a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!--End Design -->
<!--slider wrapper end-->
<!-- feature artist wrapper start -->
<div class="feature_artist_wrapper search-artist-contain">
	<div class="container">
		<div class="row text-center" id="searchResult">
			
			
		</div>
	</div>
</div>
<!-- new release wrapper end -->

<!-- mobile sections start-->
<div class="music_details_wrapper mobile">
	<div class="container">
		<div class="row text-center">
			<div class="col-lg-3 col-md-12 col-sm-12 col-12 p-2">
				<div class="bg-white music_blog">
					<div class="music-artist-search p-2">
						<h5>Our Panel</h5>
					</div>
					<div class="event_single_slider">
						<div class="owl-carousel owl-theme">
							<?php $__currentLoopData = $panelUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $panel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item">
								<a href="<?php echo e(url('/profile/'.$panel->id.'/'.$panel->first_name . '-' . $panel->last_name)); ?>">
									<?php if(!empty($panel->profile_image)): ?>
									<img src="<?php echo e(asset('/uploads/'.$panel->profile_image)); ?>" alt="blog_img">
									<?php else: ?>
									<img src="<?php echo e(asset('images/blog1.png')); ?>" alt="blog_img">
									<?php endif; ?>
								</a>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2 desktop">
				<div class="bg-white music_blog">
					<div class="music-artist-search musicsearch-pad">
						<h5>Competitions</h5>
					</div>
					
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2 desktop">
				<div class="bg-white music_blog">
					<div class="music-artist-search bg-white musicsearch-pad">
						<h5>Success Stories</h5>
					</div>
					<?php $__currentLoopData = $storyDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(url('/success-stories/storyDetails/'.$story->id)); ?>"><img src="<?php echo e(asset('/uploads/'.$story->featured_image)); ?>" class="img-responsive" width="269px"></a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- mobile sections end -->


<!-- top songs wrapper start -->
<div class="top_songs_wrapper ms_cover">
	<div class="container">
		<div class="row">
			<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
				<div class="song_heading_wrapper ms_cover">
					<div class="ms_heading_wrapper">
						<h1>top songs</h1>
					</div>
					<!-- <div class="relaese_viewall_wrapper">
						<a href="#"> view all <i class="flaticon-right-arrow"></i></a>
					</div> -->
					<div id="topSongs">
					<?php $__currentLoopData = $top_songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="top_songs_list ms_cover">
						<div class="top_songs_list_left">
							<div class="treanding_slider_main_box top_lis_left_content">
								<div class="top_songs_list0img">
									<img src="<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>" onerror="this.src='images/album.png'" alt="img" width="50px" height="50px">
									<div class="ms_treanding_box_overlay">
										<div class="ms_tranding_box_overlay"></div>

										<div class="tranding_play_icon">
											
												<i class="flaticon-play-button" onclick="playSong('<?php echo e($song->track_name); ?>',' <?php echo e($song->first_name.' '.$song->last_name); ?>','uploads/tracks/<?php echo e($song->track_file); ?>','<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>','<?php echo e($song->id); ?>')"></i>
											
										</div>
									</div>
								</div>
								<div class="release_content_artist top_list_content_artist">
									<p onclick="playSong('<?php echo e($song->track_name); ?>','<?php echo e($song->first_name.' '.$song->last_name); ?>','uploads/tracks/<?php echo e($song->track_file); ?>','<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>','<?php echo e($song->id); ?>')"><a title="<?php echo e($song->track_name); ?>" style="cursor: pointer;"><?php echo e(substr($song->track_name,0,15)); ?> ...</a></p>
									<p class="various_artist_text"><a href="profile/<?php echo e($song->artist_id); ?>"><?php echo e($song->first_name . ' ' . $song->last_name); ?></a></p>
								</div>
								
							</div>
							<script>
							getDuration("uploads/tracks/<?php echo e($song->track_file); ?>", function(length) {							
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
									<li onclick="addPlayList('<?php echo e($song->track_name); ?>','<?php echo e($song->first_name.' '.$song->last_name); ?>','uploads/tracks/<?php echo e($song->track_file); ?>','<?php echo e(url('uploads/tracks/imgs/'.$song->cover_image)); ?>', '<?php echo e($song->id); ?>')"><a><span class="opt_icon"><i class="flaticon-playlist"></i></span>Add To playlist</a></li>
									<!-- <li><a href="#"><span class="opt_icon"><i class="flaticon-share"></i></span>share</a></li>
									<li><a href="#"><span class="opt_icon"><i class="flaticon-heart"></i></span>like</a></li> -->
								</ul>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
			<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

				<div class="ms_heading_wrapper">
					<h1>Featured Artists</h1>
				</div>

				<div class="featured_song_slider">
					<div class="owl-carousel owl-theme">
						<?php
							$counter = 0; 
							$limit = count($sliderArtists);

							echo "<div class='item'>";

							foreach($sliderArtists as $sliderArtist) {
								?>
								<div class="featured_artist_list ms_cover">
									<a href="<?php echo e(url('/profile/'.$sliderArtist->id.'/'.$sliderArtist->first_name . '-' . $sliderArtist->last_name)); ?>"><img src="<?php echo e(asset('/uploads/'.$sliderArtist->profile_image)); ?>" class="img-responsive" alt="img"></a>
									<div class="featured_artist_detail">
										<p><a href="<?php echo e(url('/profile/'.$sliderArtist->id.'/'.$sliderArtist->first_name . '-' . $sliderArtist->last_name)); ?>"><?php echo e($sliderArtist->first_name.' '.$sliderArtist->last_name); ?></a></p>
									</div>
								</div>
								<?php
								if (++$counter % 4 === 0 && $counter < $limit) {
									echo "</div><div>";
								}
							}
							echo "</div>";
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- top songs wrapper end -->
<!-- concert wrapper start 

<a class="test-popup-link button" rel="external" href="" title="Streaming Live"><img src="../images/1920x300-02.jpg" style="width:100%; height:auto;"></a>
-->
<!-- concert wrapper end -->

<?php echo $__env->make('layouts.join', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- pricing wrapper end -->
<?php $__env->stopSection(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
	function getDuration(src, cb) {
	var audio = new Audio();
	jQuery(audio).on("loadedmetadata", function() {
	cb(audio.duration);
	});
	audio.src = src;
	}
</script>
<script>
	function playSong(title,artist,mp3,poster,song_id) {
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
					url: "<?php echo e(url('songViewCounter')); ?>",
					data: { id: id },
					success: function(data) {
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
				// if (adonisAllPlaylists[1].length == 1) {
				// 	setTimeout(function(){
				// 		adonisPlaylist.play(0);
				// 	}, 1500);
				// }				
				 
				var id = song_id
				$.ajax({
					type: "GET",
					url: "songViewCounter",
					data: { id: id },
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