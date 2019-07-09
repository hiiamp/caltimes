<nav class="colorlib-nav" role="navigation" style="position: fixed" id="app">
<script type="text/ecmascript">
    window.Laravel = JSON.parse('<?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>');
</script>
<script>
    window.Laravel.userId = '<?php echo auth()->user()->id; ?>'
    window.Laravel.userName = '<?php echo auth()->user()->name; ?>'
</script>
    <div class="top-menu">
        <div class="container">
            <div class="col-md-4 animate-box">
                <div id="colorlib-logo"><a data-pjax href="<?php echo e(route('home')); ?>">Caltimes</a></div>
            </div>
            <div class="col-md-6 animate-box">
                <ul>
                    <li><a data-pjax href="<?php echo e(route('home')); ?>">My Board</a></li>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::check()): ?>
                            <?php if(Auth::user()->level==2): ?>
                                <li><a href="<?php echo e(route('admin.list')); ?>">Admin page</a></li>
                            <?php endif; ?>
                            <!--<task v-bind:tasks="tasks"></task>-->
                                <li><a data-pjax href="<?php echo e(route('notification')); ?>">Activity</a></li>
                        <?php endif; ?>
                        <li class="has-dropdown">
                            <a href="#"><?php echo e(Auth::user()->name); ?></a>
                            <ul class="dropdown">
                                <li><a data-pjax href="<?php echo e(route('profile')); ?>">Profile</a></li>
                                <li><a href="<?php echo e(route('logout')); ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-2 animate-box">
                <form class="form-inline qbstp-header-subscribe">
                    <div class="col-three-forth">
                        <div class="form-group">
                            <input id="search" style="text-align: left" name="search" type="text" class="btn" placeholder=" Enter what you want to find">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav><?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/layouts/navbar.blade.php ENDPATH**/ ?>