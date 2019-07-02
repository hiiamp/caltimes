<section id="home" class="video-hero" style="height: 400px; background-image: url(<?php echo e(asset('user/images/cover_img_1.jpg')); ?>);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
    <div class="overlay"></div>
    <div class="display-t display-t2 text-center">
        <div class="display-tc display-tc2">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <h2><?php echo e($list->name); ?></h2>
                        <h3>Create by: <?php echo e($username); ?></h3>
                        <?php if($list->is_public == 1): ?>
                            <h4>Your list is Public</h4>
                        <?php else: ?>
                            <h4>Your list is Private</h4>
                        <?php endif; ?>
                        <p class="breadcrumbs" style="font-size: large">
                                <span><a href="#">Share with</a></span>
                            <?php if($list->is_public == 0): ?>
                                <span><a href="#">Change to Public</a></span>
                            <?php else: ?>
                                <span><a href="#">Change to Private</a></span>
                            <?php endif; ?>
                            <span><a href="#">Delete</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/truongphi/internPHP/bigproject/todolistapp/resources/views/user/todo_list/layouts/header.blade.php ENDPATH**/ ?>