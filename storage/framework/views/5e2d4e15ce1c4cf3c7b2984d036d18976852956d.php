<section id="home" class="video-hero" style="height: 400px; background-image: url(<?php echo e(asset('user/images/cover_img_1.jpg')); ?>);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
    <div class="overlay"></div>
    <div class="display-t display-t2 text-center">
        <div class="display-tc display-tc2">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <h2><?php echo e($list->name); ?></h2>
                        <h3>Create by: <?php echo e($username); ?></h3>
                        <?php if($own == true): ?>
                            <?php if($list->is_public == 1): ?>
                                <h4>Your list is Public</h4>
                            <?php else: ?>
                                <h4>Your list is Private</h4>
                            <?php endif; ?>
                            <p class="breadcrumbs" style="font-size: large">
                                    <input class="btn btn-sm btn-primary worker_joined" value="Worker Joined" type="button">
                                    <input class="btn btn-sm btn-primary sharewith" value="Share with" type="button">
                                <?php if($list->is_public == 0): ?>
                                    <button class="btn btn-sm btn-primary"><a data-pjax style="color: white" href="<?php echo e(route('private.list').'?list_id='.$list->id); ?>">Change to Public</a></button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-primary"><a data-pjax style="color: white" href="<?php echo e(route('public.list').'?list_id='.$list->id); ?>">Change to Private</a></button>
                                <?php endif; ?>
                                <input class="btn btn-sm btn-primary" id="delete_list" value="Delete" type="button">
                                <input class="btn btn-sm btn-primary activities" value="Activities" type="button">
                            </p>
                        <?php else: ?>
                            <?php if($list->is_public == 1): ?>
                                <h4>This list is Public</h4>
                            <?php else: ?>
                                <h4>This list is Private</h4>
                            <?php endif; ?>
                            <p class="breadcrumbs" style="font-size: large">
                                <input class="btn btn-sm btn-primary worker_joined" value="Worker Joined" type="button">
                                <span><a hidden="hidden" class="sharewith">Share with</a></span>
                                <span><a hidden="hidden" id="delete_list">Delete</a></span>
                                <input class="btn btn-sm btn-primary activities" value="Activities" type="button">
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="sharewithdialog">
        <form method="post" action="<?php echo e(route('share.list')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row form-group">
                <div class="col-md-12">
                    <p>Input email of user that you want to share</p>
                    <?php if(session('message1')): ?>
                        <span class="alert alert-warning help-block">
                        <strong><?php echo e(session('message1')); ?></strong>
                    </span>
                    <?php endif; ?>
                    <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Email you want to share">
                    <input id="todo_list_id" type="hidden" class="form-control" name="todo_list_id" value="<?php echo e($list->id); ?>">
                </div>
            </div>
            <div class="form-group">
                <input id="share" type="submit" value="Share" class="btn btn-primary">
                <input id="cancelshare" type="reset" value="Cancel" class="btn btn-primary">
                <input id="myfavourite" type="reset" value="My Favourite Co-Worker" class="btn btn-primary">
            </div>
        </form>
    </dialog>

    <dialog id="deletelistdialog">
        <form method="post" action="<?php echo e(route('recycle.list')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row form-group">
                <div class="col-md-12">
                    <p>You really wanna move this list to your recycle?</p>
                    <input id="todo_list_id" type="hidden" class="form-control" name="todo_list_id" value="<?php echo e($list->id); ?>">
                </div>
            </div>
            <div class="form-group">
                <input id="delete_submit" type="submit" value="Yes, I'm sure." class="btn btn-primary">
                <input id="delete_cancel" type="reset" value="Cancel" class="btn btn-primary">
            </div>
        </form>
    </dialog>
    <?php if(session('message1')): ?>
        <script>
            var dialog_share = document.querySelector('#sharewithdialog');
            dialog_share.showModal();
        </script>
    <?php endif; ?>

    <dialog id="dialogjoined">
        <div class="">
            <table id="customers">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Number of Tasks</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $list_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($u->name); ?><?php if($u->id == @Auth::user()->id): ?> (me) <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($u->email); ?>

                            </td>
                            <td>
                                <?php echo e($u->countTask); ?>

                            </td>
                            <td>
                                <?php if(Auth::check()): ?>
                                <form>
                                    <?php if($u->id == Auth::user()->id): ?>
                                        <?php if($own == true): ?>
                                            <a href="<?php echo e(route('profile')); ?>" class="btn btn-sm btn-primary" style="color: white"> My Profile </a>
                                            <input id="outlist" hidden="hidden" disabled>
                                        <?php else: ?>
                                            <input id="outlist" data-wk="yes" style="color: #ffffff" type="reset" class="btn btn-sm btn-primary" data-id="<?php echo e($u->id); ?>" value="Leave this list?">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if($u->isCo != 0): ?>
                                            <input data-wk="yes" type="reset" class="listwk btn btn-sm btn-primary" data-id="<?php echo e($u->id); ?>" value="Remove favourite">
                                        <?php else: ?>
                                            <input data-wk="no" type="reset" class="listwk btn btn-sm btn-primary" data-id="<?php echo e($u->id); ?>" value="Add favourite">
                                        <?php endif; ?>
                                        <?php if($own == true): ?>
                                            <input data-wk="yes" type="reset" class="sharewk btn btn-sm btn-primary" data-id="<?php echo e($u->id); ?>" list-id="<?php echo e($list->id); ?>" value="Kick Out?">
                                        <?php else: ?>
                                            <input class="sharewk" hidden="hidden" disabled>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <button id="joinedcancel" class="btn btn-sm btn-primary">Cancel</button>
        </div>
    </dialog>

    <!-- notification dialog -->
    <dialog id="out_list_dialog">
        <form method="post" action="<?php echo e(route('out.list')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row form-group">
                <div class="col-md-12">
                    <p>You really want to out this list?</p>
                    <input type="hidden" class="form-control" name="todo_list_id" value="<?php echo e($list->id); ?>">
                </div>
            </div>
            <div class="form-group">
                <input id="delete_access_submit" type="submit" value="Yes, I'm sure." class="btn btn-primary">
                <input id="delete_access_cancel" type="reset" value="Cancel" class="btn btn-primary">
            </div>
        </form>
    </dialog>

    <!-- favourite coworker share dialog -->
    <?php if(Auth::check()): ?>
    <dialog id="myfavourite_dialog">
        <div class="">
            <table id="customers">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $favourites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($u->name); ?>

                        </td>
                        <td>
                            <?php echo e($u->email); ?>

                        </td>
                        <td>
                            <form>
                                <?php if($u->shared == 0): ?>
                                    <input data-fv="no" type="reset" class="sharefv btn btn-sm btn-primary" data-id="<?php echo e($u->id); ?>" list-id="<?php echo e($list->id); ?>" value="Share this list">
                                <?php else: ?>
                                    <input data-fv="yes" type="reset" class="sharefv btn btn-sm btn-primary" data-id="<?php echo e($u->id); ?>" list-id="<?php echo e($list->id); ?>" value="UnShare">
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <button id="fvdialogcancel" class="btn btn-sm btn-primary">Cancel</button>
        </div>
    </dialog>
    <?php endif; ?>
</section>
<dialog id="activiesdialog">
    <h2 class="alert alert-warning" style="color: red">This function is developing</h2>
    <input id="acti_cancel" type="reset" value="Cancel" class="btn btn-primary">
</dialog>
<script>
    var dialog_deve = document.querySelector('#activiesdialog');
    document.querySelector('.activities').onclick = function() {
        dialog_deve.showModal();
    };
    document.querySelector('#acti_cancel').onclick = function() {
        dialog_deve.close();
    };
</script>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/todo_list/layouts/header.blade.php ENDPATH**/ ?>