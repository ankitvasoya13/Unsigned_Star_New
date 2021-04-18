<div class="modal fade lang_ms_banner" id="login_modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			
			<div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-12" id="loginDiv">
					<div class="m24_language_box ms_cover">
						<h1>Login / Sign In</h1>
						<p>for unlimited music streaming & a personalised experience</p>
					</div>
					<form class="form-horizontal" id="loginForm">
						<?php echo e(csrf_field()); ?>

						<div class="login_form_wrapper">
							<div id="InvalidUserPassword"></div>
							<div class="icon_form comments_form">
								<input type="email" class="form-control" name="email" placeholder="Enter Email Address *">
								<?php if($errors->has('email')): ?> <span class="help-block"> <strong><?php echo e($errors->first('email')); ?></strong> </span> <?php endif; ?> <i class="fas fa-envelope"></i> 
							</div>
							<div class="icon_form comments_form">
								<input type="password" name="password" class="form-control" placeholder="Enter Password *">
								<?php if($errors->has('password')): ?> <span class="help-block"> <strong><?php echo e($errors->first('password')); ?></strong> </span> <?php endif; ?> <i class="fas fa-lock"></i> 
							</div>
							<div class="login_remember_box">
								<label class="control control--checkbox">keep me signed in
									<input type="checkbox" name="remember">
									<span class="control__indicator"></span> </label>
								<a href="#" onclick="showForgotToggle()" class="forget_password"> Forgot Password ? </a>
						</div>
						<div class="lang_apply_btn_wrapper ms_cover">
							
							<input class="lang_apply_btn" id="loginNow" type="submit" name="submit" value="login now">
							<div class="cancel_wrapper"> <a href="#" class="" data-dismiss="modal">cancel</a> </div>
							<div class="dont_have_account ms_cover">
								<p>Don’t have an account ? 
									<!--<a href="#register_modal" data-toggle="modal">register here</a>--> 
									<a href="<?php echo e(url('/join')); ?>">register here</a> </p>
							</div>
						</div>
						</div>
					</form>
				</div>
			</div>

			
			<div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-12"  id="forgotDiv" style="display: none">
					<div class="m24_language_box ms_cover">
						<h1>Forgot Password</h1>						
					</div>
					<form class="form-horizontal" id="forgotForm" autocomplete="off">
						<?php echo e(csrf_field()); ?>

						<div class="login_form_wrapper">
							<div id="InvalidEmail"></div>
							<div class="icon_form comments_form">
								<input type="email" class="form-control" id="forgotEmail" name="email" placeholder="Enter Email Address *">
								<?php if($errors->has('email')): ?> <span class="help-block"> <strong><?php echo e($errors->first('email')); ?></strong>
								</span> <?php endif; ?> <i class="fas fa-envelope"></i> 
							</div>
							<div class="login_remember_box">								
								<a href="#" onclick="showForgotToggle()" class="forget_password"> Back to Login </a> 
							</div>							
						</div>
						<div class="lang_apply_btn_wrapper ms_cover">							
							<input class="lang_apply_btn" id="loginNow" type="submit" name="submit" value="Send Reset Link">
							<div class="cancel_wrapper"> <a href="#" class="" data-dismiss="modal">cancel</a> </div>							
						</div>
					</form>
				</div>
			</div>


		</div>
	</div>
</div>
<script>
	function showForgotToggle() {
		var x = document.getElementById("loginDiv");
		var y = document.getElementById("forgotDiv");
		if (x.style.display === "none") {
			x.style.display = "block";
			y.style.display = "none";
		} else {
			x.style.display = "none";
			y.style.display = "block";
		}
	}
</script>