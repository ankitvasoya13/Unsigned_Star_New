<style>
    .btn-load {
        display: inline-block;
        width: 160px;
        height: 45px;
        line-height: 45px;
        text-align: center;
        background: transparent;
        color: #111111;
        border: 1px solid #e6e6e6;
        cursor: pointer;
        margin-top: 50px;
        margin-bottom: 40px;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
    }

    .btn-load:hover {
        background: -moz-linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
        background: -webkit-linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
        background: linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
        color: #fff;
        border: 1px solid rgb(248, 71, 62);
    }
</style>
<?php $__currentLoopData = $competitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="blog_category_box_wrapper blog_box_wrapper2 float_left">
            <div class="blog_news_img_wrapper float_left"> <a href="<?php echo e(url('/competitions/competitionDetails/'.$competition->id)); ?>"><img src="<?php echo e(asset('/uploads/'.$competition->featured_image)); ?>"></a> </div>
            <div class="lest_news_cont_wrapper float_left">
                <div class="blog_heaidng_top">
                    <?php
                    $competitionDate = date('m/d/Y', strtotime($competition->start_datetime));
                    ?>
                    <span> <i class="flaticon-calendar"></i><?php echo e($competitionDate); ?></span>
                    <h3> <a href="<?php echo e(url('/competitions/competitionDetails/'.$competition->id)); ?>">
                            <?php echo mb_substr(html_entity_decode($competition->competition_name),0,20) .
                        ((strlen(html_entity_decode($competition->competition_name)) > 20) ? '...' : ''); ?>

                        </a></h3>
                </div>
                <div class="blog-single_cntnt">
                    <?php echo mb_substr(html_entity_decode($competition->short_description),0,25) . ((strlen(html_entity_decode($competition->short_description)) > 25) ? '...' : ''); ?>

                    <a href="<?php echo e(url('/competitions/competitionDetails/'.$competition->id)); ?>"> read more</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if($total >= $limit): ?>
    <button class="btn-load" onclick="competitionsLoad(<?php echo e($limit); ?>)">Show more competitions</button>
    <?php endif; ?>

</div>