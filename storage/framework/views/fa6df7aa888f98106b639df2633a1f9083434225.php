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
  <form class="form-horizontal" method="post" action="<?php echo e(url('/admin/pages/edit/'.$pageDetails->id)); ?>"
    enctype="multipart/form-data"><?php echo e(csrf_field()); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">

          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Page Title</label>
              <input type="text" name="title" id="inputName" class="form-control" value="<?php echo e($pageDetails->title); ?>"
                required="">
            </div>
            <div class="form-group">
              <label for="inputDescription">Page Content</label>
              <textarea class="textarea" name="content" required=""><?php echo e($pageDetails->content); ?></textarea>
            </div>
            <div class="form-group">
              <label for="inputName">Featured Image</label>
              
              <div class="custom-file">

                
                <input type="hidden" name="featured_image" id="eventInputImage" value="">
                <span class="orangeBtn modalOpen" data-toggle="modal" data-target="#ImageCropper_modal_cms_page" data-type="eventImage">Upload Image</span>
              </div>
              <div id="uploaded_image" style="padding-top: 20px;">
                <p>
                  <img id="featured_image_preview" src="<?php echo e(asset('/uploads/'.$pageDetails->featured_image)); ?>" alt="preview image"
                    style="max-width: 350px;">
                </p>
              </div>
              <small>Image must be 350 x 350 pixel and format must be .jpg.</small>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-12" style="display: none;">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">SEO Details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputEstimatedBudget">Meta Title</label>
              <input type="text" name="meta_title" id="inputName" class="form-control"
                value="<?php echo e($pageDetails->meta_title); ?>">
            </div>
            <div class="form-group">
              <label for="inputSpentBudget">Meta Description</label>
              <textarea id="inputDescription" name="meta_description" class="form-control"
                rows="4"><?php echo e($pageDetails->meta_description); ?></textarea>
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Meta URL</label>
              <input type="text" name="meta_url" id="inputName" class="form-control"
                value="<?php echo e($pageDetails->meta_url); ?>">
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