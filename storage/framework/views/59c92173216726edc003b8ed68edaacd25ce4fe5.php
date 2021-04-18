<?php $__env->startSection('content'); ?> 
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2><?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<?php if($page->id == 1): ?>
						<?php echo html_entity_decode($page->title); ?>

						<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
						<li class="breadcrumb-item">
						<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<?php if($page->id == 1): ?>
						<?php echo html_entity_decode($page->title); ?>

						<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End --> 
<!-- About wrapper start -->
<div class="about_us_wrapper about-contain">
	<div class="container">
		<div class="row align-items-center">
			<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"> <?php if($page->id == 1): ?><img src="<?php echo e(asset('uploads/'.$page->featured_image)); ?>" class="img-responsive w-100" alt="img"> <?php endif; ?> </div>
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 pl-5 about-text-blog">
				<div class="artist_wrapper_text">
					<div class="artist_wrapper_left"> 
						<?php if($page->id == 1): ?>
						<?php echo html_entity_decode($page->content); ?>

						<?php endif; ?> 
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</div>
<!-- About wrapper End --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>