<section id="home" class="video-hero" style="width: 100%; position: fixed; height: 200px; background-image: url({{asset('user/images/cover_img_1.jpg')}});  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">    <div class="overlay"></div>
    <!--<a class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=vqqt5p0q-eU',containment:'#home', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, quality:'default'}"></a>-->
    <div style="height: 350px; " class="display-t text-center distance-to-top">
        <div class="display-tc">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <p id="titlehome">Take on your biggest projects and goals</p>
                        <p id="create-board"><a class="btn btn-primary btn-lg btn-custom">Create new board</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<dialog id="addlist">
    <form data-pjax  method="post" action="{{'create_list'}}">
        @csrf
        <div class="row form-group">
            <div class="col-md-12">
                <p>Setup your board</p>
                @if(session('name_exist'))
                    <span class="alert alert-warning help-block">
                        <strong>This name already exist!</strong>
                    </span>
                @endif
                <input id="name" type="name" class="form-control" name="name" required autofocus value="{{session('name')}}" placeholder="Your board title">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    </div>
                    <select class="btn" name="is_public" class="custom-select" id="is_public">
                        <option value="1">Public</option>
                        <option value="0">Private</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input id="save" type="submit" value="Create" class="btn btn-primary">
            <input id="cancel" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>
@if(session('deleted_list'))

    <dialog id="delete_dialog">
            <span class="alert alert-warning help-block">
                <strong>{{session('deleted_list')}}</strong>
            </span>
        <input id="cancel1" type="reset" value="Ok" class="btn btn-primary">
    </dialog>
    <script>
        var dialog2 = document.querySelector('#delete_dialog');
            dialog2.showModal();
            document.querySelector('#cancel1').onclick = function() {
                dialog2.close();
            };
    </script>
@endif

@if(session('name_exist'))
    <script>
        var dialog1 = document.querySelector('#addlist');
            dialog1.showModal();
    </script>
@endif

<script>
    var dialog = document.querySelector('#addlist');
    document.querySelector('#create-board').onclick = function() {
        dialog.showModal();
    };
    document.querySelector('#save').onclick = function() {
        dialog.close();
    };
    document.querySelector('#cancel').onclick = function() {
        dialog.close();
    };
    $(window).scroll(function (event) {
        try {
            var distance = $('#addlist').offset().top;
            var opacity = (250-distance)/250;
            $('#titlehome').css('opacity', opacity);
        } catch (e) {

        }
    });
</script>

