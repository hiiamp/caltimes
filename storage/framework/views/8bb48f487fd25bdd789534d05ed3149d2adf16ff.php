<div class="colorlib-blog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                <!--<h2>My board</h2>-->
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-2 col-sm-3 col-xs-6 text-center animate-box">
                    <div class="product-entry">
                        <div class="product-img">
                            <article>
                                <h2><?php echo e($list->name); ?></h2>
                                <p class="admin"><span><?php echo e($list->created_at); ?></span></p>
                                <?php if($list->is_public==1): ?>
                                    <p><span><i class="icon-globe"></i></span> Public <br></p>
                                <?php else: ?>
                                    <p><span><i class="icon-globe"></i></span> Private <br></p>
                                <?php endif; ?>
                                <p><span><i class="icon-location-2"></i></span> Status: Done <br></p>
                                <p><a href="<?php echo e(route('link.board', ['code' => $list->link])); ?>" class="btn btn-primary btn-outline with-arrow">See more</a></p>
                                <div class="cart">
                                    <p class="breadcrumbs" style="font-size: small"><span><a href="#">Share with</a></span> <span><a href="#">Delete</a></span></p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($lists->links()); ?>

        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="pagination">
                    <li class="disabled"><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/truongphi/internPHP/bigproject/todolistapp/resources/views/user/home/layouts/content.blade.php ENDPATH**/ ?>