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
                    <div style="font-size: x-large"  id="colorlib-logo"><a href="{{route('home')}}">Caltimes</a></div>
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

    <section id="home" class="video-hero" style="height: 200px; background-image: url({{asset('user/images/cover_img_1.jpg')}});  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
        <div style="height: 250px;" class="display-t display-t2 text-center">
            <div class="display-tc display-tc2">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2 style="font-size: 50px">Login for manage your work!</h2>
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
                            <div class="col-md-3">
                                <input type="submit" value="Sign in" class="btn btn-primary">
                            </div>
                            <div class="col-md-3">
                                <a style="cursor: pointer;" id="forgot-pass">Forgot password?</a>
                            </div>
                            <div class="col-md-3">
                                <!--<a href="{{route('facebook.login')}}">Login with Facebook</a>-->
                                <a style="cursor: pointer;" class = "developing">Login with Facebook</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('register')}}">Register</a>
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
<dialog id="forgot-password-dialog">
    <h3>Forgot password</h3>
    <input id="email-forgot" type="email" class="form-control" required autocomplete="email" placeholder="Your email address">
    <div>
        <span class="alert-warning" role="alert">
            <strong id="noti-forgot-pass"></strong>
        </span>
    </div>
    <br>
    <input id="forgot_ok" type="button" value="Check" class="btn btn-primary">
    <input id="forgot_cancel" type="button" value="Cancel" class="btn btn-primary">
</dialog>
<dialog id="send-email-dialog">
    <form method="post" action="{{route('sendTokenResetPass')}}">
        @csrf()
        <div>
            <span class="alert-warning" role="alert">
                <strong id="noti-send-email"></strong>
            </span>
        </div>
        <input id="email-send" name="email" hidden="hidden">
        <br>
        <input id="send_ok" type="submit" value="Yes, It's me" class="btn btn-primary">
        <input id="send_cancel" type="button" value="No, It's not me" class="btn btn-primary">
    </form>
</dialog>
<script>
    var dialog_deve = document.querySelector('#develop');
    document.querySelector('.developing').onclick = function() {
        dialog_deve.showModal();
    };
    document.querySelector('#deve_cancel').onclick = function() {
        dialog_deve.close();
    };
    var dialog_send = document.querySelector('#send-email-dialog');
    var dialog_forgot = document.querySelector('#forgot-password-dialog');
    document.querySelector('#forgot-pass').onclick = function() {
        document.getElementById('noti-forgot-pass').innerHTML = "";
        dialog_forgot.showModal();
    };
    document.querySelector('#forgot_cancel').onclick = function() {
        dialog_forgot.close();
    };
    $('#forgot_ok').click(function () {
        document.getElementById('noti-forgot-pass').innerHTML = "";
        var email = '';
        email = $('#email-forgot').val();
        if(email === '') {
            document.getElementById('noti-forgot-pass').innerHTML = "Please input your email!";
            return;
        }
        $.ajax({
            url : '{{ route('checkEmail') }}',
            dataType: 'json',
            data:{'email': email},
            success:function(data){
                if(data.success) {
                    document.getElementById('noti-send-email').innerHTML = "We will send an email to " + data.name + " (" + data.email + ") . It's you?";
                    dialog_forgot.close();
                    $('#email-send').attr('value', email);
                    dialog_send.showModal();
                } else {
                    document.getElementById('noti-forgot-pass').innerHTML = "Your email don\'t match any account!";
                }

            }
        });
    });
    $('#send_cancel').click(function () {
        dialog_send.close();
        document.getElementById('noti-forgot-pass').innerHTML = "";
        dialog_forgot.showModal();
    });
</script>
@if(isset($token))
    <dialog id="success">
        <h2 class="alert alert-success">Change password success!</h2>
        <input id="alert_cancel" type="reset" value="Cancel" class="btn btn-primary">
    </dialog>
    <dialog id="failed">
        <h2 class="alert alert-warning">Have an error, sorry for this inconvenience!</h2>
        <input id="alert_cancel1" type="reset" value="Cancel" class="btn btn-primary">
    </dialog>
    <dialog id="reset-pass-token">
        <form method="post" action="#">
            <input id="token1" name="token" value="{{$token}}" hidden="hidden">
            <div class="form-group">
                <p>New password</p>
                <input type="password" name="npass" value="" id="npass" cols="20" rows="1" autocomplete="new-password">
                <div>
                    <span class="invalid-feedback" role="alert">
                        <strong id="noti-npass"></strong>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <p>Re-input password</p>
                <input type="password" name="rpass" value="" id="rpass" cols="20" rows="1" autocomplete="new-password">
                <div>
                    <span class="invalid-feedback" role="alert">
                        <strong id="noti-rpass"></strong>
                    </span>
                </div>
            </div>
            <input id="send_ok1" type="button" value="Submit" class="btn btn-primary">
            <input id="send_cancel1" type="button" value="Cancel" class="btn btn-primary">
        </form>
    </dialog>
    <script>
        var dialog_success = document.getElementById('success');
        $('#alert_cancel').click(function () {
            dialog_success.close();
        });
        var dialog_failed = document.getElementById('failed');
        $('#alert_cancel1').click(function () {
            dialog_failed.close();
        });
        var dialog_reset = document.getElementById('reset-pass-token');
        dialog_reset.showModal();
        $('#send_cancel1').click(function () {
            dialog_reset.close();
        });
        $('#send_ok1').click(function () {
            document.getElementById('noti-npass').innerHTML = "";
            document.getElementById('noti-rpass').innerHTML = "";
            var npass = '';
            npass = $('#npass').val();
            var rpass = '';
            rpass = $('#rpass').val();
            if(npass === '') {
                document.getElementById('noti-npass').innerHTML = "Please input your new password!";
                return;
            } else if(npass.length < 6) {
                document.getElementById('noti-npass').innerHTML = "Password must be at least 6 character!";
                return;
            }
            if(rpass !== npass) {
                document.getElementById('noti-rpass').innerHTML = "Password don\'t match!";
                return;
            }
            var token = '';
            token = $('#token1').val();
            $.ajax({
                url : '{{ route('resetPass') }}',
                dataType: 'json',
                data:{'npass': npass,
                      'token': token},
                success:function(data){
                    dialog_reset.close();
                    if(data.success === true) {
                        dialog_success.showModal();
                    } else {
                        dialog_failed.showModal();
                    }
                }
            });
        });
    </script>
@endif
@include('user.layouts.script')
</body>
</html>
