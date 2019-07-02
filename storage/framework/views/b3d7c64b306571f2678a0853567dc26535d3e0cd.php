<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="<?php echo e(route('home')); ?>">
            <h1>CALTIMES</h1>
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="#">
                            <img src="<?php echo e(asset('admin/img/brand/blue.png')); ?>">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('home')); ?>">
                        <i class="ni ni-tv-2 text-primary"></i> Home
                    </a>
                </li>
                <?php if(\Illuminate\Support\Facades\Auth::user()->level==2): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.list')); ?>">
                            <i class="ni ni-bullet-list-67 text-red"></i> List management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.user')); ?>">
                            <i class="ni ni-circle-08 text-pink"></i> User management
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('profile.list')); ?>">
                            <i class="ni ni-bullet-list-67 text-red"></i> List joined
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('profile.user')); ?>">
                            <i class="ni ni-circle-08 text-pink"></i> Co-worker
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/admin/layouts/sidenav.blade.php ENDPATH**/ ?>