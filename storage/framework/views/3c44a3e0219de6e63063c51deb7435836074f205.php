<!-- notification dialog -->
<dialog id="notif_dialog">
    <form>
        <?php if(session('notif')): ?>
            <span class="alert alert-warning help-block">
                <strong><?php echo e(session('notif')); ?></strong>
            </span>
        <?php endif; ?>
        <div class="form-group">
            <input id="notifok" type="reset" value="Ok" class="btn btn-primary">
        </div>
    </form>
</dialog>
<?php if(session('notif')): ?>
    <script>
        var dialog_notif = document.querySelector('#notif_dialog');
        dialog_notif.showModal();
        document.querySelector('#notifok').onclick = function () {
            dialog_notif.close();
        };
    </script>
<?php endif; ?>
<?php /**PATH /home/truongphi/internPHP/bigproject/todo-list/resources/views/user/layouts/notification.blade.php ENDPATH**/ ?>