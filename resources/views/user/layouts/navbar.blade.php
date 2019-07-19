<nav class="colorlib-nav" role="navigation" style="position: fixed" id="app">
    <div class="top-menu">
        <div class="container">
            <div class="col-md-2 animate-box">
                <div style="font-size: x-large" id="colorlib-logo"><a data-pjax href="{{route('home')}}">Caltimes</a>
                </div>
            </div>
            <div class="col-md-8 animate-box">
                <ul style="text-align: center">
                    <li style="font-size: medium"><a data-pjax href="{{route('home')}}">My Board</a></li>
                    @auth
                        @if(Auth::check())
                            @if(Auth::user()->level==2)
                                <li style="font-size: medium"><a href="{{route('admin.list')}}">Admin page</a></li>
                            @else
                                <li style="font-size: medium"><a id="donate_1">@if(Auth::user()->isVip) Donate @else
                                            Upgrade me @endif</a></li>
                                <script>
                                    $('#donate_1').click(function () {
                                        document.getElementById('how_donate_dialog').showModal();
                                    });
                                </script>
                            @endif
                        <!--<task v-bind:tasks="tasks"></task>-->
                            <li style="font-size: medium"><a data-pjax href="{{route('notification')}}">Activity</a>
                            </li>
                            <li class="has-dropdown" style="font-size: medium">
                                <a>{{Auth::user()->name}} @if(Auth::user()->isVip) <img
                                            src="{{asset('user/images/ic_VIP_new.png')}}"> @endif </a>
                                <ul class="dropdown">
                                    <li><a data-pjax href="{{route('profile')}}">Profile</a></li>
                                    <li><a href="{{route('logout')}}">Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
            <div class="col-md-2 animate-box">
                <form class="form-inline qbstp-header-subscribe">
                    <div class="col-three-forth">
                        <div class="form-group">
                            <input id="search" style="text-align: left" name="search" type="text" class="btn"
                                   placeholder=" Enter name's list you want to find">
                            <input id="searchTask" style="text-align: left" name="searchTask" type="text" class="btn"
                                   placeholder=" Enter name's task you want to find">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
