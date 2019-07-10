<nav class="colorlib-nav" role="navigation" style="position: fixed" id="app">
<script type="text/ecmascript">
    window.Laravel = JSON.parse('<?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>');
</script>
@if(Auth::check())
    <script>
        window.Laravel.userId = '<?php echo auth()->user()->id; ?>'
        window.Laravel.userName = '<?php echo auth()->user()->name; ?>'
    </script>
@endif
    <div class="top-menu">
        <div class="container">
            <div class="col-md-4 animate-box">
                <div id="colorlib-logo"><a data-pjax href="{{route('home')}}">Caltimes</a></div>
            </div>
            <div class="col-md-6 animate-box">
                <ul>
                    <li><a data-pjax href="{{route('home')}}">My Board</a></li>
                    @auth
                        @if(Auth::check())
                            @if(Auth::user()->level==2)
                                <li><a href="{{route('admin.list')}}">Admin page</a></li>
                            @endif
                            <!--<task v-bind:tasks="tasks"></task>-->
                                <li><a data-pjax href="{{route('notification')}}">Activity</a></li>
                        @endif
                        <li class="has-dropdown">
                            <a href="#">{{Auth::user()->name}}</a>
                            <ul class="dropdown">
                                <li><a data-pjax href="{{route('profile')}}">Profile</a></li>
                                <li><a href="{{route('logout')}}">Logout</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
            <div class="col-md-2 animate-box">
                <form class="form-inline qbstp-header-subscribe">
                    <div class="col-three-forth">
                        <div class="form-group">
                            <input id="search" style="text-align: left" name="search" type="text" class="btn" placeholder=" Enter what you want to find">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
