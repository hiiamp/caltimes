<div class="colorlib-featured">
    <div class="row animate-box">
        <div class="featured-wrap">
            <div class="owl-carousel">
                <div class="item">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="featured-entry">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header border-0">
                                            <h2 class="mb-0">My board</h2>
                                        </div>
                                        <div class="">
                                            <table id="customers">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Create at</th>
                                                    <th scope="col">Owner</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary" href="<?php echo e(route('link.board',['code'=>$list->link])); ?>"><?php echo e($list->link); ?></a>
                                                        </td>
                                                        <td>
                                                            <?php echo e($list->name); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($list->created_at); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($list->owner); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <ul class="pagination">
                                                    <?php echo e($lists->links()); ?>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="featured-entry">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header border-0">
                                            <h2 class="mb-0">Co-worker</h2>
                                        </div>
                                        <div class="">
                                            <table id="customers">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">On list</th>
                                                    <th scope="col">Level</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo e($user->name); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($user->email); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($user->list_name); ?>

                                                        </td>
                                                        <?php if(\Illuminate\Support\Facades\Auth::user()->level == 2): ?>
                                                            <td>
                                                                <?php if($user->level == 2): ?> Admin
                                                                <?php elseif($user->level == 1): ?> User
                                                                <?php else: ?> Not validate
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <ul class="pagination">
                                                    <?php echo e($users->links()); ?>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="featured-entry">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header border-0">
                                            <h2 class="mb-0">My account</h2>
                                        </div>
                                        <div id="colorlib-contact">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-4 col-md-push-8 animate-box">
                                                        <h2>About</h2>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="contact-info-wrap-flex">
                                                                    <div class="con-info">
                                                                        <p><span><i class="icon-location-2"></i></span> Email <br> <?php echo e(\Illuminate\Support\Facades\Auth::user()->email); ?></p>
                                                                    </div>
                                                                    <div class="con-info">
                                                                        <p><span><i class="icon-globe"></i></span> Date join <br> <?php echo e(\Illuminate\Support\Facades\Auth::user()->created_at); ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-pull-4 animate-box">
                                                        <h2><?php echo e(\Illuminate\Support\Facades\Auth::user()->name); ?></h2>
                                                        <form method="post" action="">
                                                            <div class="col-md-12">
                                                                <p>Title</p>
                                                                <input hidden="hidden" name="name" id="" cols="30" rows="1" class="hidden_dis" value="" >
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-4">
                                                                    <input type="submit" value="Save" class="btn btn-primary">
                                                                    <input type="submit" value="Cancel" class="btn btn-primary">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/profile/layouts/content.blade.php ENDPATH**/ ?>