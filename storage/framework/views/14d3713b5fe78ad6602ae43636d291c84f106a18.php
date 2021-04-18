<!DOCTYPE html>
<html>
<head>
	<?php echo $__env->make('admin.layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper"> 
	<?php echo $__env->make('admin.layouts.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<?php echo $__env->make('admin.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- Content Wrapper. Contains page content -->
  	<div class="content-wrapper pb-3">
		<?php echo $__env->yieldContent('content'); ?>	
	</div>
	<?php echo $__env->make('admin.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
<!-- ./wrapper -->
<?php echo $__env->make('admin.layouts.ImageCropper', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('admin.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>