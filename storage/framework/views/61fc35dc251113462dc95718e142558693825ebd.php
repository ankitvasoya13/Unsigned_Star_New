<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Page</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Page</li>
            </ol>
          </div>
      </div>
      <div class="row">
        <?php if(Session::has('flash_message_error')): ?>
            <div class="alert alert-error alert-block col-md-12">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong><?php echo session('flash_message_error'); ?></strong>
            </div>
        <?php endif; ?>   
        <?php if(Session::has('flash_message_success')): ?>
            <div class="alert alert-success alert-block col-md-12">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong><?php echo session('flash_message_success'); ?></strong>
            </div>
        <?php endif; ?>
      </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
  <form class="form-horizontal" method="post" action="<?php echo e(url('/admin/plan/edit/'.$localPlan->plan_id)); ?>" novalidate="novalidate" enctype="multipart/form-data"><?php echo e(csrf_field()); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Plan ID</label>
              <input type="text" name="plan_id" id="inputName" class="form-control" value="<?php echo e($localPlan->plan_id); ?>" readonly>
            </div>            
            <div class="form-group">
              <label for="inputName">Subscription Plan Name</label>
              <input type="text" name="name" id="inputName" class="form-control" value="<?php echo e($localPlan->plan_name); ?>" readonly>
            </div>            
            <div class="form-group">
              <label for="inputDescription">Description</label>              
              <input type="text" name="description" id="" class="form-control" value="<?php echo e($localPlan->description); ?>" readonly>
            </div>                        
            <div class="form-group">
              <label for="inputName">Frequency</label>
              <input type="text" name="frequency" class="form-control" readonly value="<?php echo e($localPlan->frequency); ?>">
              
            </div>
            <div class="form-group">
              <label for="inputName">Status</label>
              <input type="text" name="state" class="form-control" value="<?php echo e($localPlan->status); ?>" readonly>
              
            </div>
            <div class="form-group">
              <label for="inputName">Price $</label>
              <input type="text" name="price" readonly id="inputName" class="form-control" value="<?php echo e($localPlan->price); ?>">
            </div>

            <div class="form-group">
              <label for="inputName">Trial Price $</label>
              <input type="text" name="trial_price" readonly id="inputName" class="form-control" value="<?php echo e($localPlan->trial_price); ?>">
            </div>
            
            <div class="form-group">
              <label for="inputName">No of Track</label>
              <input type="text" name="track_limit" id="inputName" class="form-control" value="<?php echo e($localPlan->track_limit); ?>">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
        <input type="submit" value="Update" class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>