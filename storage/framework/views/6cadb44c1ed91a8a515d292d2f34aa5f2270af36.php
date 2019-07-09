<div class="colorlib-blog">
    <div class="container" style="margin-top: 100px">
        <?php if(\Illuminate\Support\Facades\Auth::Check()): ?>
            <?php if(auth()->user()->unreadNotifications->count()): ?>
                <?php $__currentLoopData = auth()->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mobile-wrap">
                            <div class="desc">
                                <div class="features">
                                    <a data-pjax href="<?php echo e(route('link.board',['code'=>$notification->data['list']['link']])); ?>" style="color: dodgerblue" class="icon"><i class="icon-lightbulb"></i><span>   <?php echo e($notification->data['list']['link']); ?></span></a>
                                    <div class="f-desc">
                                        <h3 style="color: grey">
                                            <?php if($notification->data['act'] == "share"): ?>
                                                <?php echo e($notification->data['user']['name']); ?> <?php echo e($notification->data['act']); ?> a list "<?php echo e($notification->data['list']['name']); ?>" at <?php echo e($notification->data['list']['created_at']); ?>

                                            <?php elseif($notification->data['act'] == "change"): ?>
                                                <?php echo e($notification->data['user']['name']); ?> <?php echo e($notification->data['act']); ?> status of a list at <?php echo e($notification->data['list']['created_at']); ?>

                                            <?php elseif($notification->data['act'] == "delete a list"): ?>
                                                <?php echo e($notification->data['user']['name']); ?> <?php echo e($notification->data['act']); ?> "<?php echo e($notification->data['list']['name']); ?>" at <?php echo e($notification->data['list']['created_at']); ?>

                                            <?php else: ?>
                                                <?php echo e($notification->data['user']['name']); ?> <?php echo e($notification->data['act']); ?> a task "<?php echo e($notification->data['task']['name']); ?>" on list "<?php echo e($notification->data['list']['name']); ?>" at <?php echo e($notification->data['task']['created_at']); ?>

                                            <?php endif; ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div><?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/notification/layouts/content.blade.php ENDPATH**/ ?>