<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en">
<!--[endif]-->

<head>
@include('layouts.head')
</head>
<body>
<!-- preloader Start -->
<div id="preloader">
	<div id="status"> <img src="{{ asset('images/loader.gif') }}" id="preloader_image" alt="loader"> </div>
</div>
<div class="cursor"></div>
<div class="m24_main_wrapper"> 
@include('layouts.nav')

	@yield('content')

	
	<!-- download wrapper start  
	@include('layouts.download') -->
	<!-- download wrapper end --> 
	<!-- quick link wrapper start -->
	
	<!-- quick link wrapper end--> 
	
	<!-- footer Wrapper start --> 
	@include('layouts.footer') 
	<!--footer wrapper end--> 
	<!-- language modal section --> 
</div>
@include('layouts.language-model') 

<!-- login register  modal section --> 
@include('layouts.login-model')
@include('layouts.ImageCropper')

@include('layouts.register-model') 
<!-- login register  modal end --> 
<!-- playllist wrapper start --> 
@include('layouts.playlist') 
<!-- playlist wrapper end --> 
<!--custom js files--> 
@include('layouts.script') 
<!-- custom js-->

</body>
</html>