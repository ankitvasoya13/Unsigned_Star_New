<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en">
<!--[endif]-->

<head>
<?php echo $__env->make('layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body>
<!-- preloader Start -->
<div id="preloader">
	<div id="status"> <img src="<?php echo e(asset('images/loader.gif')); ?>" id="preloader_image" alt="loader"> </div>
</div>
<div class="cursor"></div>
<div class="m24_main_wrapper"> 
<?php echo $__env->make('layouts.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->yieldContent('content'); ?>

	
	<!-- download wrapper start  
	<?php echo $__env->make('layouts.download', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
	<!-- download wrapper end --> 
	<!-- quick link wrapper start -->
	
	<!-- quick link wrapper end--> 
	
	<!-- footer Wrapper start --> 
	<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<!--footer wrapper end--> 
	<!-- language modal section --> 
</div>
<?php echo $__env->make('layouts.language-model', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<!-- login register  modal section --> 
<?php echo $__env->make('layouts.login-model', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.ImageCropper', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('layouts.register-model', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<!-- login register  modal end --> 
<!-- playllist wrapper start --> 
<?php echo $__env->make('layouts.playlist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<!-- playlist wrapper end --> 
<!--custom js files--> 
<?php echo $__env->make('layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<!-- custom js-->

</body>
</html>