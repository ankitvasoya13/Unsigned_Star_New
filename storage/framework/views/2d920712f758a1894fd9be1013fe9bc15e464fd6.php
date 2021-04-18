<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
		<div class="container-fluid">
		<div class="row mb-2">
  			<div class="col-sm-6">
  				<h1>Dashboard</h1>
 			</div>
  			<div class="col-sm-6">
    			<ol class="breadcrumb float-sm-right">
      				<li class="breadcrumb-item"><a href="#">Home</a></li>
      				<li class="breadcrumb-item active">Dashboard</li>
        		</ol>
      		</div>
    	</div>
    	<div class="row">
    		<?php if(Session::has('flash_message_error')): ?>
	            <div class="alert alert-error alert-block">
	                <button type="button" class="close" data-dismiss="alert">×</button> 
	                    <strong><?php echo session('flash_message_error'); ?></strong>
	            </div>
	        <?php endif; ?>   
	        <?php if(Session::has('flash_message_success')): ?>
	            <div class="alert alert-success alert-block">
	                <button type="button" class="close" data-dismiss="alert">×</button> 
	                    <strong><?php echo session('flash_message_success'); ?></strong>
	            </div>
	        <?php endif; ?>
    	</div>
  	</div><!-- /.container-fluid -->
</section>
<section class="content">
	<div class="container-fluid"> 
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-6"> 
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?php echo e($artistCount); ?></h3>
						<p>Artist Users</p>
					</div>
					<div class="icon"> <i class="ion ion-bag"></i> </div>
					<a href="<?php echo e(url('/admin/artists/view')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6"> 
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3><?php echo e($panelCount); ?></h3>
						<p>Panel Users</p>
					</div>
					<div class="icon"> <i class="ion ion-stats-bars"></i> </div>
					<a href="<?php echo e(url('/admin/panels/view')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6"> 
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?php echo e($fanCount); ?></h3>
						<p>Fan Users</p>
					</div>
					<div class="icon"> <i class="ion ion-person-add"></i> </div>
					<a href="<?php echo e(url('/admin/fans/view')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6"> 
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3>0</h3>
						<p>Total Orders</p>
					</div>
					<div class="icon"> <i class="ion ion-pie-graph"></i> </div>
					<a href="<?php echo e(url('/admin/orders/view')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
				</div>
			</div>
			<!-- ./col --> 
		</div>
		<!-- /.row --> 
	</div>
	<!-- /.container-fluid --> 
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>