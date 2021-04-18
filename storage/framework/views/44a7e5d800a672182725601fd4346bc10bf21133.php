<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Subscriber list</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Subscription Plan</li>
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
                <tr>
                  <th>Subscriber Name(Artist)</th>
                  <th>Email</th>
                  <th>Plan Name</th>
                  
                  <th>Next Payment Date</th>                  
                  <th>Status</th>                  
                </tr>
                </thead>
                <tbody>
                <?php if($listSubscribers): ?>
                
                  
                <?php $__currentLoopData = $listSubscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($subscriber->first_name.' '.$subscriber->last_name); ?></td>
                  <td><?php echo e($subscriber->email); ?></td>					        
                  <td><?php echo e($subscriber->plan_name); ?></td>
                  
                  <td><?php echo e($subscriber->next_billing_date); ?></td>
                  <td><?php echo e($subscriber->status); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                <?php else: ?>
                  <tr><td colspan="6" style="text-align: center">Data not found</td></tr>    
                <?php endif; ?>
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