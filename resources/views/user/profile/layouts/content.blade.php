<div class="container" style="padding-top: 15%">
    <div id="colorlib-blog"  style="background-color: #5fa9d0;border-radius: 15px">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-push-8 animate-box ">
                    <h2>Change password</h2>
                    <div>
                        <span class="invalid-feedback" role="alert">
                            <strong id="noti-cpass" style="color: #0c85d0"></strong>
                        </span>
                    </div>
                    <form data-pjax method="get" action="#">
                        <div class="form-group">
                            <p style="color: black;">Current password</p>
                            <input type="password" name="opass" value="" id="opass" cols="20" rows="1" autocomplete="current-password">
                            <div>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="noti-opass"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <p style="color: black;">New password</p>
                            <input type="password" name="npass" value="" id="npass" cols="20" rows="1" autocomplete="new-password">
                            <div>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="noti-npass"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <p  style="color: black;">Re-input password</p>
                            <input type="password" name="rpass" value="" id="rpass" cols="20" rows="1" autocomplete="new-password">
                            <div>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="noti-rpass"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <input type="button" id="submit-cpass" value="Save" class="btn btn-primary">
                                <input type="reset" id="reset-cpass" value="Reset" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 col-md-pull-8 animate-box">
                    <h2>About</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-info-wrap-flex">
                                <div class="con-info">
                                    <p><span><i class="icon-user2"></i></span> Username <br> {{Auth::user()->name}}</p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-location-2"></i></span> Email <br> {{Auth::user()->email}}</p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-globe"></i></span> Date join <br> {{Auth::user()->created_at}}</p>
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
    $('#submit-cpass').click(function () {
        document.getElementById('noti-opass').innerHTML = "";
        document.getElementById('noti-npass').innerHTML = "";
        document.getElementById('noti-rpass').innerHTML = "";
        document.getElementById('noti-cpass').innerHTML = "";
        var opass = '';
        opass = $('#opass').val();
        var npass = '';
        npass = $('#npass').val();
        var rpass = '';
        rpass = $('#rpass').val();
        if(opass === '') {
            document.getElementById('noti-opass').innerHTML = "Please input your old password!";
            return;
        }
        if(npass === '') {
            document.getElementById('noti-npass').innerHTML = "Please input your new password!";
            return;
        } else if(npass.length < 6) {
            document.getElementById('noti-npass').innerHTML = "Password must be at least 6 character!";
            return;
        }
        if(npass === opass) {
            ocument.getElementById('noti-npass').innerHTML = "Your old and new password match?";
        }
        if(rpass !== npass) {
            document.getElementById('noti-rpass').innerHTML = "Password don\'t match!";
            return;
        }
        $.ajax({
            url : '{{ route('changePassword') }}',
            dataType: 'json',
            data:{'opass': opass,
                  'npass': npass},
            success:function(data){
                if(data.success === true) {
                    document.getElementById('noti-cpass').innerHTML = "Changed password success!";
                } else {
                    document.getElementById('noti-opass').innerHTML = "Wrong password!";
                }
            }
        });
    });
</script>
