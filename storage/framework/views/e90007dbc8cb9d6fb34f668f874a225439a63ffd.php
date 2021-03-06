<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('user.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
<div class="colorlib-loader"></div>

<div id="page">
    <nav class="colorlib-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="col-md-4 animate-box">
                    <div id="colorlib-logo"><a href="<?php echo e(route('home')); ?>">Caltimes</a></div>
                </div>
                <div class="col-md-4 animate-box"></div>
                <div class="col-md-4 animate-box">
                    <ul>
                        <li><a href="#">Board</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="video-hero" style="height: 400px; background-image: url(<?php echo e(asset('user/images/cover_img_1.jpg')); ?>);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
        <div class="display-t display-t2 text-center">
            <div class="display-tc display-tc2">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2>Login for manage your work!</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="colorlib-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-8 animate-box">
                    <h2>Contact us</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-info-wrap-flex">
                                <div class="con-info">
                                    <p><span><i class="icon-location-2"></i></span> 344 2/9 Street, <br> Da Nang</p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">123 456 789</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-globe"></i></span> <a href="#">yourwebsite.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-pull-4 animate-box">
                    <h2>Login</h2>
                    <form method="post" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php if(session('status')): ?>
                            <span class="alert alert-warning help-block">
                            <strong><?php echo e(session('status')); ?></strong>
                        </span>
                        <?php endif; ?>
                        <?php if(session('warning')): ?>
                            <span class="alert alert-warning help-block">
                            <strong><?php echo e(session('warning')); ?></strong>
                        </span>
                        <?php endif; ?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus placeholder="Your email address">

                                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="current-password" placeholder="Your password">

                                <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <input type="submit" value="Sign in" class="btn btn-primary">
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo e(route('register')); ?>">Create an account?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('user.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /home/truongphi/internPHP/bigproject/todolistapp/resources/views/login.blade.php ENDPATH**/ ?>