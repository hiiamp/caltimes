<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('user.todo_list.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('user.todo_list.layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/todo_list/index.blade.php ENDPATH**/ ?>