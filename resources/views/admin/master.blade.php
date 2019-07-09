<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.header')
</head>
<body>
<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{route('home')}}">
            <h1>CALTIMES</h1>
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="#">
                            <img src="{{asset('admin/img/brand/blue.png')}}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item" id="nav-list">
                    <a data-pjax class="nav-link" href="{{route('admin.list')}}">
                        <i class="ni ni-bullet-list-67 text-red"></i> List management
                    </a>
                </li>
                <li class="nav-item" id="nav-user">
                    <a data-pjax class="nav-link" href="{{route('admin.user')}}">
                        <i class="ni ni-circle-08 text-pink"></i> User management
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content">

    @include('admin.layouts.navbar')
    <div id="page">
        @yield('content')
    </div>
</div>
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
        });
    </script>
@endif

</body>
</html>
