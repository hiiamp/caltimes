<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
<?php echo $__env->make('admin.layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="main-content">

    <?php echo $__env->make('admin.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0"><?php echo e($users->name_table); ?></h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <?php if(\Illuminate\Support\Facades\Auth::user()->level == 2): ?>
                                <th scope="col">Level</th>
                            <?php endif; ?>
                            <th scope="col">Option</th>
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
                            <?php if(\Illuminate\Support\Facades\Auth::user()->level == 2): ?>
                                <td>
                                    <?php if($user->level == 2): ?> Admin
                                        <?php elseif($user->level == 1): ?> User
                                        <?php else: ?> Not validate
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <td>
                                <a href="<?php echo e(route('admin.list').'?user_id='.$user->id); ?>" class="btn btn-sm btn-primary" style="color: whitesmoke"> List joined </a>
                                <?php if(\Illuminate\Support\Facades\Auth::user()->level==2): ?>
                                    <a data-index="<?php echo e($user->id); ?>" class="btn btn-sm btn-primary delete_u" style="color: whitesmoke"> Delete </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                    <?php echo e($users->links()); ?>

                    <!--<ul class="pagination">
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<dialog id="deleteuserdialog1">
    <form method="post" action="<?php echo e(route('delete.user')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row form-group">
            <div class="col-md-12">
                <p>You really want to delete this user?</p>
                <input id="user_id_delete" type="hidden" class="form-control" name="user_id" value="">
                <input name="checkadmin" value="true" hidden="hidden">
            </div>
        </div>
        <div class="form-group">
            <input id="delete_submit2" type="submit" value="Yes, I'm sure." class="btn btn-primary">
            <input id="delete_cancel2" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>

<script>
    $(function(){
        var dialog_delete2 = document.querySelector('#deleteuserdialog1');
        $(".delete_u").each(function (index) {
            $(this).click(function () {
                dialog_delete2.showModal();
                var user_id = $(this).attr('data-index');
                $('#user_id_delete').attr('value', user_id);
            });
        });
        document.querySelector('#delete_submit2').onclick = function () {
            dialog_delete2.close();
        };
        document.querySelector('#delete_cancel2').onclick = function () {
            dialog_delete2.close();
        };
    });
</script>

<?php echo $__env->make('admin.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/admin/user.blade.php ENDPATH**/ ?>