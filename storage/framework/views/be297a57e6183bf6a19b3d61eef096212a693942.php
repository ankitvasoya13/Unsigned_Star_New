<?php $__env->startSection('content'); ?>
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Profile</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
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
				<?php if(Session::has('error')): ?>
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo session('error'); ?>

				</div>
				<?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

				<?php if(Session::has('success')): ?>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo session('success'); ?>

				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px;">
				<div class="ms_heading_wrapper artist_dashboard">
					<h1>Profile Details</h1>
				</div><br clear="all"/> 
				<?php if($userDetails->user_type == 1): ?>

				<div class="card text-center">
                    <?php if(count($agreementDetails) > 0): ?>
					<div class="card-header">
						
                        <div class="row">
                        <div class="col-lg-4 col-md-4 extraPadding resPadding">
                            <span class="float-left paddinfLeft">Profile :
                                <?php if($userDetails->remainingDays > 0 || $endDate == $currentDate): ?>
                                    <span class="text-success">Active</span>
                                <?php else: ?>
                                    <span class="text-danger">Inactive</span>
                                <?php endif; ?>
						</span>
                        </div>
                        <div class="col-lg-4 col-md-4 extraPadding resPadding">
                            <span class="current_plan_name">current plan: <?php echo e($agreementDetails[0]->plan_name); ?></span>
                        </div>
                            <?php if($userDetails->remainingDays <= 0 &&  $endDate != $currentDate): ?>

                            <?php else: ?>
                                <div class="col-lg-4 col-md-4 resPadding">
                                    <spann class="float-right"> Auto Renewal : <?php echo e($agreementDetails[0]->status == 'ACTIVE' ? 'ON':'OFF'); ?>

                                        <?php if($agreementDetails[0]->status == 'ACTIVE'): ?>
                                            <a href="<?php echo e(url('subscriber/suspend/'.$agreementDetails[0]->subscriptionID)); ?>" class="orangeBtn" style="height: 35px;padding: 5px;">Turn OFF</a>
                                        <?php else: ?>
                                            <a href="<?php echo e(url('subscriber/activate/'.$agreementDetails[0]->subscriptionID)); ?>" class="orangeBtn" style="height: 35px;padding: 5px;">Turn ON</a>
                                        <?php endif; ?>
                                    </spann>
                                </div>
                            <?php endif; ?>
                        </div>
					</div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-4 col-md-4 resPadding ">

                                <?php if($userDetails->remainingDays > 0 || $endDate == $currentDate): ?>
                                    <?php if($userDetails->end_validity > 0): ?>
                                        <span class="float-left ">Plan Expire : <?php echo e(date('m/d/Y', strtotime($userDetails->end_validity))); ?> <span class="text-danger">(<?php echo e(($userDetails->remainingDays < 0)? '0': $userDetails->remainingDays); ?> <?php if($userDetails->remainingDays > 1): ?> days <?php else: ?> day <?php endif; ?> remaining)</span> </span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="float-left ">   Plan Expire : (<span class="text-danger">Expired</span>)</span>
                                <?php endif; ?>

                            </div>
                            <div class="col-lg-4 col-md-4 resPadding">
                                <?php if($userDetails->remainingDays > 0 || $endDate == $currentDate): ?>
                                    Next Renewal Date: <?php echo e(date('m/d/Y', strtotime($userDetails->end_validity))); ?>

                                <?php else: ?>
                                    Next Renewal Date:  N/A
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 resPadding">
                                <?php if($userDetails->remainingDays > 0 || $endDate == $currentDate): ?>
                                    <spann class="float-right"> Next Payment Amount: $<?php echo e($activePlanDetails->price); ?> </spann>
                                <?php else: ?>
                                    <spann class="float-right"> Next Payment Amount: N/A </spann>
                                <?php endif; ?>
                            </div>
                         </div>

                        
                        <hr>
                        <?php if(count($agreementDetails)): ?>
                            
                            <p class="card-text"><?php echo e($agreementDetails[0]->plan_description); ?></p>
                            <p>Track Limit : <?php echo e(($agreementDetails[0]->track_limit - $agreementDetails[0]->remain_track_limit)); ?> (Total: <?php echo e($agreementDetails[0]->track_limit); ?>)</p>
                            
                            <?php if($userDetails->remainingDays <= 0 &&  $endDate != $currentDate): ?>
                                <hr>
                                <a href="<?php echo e(url('subscribe/agreement_update/'.$agreementDetails[0]->subscriptionID)); ?>" class="orangeBtn" style="width: 250px">Click to activate your plan</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <p>Your plan is Inactive. Please choose any one plan & activate your profile.</p>
                        <?php endif; ?>

                    </div>
                    <?php endif; ?>
                    <div class="card-footer">
                        <p>
                            <?php if(count($agreementDetails)): ?>
                                <?php if($userDetails->remainingDays > 0 || $endDate == $currentDate): ?>

                                    
                                    <?php if($agreementDetails[0]->track_limit == $agreementDetails[0]->remain_track_limit): ?>
                                        <?php $__currentLoopData = $planDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($agreementDetails[0]->plan_id != $plan->plan_id ): ?>
                                                <a href="<?php echo e(url('subscribe/plan/'.$plan->plan_id)); ?>" class="submitForm" style="float: right; margin:1px 1px;"><?php echo e($plan->plan_name); ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($planDetails) > 1): ?>
                                            <span style="float: right; margin:12px;">Upgrade New Plan : </span>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                <?php else: ?>
                                    
                                    <?php $__currentLoopData = $planDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($agreementDetails[0]->plan_id != $plan->plan_id ): ?>
                                            <a href="<?php echo e(url('subscribe/plan/'.$plan->plan_id)); ?>" class="submitForm" style="float: right; margin:1px 1px;"><?php echo e($plan->plan_name); ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(count($planDetails) > 1): ?>
                                        <span style="float: right; margin:12px;">Upgrade New Plan : </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $planDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(url('subscribe/plan/'.$plan->plan_id)); ?>" class="submitForm" style="float: right; margin:1px 1px;"><?php echo e($plan->plan_name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </p>
                    </div>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<div class=" row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
				<ul class="nav nav-tabs text-center" id="myTab" role="tablist">
					<li class="nav-item col-xl-2"> <a class="nav-link active" id="artist-tab" data-toggle="tab" href="#artist" role="tab" aria-controls="artist" aria-selected="true"><i class="flaticon-vinyl"></i> My Profile</a> </li>
					<li class="nav-item col-xl-2"> <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false"><i class="fa fa-eye"></i> Password</a> </li>
					<?php if($userDetails->user_type == 1): ?>
					
						<?php if($userDetails->remainingDays > 0 ||  $endDate == $currentDate): ?>
						<li class="nav-item col-xl-2"> <a class="nav-link" id="track-tab" data-toggle="tab" href="#track" role="tab" aria-controls="track" aria-selected="false"><i class="flaticon-playlist"></i> Tracks</a> </li>
						<li class="nav-item col-xl-2"> <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false"><i class="flaticon-play-button-1"></i> Video</a> </li>
						<li class="nav-item col-xl-2"> <a class="nav-link" id="add-pic-tab" data-toggle="tab" href="#add-pic" role="tab" aria-controls="add-pic" aria-selected="false"><i class="fa fa-picture-o"></i> Photos</a> </li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="artist" role="tabpanel" aria-labelledby="artist-tab">
						<div class="ms_heading_wrapper ms_cover text-center mt-4">
							<h1>Profile Details</h1>
						</div>
						<form class="form-horizontal" method="post" action="<?php echo e(url('/update-profile/'.$userDetails->id)); ?>" enctype="multipart/form-data">
							<?php echo e(csrf_field()); ?>

							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<input type="text" class="form-control require" name="first_name" required="" placeholder="First Name *" value="<?php echo e($userDetails->first_name); ?>" required="">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<input type="text" class="form-control require" name="last_name" required="" placeholder="Last Name *" value="<?php echo e($userDetails->last_name); ?>" required="">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-pos">
										<div class="form-group i-name">
											<?php
											$genreArray = array('Jazz', 'Rock', 'Pop', 'Folk', 'Classical', 'Heavy Metal', 'Punk Rock', 'Soul', 'Hip Hop', 'Reggae', 'Funk', 'Disco', 'Techno', 'Instrumental');
											?>
											<select class="form-control form-control-lg" name="genre" id="genre">
												<option value="">Favorite Genre</option>
												<?php $__currentLoopData = $genreArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($genre); ?>" <?php if($genre==$userDetails->genre): ?> selected <?php endif; ?>><?php echo e($genre); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											<?php
											$countryArray = array("Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bonaire","Bosnia &amp; Herzegovina","Botswana","Brazil","British Indian Ocean Territory","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Canary Islands","Cape Verde","Cayman Islands","Central African Republic","Chad","Channel Islands","Chile","China","Christmas Island","Cocos Island","Colombia","Comoros","Congo","Cook Islands","Costa Rica","Cote DIvoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Great Britain","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guinea","Guyana","Haiti","Hawaii","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea North","Korea South","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Midway Islands","Moldova","Monaco","Mongolia","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherland Antilles","Netherlands (Holland, Europe)","Nevis","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","Norway","Oman","Pakistan","Palau Island","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn Island","Poland","Portugal","Puerto Rico","Qatar","Republic of Montenegro","Republic of Serbia","Reunion","Romania","Russia","Rwanda","St Barthelemy","St Eustatius","St Helena","St Kitts-Nevis","St Lucia","St Maarten","St Pierre &amp; Miquelon","St Vincent &amp; Grenadines","Saipan","Samoa","Samoa American","San Marino","Sao Tome &amp; Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Tahiti","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tokelau","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos Islands","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City State","Venezuela","Vietnam","Virgin Islands (Brit)","Virgin Islands (USA)","Wake Island","Wallis & Futana Is","Yemen","Zaire","Zambia","Zimbabwe");
											?>
											<select class="form-control form-control-lg" name="country" id="country">
												<?php $__currentLoopData = $countryArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($country); ?>" <?php if($country==$userDetails->country): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											
											<input type="text" class="form-control form-control-lg" name="city" placeholder="City" value="<?php echo e($userDetails->city); ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-e">
										<div class="form-group i-email">
											<input type="email" class="form-control require" name="email" required="" placeholder=" demo@gmail.com *" data-valid="email" data-error="Email should be valid." readonly value="<?php echo e($userDetails->email); ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-s">
											<label for="birth-date">Birth Date</label>

										<?php
										//$birthdate = date('m/d/Y', strtotime($userDetails->birthdate));
										?>
										<div class="form-group i-dob">
											<input type="date" class="form-control require" name="birthdate" required="" placeholder="Date of Birth *" value="<?php echo e($userDetails->birthdate); ?>">
										</div>
									</div>
								</div>
								
								<?php if($userDetails->user_type == 1 || $userDetails->user_type == 2): ?>
								<div class="col-lg-12 col-md-12">
									<div class="form-s">
										<div class="form-group i-dob">
											<textarea class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Biography" name="biography" wrap="hard"><?php echo e($userDetails->biography); ?></textarea>
										</div>
									</div>
								</div>
								<?php endif; ?>

								<div class="col-md-12">
									<p><label>Select Profile Image</label></p>
									<span class="orangeBtn modalOpen" data-toggle="modal" data-target="#ImageCropper_modal" data-type="profileImage">Upload Image</span>
									<span></span>
									
									<br />
									<small>Image must be 300 x 300 pixel and format must be .jpg, .png, .gif.</small>
									<br />
									
								</div>
								<input type="hidden" name="id" value="<?php echo e($userDetails->id); ?>">
								<div class="col-md-4 col-sm-12 col-xs-12">
									<div id="uploaded_image">
									<?php if($userDetails->profile_image): ?>
										<img src="uploads/<?php echo e($userDetails->profile_image); ?>" onerror="this.onerror=null;this.src='uploads/avatar.png';" style="border: 1px solid gray;height: 200px;width: 200px;border-radius: 4px;float:left;">
									<?php else: ?>	
										<img src="" onerror="this.onerror=null;this.src='uploads/avatar.png';" style="border: 1px solid gray;height: 200px;width: 200px;border-radius: 4px;float:left;">
									<?php endif; ?>
									</div>
									
								</div>
								
								
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
											<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> submit</button>
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
						<form class="form-horizontal" method="post" action="<?php echo e(url('/change-password/'.$userDetails->id)); ?>" enctype="multipart/form-data">
							<?php echo e(csrf_field()); ?>

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
										<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<?php if($userDetails->user_type == 1): ?>
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
								<?php
								$totalItem = 0;	
								$totalAmount = 0;
								?>
								<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php
								$totalItem = $totalItem + $transaction->item;
								$totalAmount = $totalAmount + $transaction->payment_amount;
								?>
								<tr>
									<th scope="row"><?php echo e($i + 1); ?></th>									
									<td><?php echo e($transaction->package_name); ?></td>
									<td><?php echo e($transaction->item); ?></td>
									<td><?php echo e($transaction->payment_amount.' '.$transaction->currency); ?></td>
									<td><?php echo e(date('m-d-Y', strtotime($transaction->created_at))); ?></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<tr style="font-weight: 700">
									<td></td>
									<td style="text-align: right">Total</td>
									<td><?php echo e($totalItem); ?></td>
									<td><?php echo e($totalAmount); ?> USD</td>
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
								<?php $__currentLoopData = $trackDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<th scope="row"><?php echo e($i+1); ?></th>
									<td><?php echo e($track->track_name); ?></td>
									<td>
                                        <?php if(count($agreementDetails) > 0): ?>
                                            <?php if($agreementDetails[0]->plan_id == $track->plan_id ): ?>
                                        <a href="<?php echo e(url('/delete-track/'.$track->id)); ?>" onclick="return confirm('Are you sure? You want to delete.')"><i class="flaticon-trash"></i></a>

                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>

						<div class="col-lg-12 col-md-12 mb-2 mt-4 pl-0">
							<form class="form-horizontal" method="post" action="<?php echo e(url('/upload-track')); ?>" enctype="multipart/form-data">
								<?php echo e(csrf_field()); ?>

								<div class="">
									<!--class:custom-file-upload-->
									<input type="hidden" name="id" value="<?php echo e($userDetails->id); ?>">
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
												<label>Upload Cover Image : &nbsp;</label>
                                                <span class="orangeBtn modalOpen" data-toggle="modal" data-target="#ImageCropper_modal_track_cover" data-type="TrackCoverImg">Upload Image</span>
											</div>
											
                                            <div id="track_uploaded_cover_image">
                                                    <img src="" onerror="this.onerror=null;this.src='uploads/track-default.png';" style="max-height: 150px;">

                                            </div>

											<small id="imagePreviewMsg">Image must be 50 x 50 pixel and format must be .jpg, .png, .gif </small><br/>
										</div>
									</div>
									
									
									
									<!-- <label for="file-upload" class="custom-file-upload1">Upload Tracks</label> -->
									<!-- <div id="file-upload-filename"></div> -->
                                    <input type="hidden" name="cover_image" id="cover_image" value="">
									<?php if($userDetails->remainingDays > 0 ||  $endDate == $currentDate ): ?>
									<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> submit</button>
									<?php endif; ?>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
						<form class="mt-4" method="post" action="<?php echo e(url('/upload-video')); ?>" enctype="multipart/form-data">
							<div class="row">
								<?php echo e(csrf_field()); ?>

								<input type="hidden" name="id" value="<?php echo e($userDetails->id); ?>">
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
								<?php if($userDetails->remainingDays > 0 ||  $endDate == $currentDate): ?>
								<button type="submit" class="submitForm"><i class="flaticon-play-button"></i> Update</button>
								<?php endif; ?>
							</div>
						</form>
					</div>
					<div class="tab-pane fade" id="add-pic" role="tabpanel" aria-labelledby="add-pic-tab">
						<div class="row mt-5">
							<form class="form-horizontal" method="post" action="<?php echo e(url('/upload-photos')); ?>" enctype="multipart/form-data">
								<?php echo e(csrf_field()); ?>

								<div class="col-md-12">
									<p><label>Select Photo</label></p>
									<span class="orangeBtn modalOpen" data-toggle="modal" data-target="#ImageCropper_modal_photo_tab" data-type="PhotoTab">Upload Image</span>
									<br />
									<br />

								</div>
								
								
								

                                <small>Image must be 415 x 415 pixel and format must be .jpg, .png, .gif</small>
							</form>
						</div>
						<div class="row" id="image_preview">
							<?php $__currentLoopData = $photoDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photoDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-lg-3 col-md-6 col-sm-12 col-12" style="max-width: 100% !important;">
    							<div class="feature_artist_image text-center py-4">
    								<img src="<?php echo e(asset('/uploads/photos/'.$photoDetail->photo_file)); ?>" class="img-responsive" alt="img" width="100%" height="224px"><br/><br/>
									<a href="<?php echo e(url('/delete-photo/'.$photoDetail->id)); ?>" onclick="return confirm('Are you sure? You want to delete.')"><i class="flaticon-trash"></i></a>
    							</div>
    						</div>
    						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- top artist wrapper start -->

