<nav style="z-index:101; top: 150px;position: fixed" class="menu menu11">
    <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open"/>
    <label class="menu-open-button" for="menu-open">
        <span class="hamburger hamburger-1"></span>
        <span class="hamburger hamburger-2"></span>
        <span class="hamburger hamburger-3"></span>
    </label>
    <a title="Back" data-pjax href="{{route('home')}}" class="menu-item"> <i class="fa fa-share"></i> </a>
    <a data-pjax title="Recycle" id="delete_list"class="menu-item" href="{{route('recycle')}}"> <i class="icon-trash2"></i> </a>
    <a data-pjax title="Favorite co-worker" id="delete_list"class="menu-item" href="{{route('favorite')}}"> <i class="icon-heart"></i> </a>
    <a data-pjax title="All co-worker" class="menu-item sharewith" href="{{route('worker')}}"> <i class="icon-share3"></i></a>
    <a data-pjax title="My profile" class="menu-item worker_joined" href="{{route('profile')}}"> <i class="icon-user2"></i></a>
</nav>
<section id="home" class="video-hero" style="position: fixed; width: 100%;  height: 200px; background-image: url({{asset('user/images/cover_img_1.jpg')}});  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
    <div style="height: 200px;" class="overlay"></div>
    <div style="height: 300px;" class="display-t display-t2 text-center">
        <div class="display-tc display-tc2">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <p>Profile</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#search').hide();
        $('#searchTask').hide();
    });
</script>