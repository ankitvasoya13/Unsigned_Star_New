<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-white navbar-light"> 
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> </li>
	</ul>
	
	<!-- SEARCH FORM -->
	<!-- <form class="form-inline ml-3">
		<div class="input-group input-group-sm">
			<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
				<button class="btn btn-navbar" type="submit"> <i class="fas fa-search"></i> </button>
			</div>
		</div>
	</form> -->
	
	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Messages Dropdown Menu -->
		<li class="nav-item dropdown"> <a class="nav-link" data-toggle="dropdown" href="#"> <i class="fas fa-user"></i> My Account </a>
			<div class="dropdown-menu dropdown-menu-md dropdown-menu-right"> 
				<a href="{{ url('/admin/change-password') }}" class="dropdown-item"> <i class="fas fa-user-edit mr-2"></i> Change Password </a>
				<div class="dropdown-divider"></div>
				<a href="{{ url('/logout') }}" class="dropdown-item"> <i class="fas fa-sign-out-alt mr-2"></i> Logout </a>
		</li>
	</ul>
</nav>
<!-- /.navbar -->