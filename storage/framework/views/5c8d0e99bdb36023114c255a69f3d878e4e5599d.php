<div class="colorlib-blog">
    <div class="container">
        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input id="list_id1" type="hidden" value="<?php echo e($task->todo_list_id); ?>">
            <?php break; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="row displayTask">
            <div class="col-md-4 animate-box">
                <article class="model">
                    <h2>To do</h2>
                    <ul id="sortable1" type="status1" class="connectedSortable detail-task1">
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($task->status_id==1): ?>
                                <li data-index="<?php echo e($task->id); ?>" data-position="<?php echo e($task->position); ?>" data-status="<?php echo e($task->todo_list_id); ?> " class="has-dropdown">
                                    <p>
                                        <a style="color: black;" ><?php echo e($task->name); ?></a>
                                    </p>
                                </li>
                                <!--<span data-index="<?php echo e($task->id); ?>" class="delete_task"><i class="icon-delete" style="color: green"></i></span>-->
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button id="add-task" type="submit" class="btn btn-primary">Add task</button>
                </article>
            </div>
            <div class="col-md-4 animate-box">
                <article class="model">
                    <h2>In process</h2>
                    <ul id="sortable2" type="status2" class="connectedSortable detail-task2">
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($task->status_id==2): ?>
                                <li data-index="<?php echo e($task->id); ?>" data-position="<?php echo e($task->position); ?>" data-status="<?php echo e($task->todo_list_id); ?> " class="has-dropdown">
                                    <p>
                                        <a style="color: black;" ><?php echo e($task->name); ?></a>
                                    </p>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </article>
            </div>
            <div class="col-md-4 animate-box">
                <article class="model">
                    <h2>Done</h2>
                    <ul id="sortable3" type="status3" class="connectedSortable detail-task3">
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($task->status_id==3): ?>
                                <li data-index="<?php echo e($task->id); ?>" data-position="<?php echo e($task->position); ?>" data-status="<?php echo e($task->todo_list_id); ?> " class="has-dropdown">
                                    <p>
                                        <a style="color: black;" ><?php echo e($task->name); ?></a>
                                    </p>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </article>
            </div>
        </div>
    </div>
</div>

<!--Detail task-->
<dialog id="detail-dialog">
    <form method="post" action="<?php echo e(route('edit.task')); ?>">
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-8 animate-box">
                    <h2>Task's Information</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-info-wrap-flex">
                                <div class="con-info">
                                    <p><span><i class="icon-location-2"></i></span> Assign </p>
                                    <input hidden="hidden" value="" id="task_edit_id" name="task_id" >
                                    <select class="btn" name="assign" class="custom-select" id="assign">
                                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option class="hiddenn" hidden="hidden" id="assign<?php echo e($task->id); ?>" value="<?php echo e($task->assign->id); ?>"><?php echo e($task->assign->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $list_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option class="showw" id="choose<?php echo e($userp->id); ?>" value="<?php echo e($userp->id); ?>"><?php echo e($userp->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="con-info">
                                    <p class="hiddenn" id="status1" hidden="hidden"><span><i class="icon-paperplane"></i></span> Status <br> To do </p>
                                    <p class="hiddenn" id="status2" hidden="hidden"><span><i class="icon-paperplane"></i></span> Status <br> In process </p>
                                    <p class="hiddenn" id="status3" hidden="hidden"><span><i class="icon-paperplane"></i></span> Status <br> Done </p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-globe"></i></span>Prioty level <br> Medium </p>
                                </div>
                                <div class="con-info">
                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <input class="delete_task" data-index="<?php echo e($task->id); ?>" id="deletetask<?php echo e($task->id); ?>" type="button" value="Delete this task">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-pull-4 animate-box">
                    <div class="row form-group">
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-12">
                                <p>Title</p>
                                <input hidden="hidden" name="name" id="name<?php echo e($task->id); ?>" cols="30" rows="1" class="hidden_dis" value="<?php echo e($task->name); ?>" >
                            </div>
                            <div class="col-md-12">
                                <p>Content</p>
                                <textarea hidden="hidden" name="content" id="content<?php echo e($task->id); ?>" cols="30" rows="10" class="hidden_dis" ><?php echo e($task->content); ?></textarea>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="form-group">
                        <input id="save11" type="submit" value="Save" class="btn btn-primary">
                        <input id="out11" type="reset" value="Cancel" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
</dialog>

<!--delete task-->
<dialog id="deletetaskdialog">
    <form method="post" action="<?php echo e(route('delete.task')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row form-group">
            <div class="col-md-12">
                <p>You really want to delete this task?</p>
                <input id="delete_task_id" type="hidden" class="form-control" name="task_id" value="">
            </div>
        </div>
        <div class="form-group">
            <input id="delete_task_submit" type="submit" value="Yes, I'm sure." class="btn btn-primary">
            <input id="delete_task_cancel" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>
<!--Create task-->
<dialog id="create-task">
    <form method="post" action="<?php echo e(route('create_task')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row form-group">
            <div class="col-md-12">
                <p>Create task</p>
                <input type="hidden" id="todoid" class="form-control" name="todoid" value="<?php echo e($list->id); ?>">
                <input type="hidden" id="link" class="form-control" name="link" value="<?php echo e($list->link); ?>">
                <input type="hidden" id="status" class="form-control" name="status" value="1">
                <input type="hidden" id="position" class="form-control" name="position" value="0">
                <input id="name" type="name" class="form-control" name="name" required autofocus placeholder="Your task title">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Importance</label>
                    </div>
                    <select class="btn" name="priority" class="custom-select" id="priority">
                        <option>High</option>
                        <option>Medium</option>
                        <option>Low</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input id="save1" type="submit" value="Save" class="btn btn-primary">
            <input id="out1" type="submit" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>

<?php echo $__env->make('user.todo_list.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/todo_list/layouts/content.blade.php ENDPATH**/ ?>