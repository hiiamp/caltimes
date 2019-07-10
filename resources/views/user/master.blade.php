<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.header')
</head>
@include('user.layouts.navbar')
<div class="colorlib-loader" ></div>
<body id="body">
<div class="" id="ani_loader">
    <div class="" id="osa_loader"></div>
</div>
<div id="page">
    @yield('content')
</div>
</body>
@include('user.layouts.script')
@include('user.layouts.notification')
@if(Auth::check())
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).pjax('[data-pjax] a, a[data-pjax]', '#page');
            $(document).on('submit', 'form[data-pjax]', function(event) {
                $('#ani_loader').addClass('animationload');
                $('#osa_loader').addClass('osahanloading');
                $.pjax.submit(event, '#page');
            });
            // does current browser support PJAX
            if ($.support.pjax) {
                $.pjax.defaults.timeout = 3000; // time in milliseconds
                $(document).on('click', '[data-pjax] a, a[data-pjax]', function(event) {
                    $('#ani_loader').addClass('animationload');
                    $('#osa_loader').addClass('osahanloading');
                });
            }
            $(document).on('pjax:complete', function() {
                $('#ani_loader').removeClass('animationload');
                $('#osa_loader').removeClass('osahanloading');
                loadpage();
            })
        });
    </script>
@endif

</html>
