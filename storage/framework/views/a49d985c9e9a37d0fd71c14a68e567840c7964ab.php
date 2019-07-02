<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="col-md-4 animate-box">
                <div id="colorlib-logo"><a href="<?php echo e(route('home')); ?>">Caltimes</a></div>
            </div>
            <div class="col-md-4 animate-box">
                <ul>
                    <li><a href="#">Board</a></li>
                    <li><a href="#">Contact</a></li>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="has-dropdown">
                            <a href="#"><?php echo e(Auth::user()->name); ?></a>
                            <ul class="dropdown">
                                <li><a href="<?php echo e(route('logout')); ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-4 animate-box">
                <form class="form-inline qbstp-header-subscribe">
                    <div class="col-three-forth">
                        <div class="form-group">
                            <input type="text" class="btn" placeholder="Search...">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH /home/truongphi/internPHP/bigproject/todolistapp/resources/views/user/layouts/navbar.blade.php ENDPATH**/ ?>