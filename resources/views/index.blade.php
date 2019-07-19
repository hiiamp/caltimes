<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.header')
</head>

<body>
<div class="colorlib-loader"></div>

<div>
    <nav class="colorlib-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="col-md-4 animate-box">
                    <div style="font-size: x-large" id="colorlib-logo"><a href="{{route('home')}}">Caltimes</a></div>
                </div>
                <div class="col-md-4 animate-box"></div>
                <div class="col-md-4 animate-box">
                    <ul>
                        <li class="btn btn-primary btn-lg btn-custom has-dropdown" style="margin-right: 20px">
                            <a href="{{route('login')}}">Login
                                <i class="icon-arrow-right3"></i></a>
                        </li>
                        <li>
                            <a href="{{route('register')}}" class="btn btn-primary btn-lg btn-custom">
                                Register
                                <i class="icon-arrow-right3"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="video-hero"
             style="height: 200px; background-image: url({{asset('user/images/cover_img_1.jpg')}});  background-size:cover; background-position: center center;background-attachment:fixed;"
             data-section="home">
        <div class="overlay"></div>
        <div style="height: 250px;" class="display-t display-t2 text-center">
            <div class="display-tc display-tc2">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2 style="font-size: 50px">Welcome</h2>
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
                                    <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">123 456
                                            789</a></p>
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
                                <p>Caltimes’s boards, lists, and cards enable you to organize and prioritize your
                                    projects in a fun, flexible, and rewarding way.</p>
                            </div>
                        </div>
                        <div class="features">
                            <span class="icon"><i class="icon-beaker"></i></span>
                            <div class="f-desc">
                                <p>Whether it’s for work, a side project or even the next family vacation, Trello helps
                                    your team stay organized.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('status'))
    <dialog id="notif">
        <div class="row form-group">
                <span class="alert alert-warning help-block">
                    <strong>{{ session('status') }}</strong>
                </span>
        </div>
        <div class="form-group">
            <input id="ok" type="submit" value="Ok" style="width: 100px" class="btn btn-primary">
        </div>
    </dialog>
    <script>
        var dialog11 = document.querySelector('#notif');
        dialog11.showModal();
        document.querySelector('#ok').onclick = function () {
            dialog11.close();
        };
        document.querySelector('#cancel').onclick = function () {
            dialog11.close();
        };
    </script>
@endif
@include('user.layouts.script')
</body>
</html>
