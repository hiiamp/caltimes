<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.header')
</head>
@include('user.layouts.navbar')
<div class="colorlib-loader" ></div>
<body id="body">
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
                $.pjax.submit(event, '#page');
            });
            // does current browser support PJAX
            if ($.support.pjax) {
                $.pjax.defaults.timeout = 2000; // time in milliseconds
            }
            $(document).on('pjax:complete', function() {
                loadpage();
            })
        });
    </script>
@endif

</html>
