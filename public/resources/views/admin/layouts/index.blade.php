<!DOCTYPE html>
<html>
<head>
	@include('admin.layouts.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper"> 
	@include('admin.layouts.nav')
	
	@include('admin.layouts.sidebar')
	<!-- Content Wrapper. Contains page content -->
  	<div class="content-wrapper pb-3">
		@yield('content')	
	</div>
	@include('admin.layouts.footer')

</div>
<!-- ./wrapper -->

@include('admin.layouts.script')

</body>
</html>