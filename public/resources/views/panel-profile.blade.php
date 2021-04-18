@extends('layouts.index')

@section('content') 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Panel Profile</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">Panel Profile</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End -->
<div class="art_details_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="art_personal_details">
					<div class="art_name">
						<h2>John H.</h2>
					</div>
					<div class="profile-pic mb-4"> <img src="images/tp3.png" alt="img" class="img-fluid"> </div>
					<h4 class="mb-2">Melbourne Australia</h4>
					<h5 class="mb-4">Rock</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor nt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerciion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor indi reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Exceiur sint occaecat cupidatat non proident, <br>
						<br>
						sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis de omnis iste natus error sit voluptatem tium doloremque laudantium, totam rem am, eaque ipsa quae ab illo inventore veritatis</p>
					<div class="lang_apply_btn footer_cont_btn">
						<ul>
							<li><a href="#"> <i class="flaticon-play-button"></i>read more</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 bg-white px-5 mt-lg-0 mt-4 py-3 art-social-blog">
				<div class="art_social_details">
					<table class="table">
						<tbody>
							<tr>
								<th scope="col">Followers</th>
								<th scope="col">Likes</th>
								<th scope="col">Share</th>
								<th scope="col">Message</th>
							</tr>
							<tr>
								<td class="artist-follower">136</td>
								<td class="artist-like"><i class="fas fa-heart"></i></td>
								<td class="artist-share"><i class="fas fa-share"></i></td>
								<td class="artist-message"><i class="fas fa-envelope"></i></td>
							</tr>
						</tbody>
					</table>
					<h5 class="mt-4">Following</h5>
					<div class="row mt-3">
						<div class="col-lg-3 col-md-3 col-sm-3 col-3"> <a href="#"> <img src="images/tp3.png" alt="img" class="img-fluid"> </a> </div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3"> <a href="#"> <img src="images/tp3.png" alt="img" class="img-fluid"> </a> </div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3"> <a href="#"> <img src="images/tp3.png" alt="img" class="img-fluid"> </a> </div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3"> <a href="#"> <img src="images/tp3.png" alt="img" class="img-fluid"> </a> </div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3 mt-4"> <a href="#"> <img src="images/tp3.png" alt="img" class="img-fluid"> </a> </div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3 mt-4"> <a href="#"> <img src="images/tp3.png" alt="img" class="img-fluid"> </a> </div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3 mt-4"> <a href="#"> <img src="images/tp3.png" alt="img" class="img-fluid"> </a> </div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-3 mt-4"> <a href="#"> <img src="images/tp3.png" alt="img" class="img-fluid"> </a> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- blog category wrapper end --> 
@endsection