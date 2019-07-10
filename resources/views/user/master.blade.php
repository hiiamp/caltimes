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
</body>
@include('user.layouts.script')
@include('user.layouts.notification')
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
