<section id="home" class="video-hero" style="height: 400px; background-image: url({{asset('user/images/cover_img_1.jpg')}});  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
    <div class="overlay"></div>
    <div class="display-t display-t2 text-center">
        <div class="display-tc display-tc2">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <h2>{{$list->name}}</h2>
                        <h3>Create by: {{$username}}</h3>
                        @if($own == true)
                            @if($list->is_public == 1)
                                <h4>Your list is Public</h4>
                            @else
                                <h4>Your list is Private</h4>
                            @endif
                            <p class="breadcrumbs" style="font-size: large">
                                    <span><a class="sharewith">Share with</a></span>
                                @if($list->is_public == 0)
                                    <span><a href="{{route('private.list').'?list_id='.$list->id}}">Change to Public</a></span>
                                @else
                                    <span><a href="{{route('public.list').'?list_id='.$list->id}}">Change to Private</a></span>
                                @endif
                                <span><a id="delete_list">Delete</a></span>
                            </p>
                        @else
                            <span><a hidden="hidden" class="sharewith">Share with</a></span>
                            <span><a hidden="hidden" id="delete_list">Delete</a></span>
                            @if($list->is_public == 1)
                                <h4>This list is Public</h4>
                            @else
                                <h4>This list is Private</h4>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="sharewithdialog">
        <form method="post" action="{{route('share.list')}}">
            @csrf
            <div class="row form-group">
                <div class="col-md-12">
                    <p>Input email of user that you want to share</p>
                    @if(session('message1'))
                        <span class="alert alert-warning help-block">
                        <strong>{{session('message1')}}</strong>
                    </span>
                    @endif
                    <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Email you want to share">
                    <input id="todo_list_id" type="hidden" class="form-control" name="todo_list_id" value="{{$list->id}}">
                </div>
            </div>
            <div class="form-group">
                <input id="share" type="submit" value="Share" class="btn btn-primary">
                <input id="cancelshare" type="reset" value="Cancel" class="btn btn-primary">
            </div>
        </form>
    </dialog>

    <dialog id="deletelistdialog">
            <form method="post" action="{{route('delete.list')}}">
                @csrf
                <div class="row form-group">
                    <div class="col-md-12">
                        <p>You really want to delete this list?</p>
                        <input id="todo_list_id" type="hidden" class="form-control" name="todo_list_id" value="{{$list->id}}">
                    </div>
                </div>
                <div class="form-group">
                    <input id="delete_submit" type="submit" value="Yes, I'm sure." class="btn btn-primary">
                    <input id="delete_cancel" type="reset" value="Cancel" class="btn btn-primary">
                </div>
            </form>
        </dialog>
    @if(session('message1'))
        <script>
            var dialog_share = document.querySelector('#sharewithdialog');
            dialog_share.showModal();
        </script>
    @endif

</section>
