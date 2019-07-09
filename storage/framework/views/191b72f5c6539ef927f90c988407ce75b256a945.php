<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('user.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<?php echo $__env->make('user.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="colorlib-loader" ></div>
<body id="body">
<div id="page">
    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
<?php echo $__env->make('user.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('user.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(Auth::check()): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
            $(document).on('submit', 'form[data-pjax]', function(event) {
                $.pjax.submit(event, '#page');
            });
            // does current browser support PJAX
            if ($.support.pjax) {
                $.pjax.defaults.timeout = 2000; // time in milliseconds
            }
            $(document).on('pjax:complete', function() {
                loadpage();
            })
        });
    </script>
<?php endif; ?>

</html>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/master.blade.php ENDPATH**/ ?>