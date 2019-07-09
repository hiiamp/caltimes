<?php $__env->startSection('content'); ?>
    <title><?php echo e(Auth::user()->name); ?></title>

    <?php echo $__env->make('user.profile.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('user.profile.layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/profile/index.blade.php ENDPATH**/ ?>