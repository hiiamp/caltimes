<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="col-md-4 animate-box">
                <div id="colorlib-logo"><a href="<?php echo e(route('home')); ?>">Caltimes</a></div>
            </div>
            <div class="col-md-6 animate-box">
                <ul>
                    <li><a href="<?php echo e(route('home')); ?>">My Board</a></li>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->level==2): ?>
                            <li><a href="<?php echo e(route('admin.list')); ?>">Admin page</a></li>
                        <?php endif; ?>
                        <li class="has-dropdown">
                            <a href="#"><?php echo e(Auth::user()->name); ?></a>
                            <ul class="dropdown">
                                <li><a href="<?php echo e(route('profile')); ?>">Profile</a></li>
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
                            <input id="search" name="search" type="text" class="btn" placeholder="Search...">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/layouts/navbar.blade.php ENDPATH**/ ?>