<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.header')
</head>

<body>
<div class="colorlib-loader"></div>

<div id="page">
    <nav class="colorlib-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="col-md-4 animate-box">
                    <div id="colorlib-logo"><a href="{{route('home')}}">Caltimes</a></div>
                </div>
                <div class="col-md-4 animate-box"></div>
                <div class="col-md-4 animate-box">
                    <ul>
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

    <section id="home" class="video-hero" style="height: 400px; background-image: url({{asset('user/images/cover_img_1.jpg')}});  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
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
                    <form method="post" action="{{route('login')}}">
                        @csrf
                        @if (session('status'))
                            <span class="alert alert-warning help-block">
                            <strong>{{ session('status') }}</strong>
                        </span>
                        @endif
                        @if (session('warning'))
                            <span class="alert alert-warning help-block">
                            <strong>{{ session('warning') }}</strong>
                        </span>
                        @endif
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Your email address">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                                <input type="submit" value="Sign in" class="btn btn-primary">
                            </div>
                            <div class="col-md-4">
                                <!--<a href="{{route('facebook.login')}}">Login with Facebook</a>-->
                                <a class = "developing">Login with Facebook</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('register')}}">Create an account?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<dialog id="develop">
    <h2 class="alert alert-danger">This function is developing: <br> Sorry for the inconvenience!</h2>
    <input id="deve_cancel" type="reset" value="Cancel" class="btn btn-primary">
</dialog>
<script>
    var dialog_deve = document.querySelector('#develop');
    document.querySelector('.developing').onclick = function() {
        dialog_deve.showModal();
    };
    document.querySelector('#deve_cancel').onclick = function() {
        dialog_deve.close();
    };
</script>
@include('user.layouts.script')
</body>
</html>
