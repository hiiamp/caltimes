<section id="home" class="video-hero"
         style="position: fixed; width: 100%; height: 200px; background-image: url({{asset('user/images/cover_img_1.jpg')}});  background-size:cover; background-position: center center;background-attachment:fixed;"
         data-section="home">
    <div style="height: 200px;" class="overlay"></div>
    <div style="height: 250px;" class="display-t display-t2 text-center">
        <div class="display-tc display-tc2">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <p>Activities</p>
                        <button class="btn btn-sm btn-primary"><a data-pjax style="color: white"
                                                                  href="{{route('maskRead')}}">Mask all as read</a>
                        </button>
                        <button class="btn btn-sm btn-primary"><a data-pjax style="color: white"
                                                                  href="{{route('delete_noti')}}">Delete all</a>
                        </button>
                        <p class="breadcrumbs" style="font-size: large">
                        </p>
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