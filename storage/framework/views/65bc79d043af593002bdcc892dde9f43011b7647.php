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
                    <h3 class="mb-0"><?php echo e($lists->table_name); ?></h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Create at</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Option</th>
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
                                <td>
                                    <a href="<?php echo e(route('admin.user').'?list_id='.$list->id); ?>" class="btn btn-sm btn-primary" style="color: whitesmoke"> Worker </a>
                                    <?php if(\Illuminate\Support\Facades\Auth::user()->level==2): ?>
                                        <a data-index="<?php echo e($list->id); ?>" id="Delete<?php echo e($list->id); ?>" class="btn btn-sm btn-primary delete_l" style="color: whitesmoke"> Delete </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                    <?php echo e($lists->links()); ?>

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

<dialog id="deletelistdialog1">
    <form method="post" action="<?php echo e(route('delete.list')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row form-group">
            <div class="col-md-12">
                <p>You really want to delete this list?</p>
                <input id="todo_list_id_delete" type="hidden" class="form-control" name="todo_list_id" value="">
                <input name="checkadmin" value="true" hidden="hidden">
            </div>
        </div>
        <div class="form-group">
            <input id="delete_submit1" type="submit" value="Yes, I'm sure." class="btn btn-primary">
            <input id="delete_cancel1" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>

<script>
    $(function(){
        var dialog_delete = document.querySelector('#deletelistdialog1');
        dialog_delete.close();
        $(".delete_l").each(function (index) {
            $(this).click(function () {
                dialog_delete.showModal();
                var list_id = $(this).attr('data-index');
                $('#todo_list_id_delete').attr('value', list_id);
            });
        });
        document.querySelector('#delete_submit1').onclick = function () {
            dialog_delete.close();
        };
        document.querySelector('#delete_cancel1').onclick = function () {
            dialog_delete.close();
        };
    });
</script>

<?php echo $__env->make('admin.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/admin/list.blade.php ENDPATH**/ ?>