<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Artists</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">View Users</li>
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
  <div class="row">
    <div class="col-12">

      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>              
              <a href="/admin/downloadCSV/1" class="btn btn-info btn-mini" style="float: right">Download in Excel</a>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Featured</th>
                <th>Home Featured</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($user->first_name.' '.$user->last_name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td class="center">
                  <a href="<?php echo e(url('/admin/artists/featured/'.$user->id)); ?>">
                    <?php if($user->featured == 0): ?>
                    <i class="far fa-star"></i>
                    <?php else: ?>
                    <i class="fas fa-star"></i>
                    <?php endif; ?>
                  </a>
                </td>
                <td class="center">
                  <a href="<?php echo e(url('/admin/artists/homefeatured/'.$user->id)); ?>">
                    <?php if($user->homefeatured == 0): ?>
                    <i class="far fa-star"></i>
                    <?php else: ?>
                    <i class="fas fa-star"></i>
                    <?php endif; ?>
                  </a>
                </td>
                <td class="center">
                  <a href="<?php echo e(url('/admin/artists/status/'.$user->id)); ?>" class="btn btn-info btn-mini"><?php if($user->status == '0'): ?> Approve <?php else: ?> Unapprove <?php endif; ?></a>
                  <!-- <a href="<?php echo e(url('/admin/users/edit/'.$user->id)); ?>" class="btn btn-primary btn-mini">Edit</a> -->
                  <a href="<?php echo e(url('/admin/artists/delete/'.$user->id)); ?>" class="btn btn-danger btn-mini">Delete</a>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>