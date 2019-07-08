<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="col-md-4 animate-box">
                <div id="colorlib-logo"><a href="{{route('home')}}">Caltimes</a></div>
            </div>
            <div class="col-md-6 animate-box">
                <ul>
                    <li><a href="{{route('home')}}">My Board</a></li>
                    @auth
                        @if(Auth::user()->level==2)
                            <li><a href="{{route('admin.list')}}">Admin page</a></li>
                        @endif
                        <li class="has-dropdown">
                            <a href="#">{{Auth::user()->name}}</a>
                            <ul class="dropdown">
                                <li><a href="{{route('profile')}}">Profile</a></li>
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
