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
                                                        <form data-pjax method="get" action="#">
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
                <div class="item">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="featured-entry">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header border-0">
                                            <h2 class="mb-0">Favourite Co-Worker</h2>
                                        </div>
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
                                                            <input data-wk="yes" type="reset" class="listfv btn btn-sm btn-primary" data-id="<?php echo e($u->id); ?>" value="Remove favourite">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div data-pjax class="col-md-12 text-center">
                                                <ul class="pagination">

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
                                            <h2 class="mb-0">All people you are working with:</h2>
                                        </div>
                                        <div class="">
                                            <table id="customers">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">On list</th>
                                                    <?php if(\Illuminate\Support\Facades\Auth::user()->level == 2): ?>
                                                        <th scope="col">Level</th>
                                                    <?php endif; ?>
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
                                                            <a data-pjax class="btn btn-sm btn-primary" href="<?php echo e(route('link.board',['code'=>$user->list_code])); ?>"><?php echo e($user->list_name); ?></a>
                                                        </td>
                                                        <?php if(\Illuminate\Support\Facades\Auth::user()->level== 2): ?>
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
                                            <div data-pjax class="col-md-12 text-center">
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
                                            <h2 class="mb-0">Recycle:</h2>
                                        </div>
                                        <div class="">
                                            <table id="customers">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Number of tasks</th>
                                                    <th scope="col">Created at</th>
                                                    <th scope="col">Option</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $recycleList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo e($list->name); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($list->numtask); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($list->created_at); ?>

                                                        </td>
                                                        <td>
                                                            <a data-pjax class="btn btn-sm btn-primary" href="<?php echo e(route('list.recover',['code'=>$list->link])); ?>">Recover List</a>
                                                            <a data-pjax data-index="<?php echo e($list->id); ?>" id="Delete<?php echo e($list->id); ?>" class="btn btn-sm btn-primary delete_l" style="color: whitesmoke"> Delete </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div data-pjax class="col-md-12 text-center">
                                                <ul class="pagination">
                                                    <!--<?php echo e($users->links()); ?>-->
                                                </ul>
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
<script>
    $('.listfv').each(function () {
        $(this).click(function () {
            var user_co_id = $(this).attr('data-id');
            var check = true;
            if($(this).attr('data-wk') === 'no') check = false;
            if(check){
                $(this).attr('data-wk', 'no');
                $(this).attr('value', 'Add favorite');
            } else {
                $(this).attr('data-wk', 'yes');
                $(this).attr('value', 'Remove favorite');
            }
            $.ajax({
                url : '<?php echo e(route('toggleCoWorker')); ?>',
                dataType: 'json',
                data:{'user_co_id': user_co_id},
                success:function(data){

                }
            });
        });
    });
</script>
<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items:1,
        loop:true,
        autoplay:false,
        autoplayTimeout:1000,
        autoplayHoverPause:true
    });
    owl.trigger('stop.owl.autoplay');
</script>

<dialog id="deletelistdialog1">
    <form data-pjax method="post" action="<?php echo e(route('delete.list')); ?>">
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
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/profile/layouts/content.blade.php ENDPATH**/ ?>