<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.header')
</head>
@include('user.layouts.navbar')
<div class="colorlib-loader" ></div>
<body id="body">
<ul class="drops blue" id="spinner-li">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>
<div id="page">
    @yield('content')
</div>
<dialog id="how_donate_dialog">
    <span class="alert alert-info help-block" style="min-width: 700px">
        <strong>
            Come to @if(Auth::user()->isVip) my donate page: @else tranfer money page and give me >= 100.000 VND / 5USD @endif  <br>
            <a target="_blank" href="https://unghotoi.com/1563348843jqrl4">@if(Auth::user()->isVip) Donate @else Tranfer money @endif page</a><br>
            And notificate us on email: phi.td@neo-lab.vn / 0354856546
        </strong>
    </span>
    <span style="padding-left: 10%">
        <img src="{{asset('user/images/donate.png')}}">
    </span>
    <br>
    <span style="padding-right: 10%">
        <input id="cancel19" type="reset" value="Cancel" class="btn btn-primary">
    </span>
</dialog>
</body>
@include('user.layouts.script')
<script>
    $('#cancel19').click(function () {
        document.getElementById('how_donate_dialog').close();
    });
    $('#page').css('height',$(window).height());
    //auto turn off dialog
    document.addEventListener('click', function (e)
    {
        $('dialog').each(function () {
            var id = $(this).attr('id');
            if($(this).is(e.target)) {
                document.getElementById(id).close();
            } else {
                //console.log($(this));
            }
        });
    }, true);
    ///
</script>
@if(Auth::check())
    <script type="text/javascript">
        $(document).ready(function(){
            $('#spinner-li').hide();
            $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
            $(document).on('submit', 'form[data-pjax]', function(event) {
                $('#spinner-li').show();
                $.pjax.submit(event, '#page');
            });
            // does current browser support PJAX
            if ($.support.pjax) {
                $.pjax.defaults.timeout = 3000; // time in milliseconds
                $(document).on('click', '[data-pjax] a, a[data-pjax]', function(event) {
                    $('#spinner-li').show();
                });
            }
            $(document).on('pjax:complete', function() {
                $('#spinner-li').hide();
                loadpage();
            })
        });
    </script>
@endif
</html>
