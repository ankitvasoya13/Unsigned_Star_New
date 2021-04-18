<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Story</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Story</li>
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
  <form class="form-horizontal" method="post" action="<?php echo e(url('/admin/stories/edit/'.$storyDetails->id)); ?>" enctype="multipart/form-data"><?php echo e(csrf_field()); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Title</label>
              <input type="text" name="title" id="inputName" class="form-control" value="<?php echo e($storyDetails->title); ?>" required="" />
            </div>
              <div class="form-group">
                  <label for="inputName">Short Description</label>
                  <input type="textarea" name="short_description" id="short_description" class="form-control" value="<?php echo e($storyDetails->short_description); ?>" required="" />
              </div>
            <div class="form-group">
              <label for="inputDescription">Description</label>
              <textarea class="textarea" name="description"><?php echo e($storyDetails->description); ?></textarea>
            </div>
            <div class="form-group">
              <label for="inputName">Featured Image</label>
                <div class="custom-file">
              
                <input type="hidden" name="featured_image" id="eventInputImage" value="">
                <span class="orangeBtn modalOpen" data-toggle="modal" data-target="#ImageCropper_modal" data-type="eventImage">Upload Image</span>
                </div>
                <div id="uploaded_image" style="padding-top: 20px;">
              <p><img id="featured_image_preview" class="featured_image_preview" src="<?php echo e(asset('/uploads/'.$storyDetails->featured_image)); ?>" alt="preview image"></p>
                    </div>
              <small>Image must be 540 x 540 pixel and format must be .jpg.</small>
            </div>

            <div class="form-group">
                <label>Date</label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>

                  <input type="datetime-local" name="created_at" class="form-control" value="<?php
                  echo date("Y-m-d\TH:i", strtotime($storyDetails->created_at)); ?>" required="" />

                  <!-- <input type="text" name="start_datetime" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" required="" />-->
                </div>
                <!-- /.input group -->
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

<?php echo $__env->make('admin.layouts.ImageCropperJs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('admin.layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>