<?php $__env->stopSection(); ?>
<script src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script>
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

	
	$(document).ready(function(){
	  $("#genre").css("display", "block");
	  $("#country").css("display", "block");
	});

</script>
<script>
	$(document).ready(function(){

  //For artist profile tab
  $image_crop = $('#image-preview').croppie({
    enableExif:true,
    viewport:{
      width:300,
      height:300,
      type:'square'
    },
    boundary:{
      width:300,
      height:300
    }
  });
    //For artist photo tab
    $image_crop_photo_tab = $('#image-photo-tab-preview').croppie({
        enableExif:true,
        viewport:{
            width:415,
            height:415,
            type:'square'
        },
        boundary:{
            width:415,
            height:415
        }
    });

   //for track cover page image
   $image_crop_track_cover = $('#image-track-cover-preview').croppie({
    enableExif:true,
    viewport:{
      width:50,
      height:50,
      type:'square'
    },
    boundary:{
      width:50,
      height:50
    }
  });
  //For artist profile tab
  $('#upload_image').change(function(){
    var reader = new FileReader();

    reader.onload = function(event){
      $image_crop.croppie('bind', {
        url:event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

// For artist track cover photo
  $('#upload_image_track').change(function(){
    var reader = new FileReader();

    reader.onload = function(event){
        $image_crop_track_cover.croppie('bind', {
        url:event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

   // For artist photo tab
   $('#upload_image_photo_tab').change(function(){
    var reader = new FileReader();

    reader.onload = function(event){
        $image_crop_photo_tab.croppie('bind', {
        url:event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

$(document).on('click','#PhotoTab',function() {
//   $('#profileImage').click(function(event){
    if ($('#upload_image_photo_tab').get(0).files.length === 0) {
        $(".error_file_valid").show().delay(5000).fadeOut();
        $(".error_file_valid").html('No files selected. Please select file. ');
        return false;
    }
    $image_crop_photo_tab.croppie('result', {
      type:'canvas',
      size:'viewport'
    }).then(function(response){
      var _token = $('input[name=_token]').val();
      var id = $('input[name=id]').val();
      $.ajax({
        url:'<?php echo e(route("image_crop.photoUpload")); ?>',
        type:'post',
        data:{"image":response, _token:_token, id:id},
        dataType:"json",
        success:function(data)
        {
		  $("#image_preview").load(location.href + " #image_preview");
		  $("#ImageCropper_modal_photo_tab").modal('hide');
          $('#upload_image_photo_tab').val('');
          $('#image-photo-tab-preview img').css('display','none');
        }
      });
    });
  });

// Track Cover Image Crop Module
$(document).on('click','#TrackCoverImg',function() {
//   $('#profileImage').click(function(event){

    if ($('#upload_image_track').get(0).files.length === 0) {
        $(".error_file_valid").show().delay(5000).fadeOut();
        $(".error_file_valid").html('No files selected. Please select file. ');
        return false;
    }

    $image_crop_track_cover.croppie('result', {
      type:'canvas',
      size:'viewport'
    }).then(function(response){

        var _token = $('input[name=_token]').val();
        var id = $('input[name=id]').val();
        $.ajax({
            url:'<?php echo e(route("image_crop.upload-track-cover")); ?>',
            type:'post',
            data:{"image":response, _token:_token, id:id},
            dataType:"json",
            success:function(data)
            {
                console.log("data=", data.image_name);
                var crop_image = '<img src="'+response+'" />';
                $('#track_uploaded_cover_image').html(crop_image);

                $("#ImageCropper_modal_track_cover").modal('hide');
                $('#upload_image_track').val('');
                $('#cover_image').val(data.image_name);
                $('#image-track-cover-preview img').css('display','none');
            }
        });

    });
  });

// Pgoto tab Image Crop Module
$(document).on('click','#profileImage',function() {
//   $('#profileImage').click(function(event){

    if ($('#upload_image').get(0).files.length === 0) {
        $(".error_file_valid").show().delay(5000).fadeOut();
        $(".error_file_valid").html('No files selected. Please select file. ');
        return false;
    }

    $image_crop.croppie('result', {
      type:'canvas',
      size:'viewport'
    }).then(function(response){
      var _token = $('input[name=_token]').val();
      var id = $('input[name=id]').val();
      $.ajax({
        url:'<?php echo e(route("image_crop.upload")); ?>',
        type:'post',
        data:{"image":response, _token:_token, id:id},
        dataType:"json",
        success:function(data)
        {
          var crop_image = '<img src="'+data.path+'" />';
		  $('#uploaded_image').html(crop_image);
		  $("#ImageCropper_modal").modal('hide');
            $('#upload_image').val('');
            $('#image-preview img').css('display','none');
        }
      });
    });
  });

	//for cancel modal button click
	$(document).on('click','.whiteBtn, .close',function() {
		$('#upload_image').val('');
		$('#image-preview img').css('display','none');

		$('#upload_image_track').val('');
		$('#image-track-cover-preview img').css('display','none');

		$('#upload_image_photo_tab').val('');
		$('#image-photo-tab-preview img').css('display','none');
	});

  $('#cover_image').change(function(){           
    let reader = new FileReader();
    reader.onload = (e) => { 
      $('#cover_image_preview_container').attr('src', e.target.result); 
    }
    //console.log("test", this.files[0].type);
    if(this.files[0].type == 'image/png' || this.files[0].type == 'image/jpeg' || this.files[0].type == 'image/gif' || this.files[0].type == 'image/webp' ){
        //console.log("yes images", this.files[0].type);
        $('#cover_image_preview_container').show();
        $('#imagePreviewMsg').show();
    }else {
        $('#cover_image_preview_container').hide();
        $('#imagePreviewMsg').hide();
        //console.log("not images", this.files[0].type);
    }
    reader.readAsDataURL(this.files[0]);   
   });

   $('#photo_image').change(function(){           
    let reader = new FileReader();
    reader.onload = (e) => { 
      $('#photo_image_preview_container').attr('src', e.target.result); 
    }
    reader.readAsDataURL(this.files[0]);   
   });
});

$(document).on("click", ".modalOpen", function () {   
	var type = $(this).data('type');     
	// $('.modal-footer .orangeBtn').addClass(type);
	$('.modal-footer .orangeBtn').attr('id', type);
    // document.getElementById('itemname').innerHTML = itemname;

    // var itemimg = $(this).data('itemimg');         
    
  });
</script>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>