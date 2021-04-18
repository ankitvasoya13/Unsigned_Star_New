<?php $__env->startSection('content'); ?>
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
    <div class="title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="indx_title_left_wrapper ms_cover">
                    <h2>Subscribe</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item">Subscribe</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- inner Title End -->
<!-- top artist wrapper start -->
<div class="contact_section treanding_songs_wrapper ms_cover">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <?php if(Session::has('error')): ?>
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo session('error'); ?>

                </div>
                <?php endif; ?>
                <?php if(Session::has('success')): ?>
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo session('success'); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-7 col-sm-12" style="margin-bottom: 10px;">
                <div class="ms_heading_wrapper artist_dashboard">
                    <h1>Plan Details</h1>
                </div><br clear="all" />
                <?php if($userDetails->user_type == 1): ?>

                <div class="card text-center">
                    <div class="card-header">
                        <span class="float-left">Profile :
                            <?php if($userDetails->remainingDays > 0): ?>
                            <span class="text-success">Active</span>
                            <?php else: ?>
                            <span class="text-danger">Inactive</span>
                            <?php endif; ?>
                        </span>
                        <?php if($userDetails->end_validity): ?>
                        <span class="float-right">Plan expire : <?php echo e(date('m/d/Y', strtotime($userDetails->end_validity))); ?>

                        <span class="text-danger">( <?php echo e(($userDetails->remainingDays < 0)? '0': $userDetails->remainingDays); ?> days remaining)</span> </span>
                        <?php endif; ?>
                        <input type="hidden" name="user_id" value="<?php echo e($userDetails->id); ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($planDetails->plan_name); ?></h5>
                        
                        <p class="card-text">Track Limit : <?php echo e($planDetails->track_limit); ?></p>
                        <p class="card-text">Validity : <?php echo e($planDetails->frequency); ?> (auto-renewal)</p>
                        <?php if($planDetails->is_trial == 1): ?>
                            <p class="card-text">Trail Price : $<?php echo e($planDetails->trial_price); ?>/<?php echo e($planDetails->frequency); ?></p>
                            <p class="card-text">Regular Price : $<?php echo e($planDetails->price); ?>/<?php echo e($planDetails->frequency); ?></p>
                        <?php else: ?>
                            <p class="card-text">Regular Price : $<?php echo e($planDetails->price); ?>/<?php echo e($planDetails->frequency); ?></p>
                        <?php endif; ?>
                        <input type="hidden" name="plan_id" id="plan_id" value="<?php echo e(Request::segment(3)); ?>">
                        
                        <p><span id="discountPrice"></span></p>                        
                        
                    </div>
                    <div class="card-footer text-muted">
                        
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>

       
    </div>
</div>
<!-- top artist wrapper start -->

<?php $__env->stopSection(); ?>
<script
    src="https://www.paypal.com/sdk/js?client-id=ARDTLtYhBMTqfp6S7f5_LfsCdgjjJyHi58ro05JwCZQ4mVrTzfgNAqFpsX7DshidrZpXgK5o_KR7Tlpj&vault=true&intent=subscription">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        
        // $(document).ready(function(){
        //     plan_id = $('input[name=plan_id]').val();            
        // });
        
        paypal.Buttons({
            createSubscription: function(data, actions) {
              return actions.subscription.create({
                'plan_id': $('input[name=plan_id]').val() // Creates the subscription
              });
            },
            onApprove: function(returnData, actions) {
                subscriptionSuccess(returnData);
            }
          }).render('#paypal-button-container'); // Renders the PayPal button

        $(document).on('click','#couponBtn',function() {        
            var promocode = $('input[name=promocode]').val();
            var _token = $('input[name=_token]').val();
            // var id = $('input[name=id]').val();
            $.ajax({
                url:'<?php echo e(route("coupon.check")); ?>',
                type:'post',
                data:{"promocode":promocode, _token:_token},
                dataType:"json",
                success:function(data)
                {
                    $('#discountPrice').html('<span style="color:green;">Discount : ' +data.coupon.amount +' '+data.coupon.type+ ' applied!</span>');                 
                    $('input[name=plan_id]').val(data.coupon.plan_id);
                    $('#paypal-button-container').html('');
                    
                        paypal.Buttons({
                        createSubscription: function(data, actions) {
                            return actions.subscription.create({
                                'plan_id': $('input[name=plan_id]').val() // Creates the subscription
                            });
                            },
                            onApprove: function(returnData, actions) {
                                subscriptionSuccess(returnData);                                
                            }
                        }).render('#paypal-button-container'); // Renders the PayPal button
                     
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#discountPrice').html('<span style="color:red;">Coupon code is invalid!</span>');
                }
                
            });
            });

            
            function subscriptionSuccess(data) {
                var _token = $('input[name=_token]').val();
                $.ajax({
                url:'<?php echo e(route("subscriber.create")); ?>',
                type:'post',
                data:{"user_id":$('input[name=user_id]').val(), _token:_token,"subscriptionID":data.subscriptionID,"orderID":data.orderID,"billingToken":data.billingToken,"facilitatorAccessToken":data.facilitatorAccessToken,"paymentID":data.paymentID},
                dataType:"json",
                    success:function(data)
                    {
                        //alert('Subscription plan is activated.');
                        window.location.href = "<?php echo e(url('/dashboard')); ?>";
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('something wrong, please try later.');
                    }
                });
            };
       
</script>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>