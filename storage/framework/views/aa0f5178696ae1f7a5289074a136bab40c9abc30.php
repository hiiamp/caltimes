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
                        <li><a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg btn-custom">Login<i class="icon-arrow-right3"></i></a></li>
                        <li><a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-lg btn-custom">Register<i class="icon-arrow-right3"></i></a></li>
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
                            <h2>Welcome</h2>
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
                    <div class="desc">
                        <h2>We are here to help you!</h2>
                        <div class="features">
                            <span class="icon"><i class="icon-lightbulb"></i></span>
                            <div class="f-desc">
                                <p>Caltimes lets you work more collaboratively and get more done.</p>
                            </div>
                        </div>
                        <div class="features">
                            <span class="icon"><i class="icon-circle-compass"></i></span>
                            <div class="f-desc">
                                <p>Caltimes’s boards, lists, and cards enable you to organize and prioritize your projects in a fun, flexible, and rewarding way.</p>
                            </div>
                        </div>
                        <div class="features">
                            <span class="icon"><i class="icon-beaker"></i></span>
                            <div class="f-desc">
                                <p>Whether it’s for work, a side project or even the next family vacation, Trello helps your team stay organized.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('user.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /home/truongphi/internPHP/bigproject/todolistapp/resources/views/index.blade.php ENDPATH**/ ?>