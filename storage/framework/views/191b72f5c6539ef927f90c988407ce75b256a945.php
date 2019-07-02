<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('user.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
<div class="colorlib-loader"></div>

<div id="page">
<?php echo $__env->make('user.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>
</div>

<?php echo $__env->make('user.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('user.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/master.blade.php ENDPATH**/ ?>