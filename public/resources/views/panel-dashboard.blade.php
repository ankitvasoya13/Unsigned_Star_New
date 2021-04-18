@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Panel</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">Panel</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- genres wrapper start -->
<div class="fan_wrapper contact_section">
<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
			<ul class="nav nav-tabs text-center" id="myTab" role="tablist">
				<li class="nav-item col-xl-6"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="flaticon-vinyl"></i> Panel Details</a> </li>
				<li class="nav-item col-xl-6"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="flaticon-album"></i> Change Password</a> </li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="ms_heading_wrapper ms_cover text-center mt-4">
						<h1>Panel Profile</h1>
					</div>
					<form class="mb-5">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-pos">
									<div class="form-group i-name">
										<input type="text" class="form-control require" name="first_name" required="" placeholder="First Name*">
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-pos">
									<div class="form-group i-name">
										<input type="text" class="form-control require" name="last_name" required="" placeholder="last Name*">
									</div>
								</div>
							</div>
							<!-- /.col-md-12 -->
							<div class="col-lg-12 col-md-12">
								<div class="form-e">
									<div class="form-group i-email">
										<input type="email" class="form-control require" name="email" required="" placeholder=" demo@gmail.com *" data-valid="email" data-error="Email should be valid." disabled>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-e">
									<div class="form-group i-dob">
										<input type="text" class="form-control require" name="dob" required="" placeholder=" Date of Birth *" data-valid="email" data-error="Date of Birth should be valid." onfocus="(this.type='date')">
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-e">
									<div class="form-group i-email">
										<select class="form-control form-control-lg">
											<option>Country</option>
											<option>Australia</option>
											<option>Bhutan</option>
											<option>Brazil</option>
											<option>America</option>
											<option>Canada</option>
											<option>Germany</option>
											<option>Algeria</option>
											<option>India</option>
											<option>New Zealand</option>
											<option>Nepal</option>
											<option>Switzerland</option>
											<option>Sweden</option>
											<option>Turkey</option>
											<option>America</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-e">
									<div class="form-group i-email">
										<select class="form-control form-control-lg">
											<option>City</option>
											<option>Sydney</option>
											<option>Thimphu</option>
											<option>Curitiba</option>
											<option>Chicago</option>
											<option>Brooks</option>
											<option>Berlin</option>
											<option>Blida</option>
											<option>Ahmedabad</option>
											<option>Auckland</option>
											<option>Kathmandu</option>
											<option>Geneva</option>
											<option>Stockholm </option>
											<option>Istanbul</option>
											<option>New York</option>
										</select>
									</div>
								</div>
							</div>
							<!-- /.col-md-12 -->
							<div class="col-md-12">
								<div class="custom-file-upload">
									<input type="file" id="file-upload" name="pic">
									<label for="file-upload" class="custom-file-upload1">Upload Profile Pic</label>
									<div id="file-upload-filename"></div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 mt-2">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
									<label class="custom-control-label" for="customControlAutosizing">Accept Terms & Condition</label>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 mt-2">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" class="custom-control-input" id="customControlAutosizing1">
									<label class="custom-control-label" for="customControlAutosizing1">Receive Newsletters</label>
								</div>
							</div>
							<!-- /.col-md-12 -->
							<div class="col-md-12">
								<div class="tb_es_btn_div">
									<div class="response"></div>
									<div class="tb_es_btn_wrapper">
										<button type="button" class="submitForm"><i class="flaticon-play-button"></i> send !</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="ms_heading_wrapper ms_cover text-center mt-4">
						<h1>Change Password</h1>
					</div>
					<form class="mb-3">
						<div class="col-lg-12 col-md-12">
							<div class="form-pos">
								<div class="form-group i-name">
									<input type="password" class="form-control require" name="old_password" required="" placeholder="Old Password *">
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12">
							<div class="form-pos">
								<div class="form-group i-name">
									<input type="password" onfocusout="comparePassword()" id="password" class="form-control require" name="new_password" required="" placeholder="New Password *">
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12">
							<div class="form-pos">
								<div class="form-group i-name">
									<input type="password" onfocusout="comparePassword()" id="confirm_password" class="form-control require" name="confirm_password" required="" placeholder="Confirm Password *">
									<span id="passwordError"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="tb_es_btn_div">
								<div class="tb_es_btn_wrapper">
									<button type="button" class="submitForm"><i class="flaticon-play-button"></i> submit !</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- genres wrapper end --> 
@endsection
<script>
	function comparePassword() {
		var password = $("input[name='password']").val();
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