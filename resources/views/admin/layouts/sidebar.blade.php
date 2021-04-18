<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4"> 
	<!-- Brand Logo --> 
	<a href="{{ url('/admin/dashboard') }}" class="brand-link"> 
		<!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">  -->
         <span class="brand-text font-weight-light pl-4">Music Dashboard</span> 
     </a> 
	
	<!-- Sidebar -->
	<div class="sidebar"> 
		<!-- Sidebar user panel (optional) -->
		<!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image"> <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> </div>
			<div class="info"> <a href="#" class="d-block">Alexander Pierce</a> </div>
		</div> -->
		
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview @if(Request::segment(2) == 'pages') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'pages') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Page <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/pages/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Pages</p>
							</a> </li>
						<li class="nav-item"> <a href="{{ url('/admin/pages/add') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
							<p>Add New</p>
							</a> </li>
					</ul>
				</li>
				{{-- <li class="nav-item has-treeview @if(Request::segment(2) == 'packages') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'packages') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Package <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/packages/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Packages</p>
							</a> </li>
						<li class="nav-item"> <a href="{{ url('/admin/packages/add') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
							<p>Add New</p>
							</a> </li>
					</ul>
				</li> --}}
				<li class="nav-item has-treeview @if(Request::segment(2) == 'events') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'events') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Event <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/events/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Events</p>
							</a> </li>
						<li class="nav-item"> <a href="{{ url('/admin/events/add') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
							<p>Add New</p>
							</a> </li>
					</ul>
				</li>

				<li class="nav-item has-treeview @if(Request::segment(2) == 'competitions') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'competitions') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Competitions <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/competitions/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Competitions</p>
							</a> </li>
						<li class="nav-item"> <a href="{{ url('/admin/competitions/add') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
							<p>Add New</p>
							</a> </li>
					</ul>
				</li>
				
				<li class="nav-item has-treeview @if(Request::segment(2) == 'stories') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'stories') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Story <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/stories/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Stories</p>
							</a> </li>
						<li class="nav-item"> <a href="{{ url('/admin/stories/add') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
							<p>Add New</p>
							</a> </li>
					</ul>
				</li>
				<li class="nav-item has-treeview @if(Request::segment(2) == 'artists') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'artists') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Users <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/users/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>Admin</p>
							</a> 
						</li>
						<li class="nav-item"> <a href="{{ url('/admin/artists/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>Artist</p>
							</a> 
						</li>
						<li class="nav-item"> <a href="{{ url('/admin/panels/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>Panel</p>
							</a> 
						</li>
						<li class="nav-item"> <a href="{{ url('/admin/fans/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>Fan</p>
							</a> 
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview @if(Request::segment(2) == 'sliders') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'sliders') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Slider <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/sliders/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Slides</p>
							</a> </li>
						<li class="nav-item"> <a href="{{ url('/admin/sliders/add') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
							<p>Add New</p>
							</a> </li>
					</ul>
				</li>
				<li class="nav-item has-treeview"> <a href="#" class="nav-link @if(Request::segment(2) == 'orders') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Orders <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/orders/view') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Orders</p>
							</a> </li>
					</ul>
				</li>
				<li class="nav-item has-treeview @if(Request::segment(2) == 'plan' || Request::segment(2) == 'subscriber') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'plan') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Subscription Plan <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/plan/list') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Plan</p>
							</a> </li>
						{{-- <li class="nav-item"> <a href="{{ url('/admin/plan/add') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
							<p>Add New</p>
							</a> </li> --}}
						<li class="nav-item"> <a href="{{ url('/admin/subscriber/list') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
								<p>Subscriber List</p>
							</a> </li>
					</ul>
				</li>
				{{-- <li class="nav-item has-treeview @if(Request::segment(2) == 'coupons') menu-open @endif"> <a href="#" class="nav-link @if(Request::segment(2) == 'coupons') active @endif"> <i class="nav-icon fas fa-file"></i>
					<p> Coupons <i class="right fas fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"> <a href="{{ url('/admin/coupons/list') }}" class="nav-link "> <i class="fas fa-angle-right nav-icon"></i>
							<p>All Coupon</p>
							</a> </li>
						<li class="nav-item"> <a href="{{ url('/admin/coupons/add') }}" class="nav-link"> <i class="fas fa-angle-right nav-icon"></i>
							<p>Add New</p>
							</a> </li>						
					</ul>
				</li> --}}
				<!-- <li class="nav-item"> <a href="pages/widgets.html" class="nav-link"> <i class="nav-icon fas fa-cog"></i>
					<p> Settings </p>
					</a> </li> -->
			</ul>
		</nav>
		<!-- /.sidebar-menu --> 
	</div>
	<!-- /.sidebar --> 
</aside>
