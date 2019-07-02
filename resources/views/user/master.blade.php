<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.header')
</head>

<body>
<div class="colorlib-loader"></div>

<div id="page">
@include('user.layouts.navbar')

@yield('content')
</div>

@include('user.layouts.script')
@include('user.layouts.notification')
</body>
</html>
