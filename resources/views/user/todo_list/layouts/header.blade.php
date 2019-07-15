@if($own == true)
    <nav style="z-index:101; top: 150px;position: fixed" class="menu menu11">
        <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open"/>
        <label class="menu-open-button" for="menu-open">
            <span class="hamburger hamburger-1"></span>
            <span class="hamburger hamburger-2"></span>
            <span class="hamburger hamburger-3"></span>
        </label>
        <a title="Back" data-pjax href="{{route('home')}}" class="menu-item"> <i class="fa fa-share"></i> </a>
        <a title="Delete" id="delete_list"class="menu-item"> <i class="icon-trash2"></i> </a>
        @if($list->is_public == 0)
            <a title="Change to public" data-pjax href="{{route('private.list').'?list_id='.$list->id}}" class="menu-item"> <i class="icon-tools"></i> </a>
        @else
            <a title="Change to private" data-pjax href="{{route('private.list').'?list_id='.$list->id}}" class="menu-item"> <i class="icon-tools"></i> </a>
        @endif
        <a title="Share with" class="menu-item sharewith"> <i class="icon-share3"></i></a>
        <a title="Worker joined" class="menu-item worker_joined"> <i class="icon-user2"></i></a>
    </nav>
@else
    <nav style="z-index:101; top: 150px;position: fixed" class="menu menu11">
        <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open"/>
        <label class="menu-open-button" for="menu-open">
            <span class="hamburger hamburger-1"></span>
            <span class="hamburger hamburger-2"></span>
            <span class="hamburger hamburger-3"></span>
        </label>
        <a title="Back" data-pjax href="{{route('home')}}"  class="menu-item"> <i class="fa fa-share"></i> </a>
        <a style="color: red; pointer-events: none;" title="Delete" id="delete_list"class="menu-item"> <i class="icon-trash2"></i> </a>
        @if($list->is_public == 0)
            <a style="color: red; pointer-events: none;" title="Change to public" data-pjax class="menu-item"> <i class="icon-tools"></i> </a>
        @else
            <a style="color: red; pointer-events: none;" title="Change to private" data-pjax class="menu-item"> <i class="icon-tools"></i> </a>
        @endif
        <a style="color: red; pointer-events: none;" title="Share with" class="menu-item sharewith"> <i class="icon-share3"></i></a>
        <a title="Worker joined" class="menu-item worker_joined"> <i class="icon-user2"></i></a>
    </nav>
@endif
<section id="home" class="video-hero" style="position: fixed; width: 100%; height: 200px; background-image: url({{asset('user/images/cover_img_1.jpg')}});  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
    <div style="height: 200px;" class="overlay"></div>
    <div style="height: 300px;" class="display-t display-t2 text-center">
        <div class="display-tc display-tc2">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div style="line-height: 0;" class="animate-box">
                        <p>{{$list->name}}</p>
                        <h4>Create by: {{$username}}</h4>
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
                <input id="myfavourite" type="reset" value="My Favourite Co-Worker" class="btn btn-primary">
            </div>
        </form>
    </dialog>

    <dialog id="deletelistdialog">
        <form method="post" action="{{route('recycle.list')}}">
            @csrf
            <div class="row form-group">
                <div class="col-md-12">
                    <p>You really wanna move this list to your recycle?</p>
                    <input id="todo_list_id" type="hidden" class="form-control" name="todo_list_id" value="{{$list->id}}">
                </div>
            </div>
            <div class="form-group">
                <input id="delete_submit" type="submit" value="Yes, I'm sure." class="btn btn-primary">
                <input id="delete_cancel" type="reset" value="Cancel" class="btn btn-primary">
            </div>
            </form>
    </dialog>
    <dialog id="activities">
        <form method="" action="">
            @csrf
            <table id="customers">
                @if(\Illuminate\Support\Facades\Auth::Check())
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Acticities</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(auth()->user()->unreadNotifications->count())
                        @foreach(auth()->user()->unreadNotifications as $notification)
                        <tr>
                            <td>
                                {{$notification->data['user']['name']}} {{$notification->data['act']}} a task "{{$notification->data['task']['name']}}" on list "{{$notification->data['list']['name']}}" at {{$notification->data['task']['created_at']}}
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                @endif
            </table>
            <input id="noti_cancel" type="reset" value="Cancel" class="btn btn-primary">
        </form>
    </dialog>
    @if(session('message1'))
        <script>
            var dialog_share = document.querySelector('#sharewithdialog');
            dialog_share.showModal();
        </script>
    @endif
    <dialog id="dialogjoined">
        <div class="">
            <table id="customers">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Number of Tasks</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($list_users as $u)
                        <tr>
                            <td>
                                {{$u->name}}@if($u->id == @Auth::user()->id) (me) @endif
                            </td>
                            <td>
                                {{$u->email}}
                            </td>
                            <td>
                                {{$u->countTask}}
                            </td>
                            <td>
                                @if(Auth::check())
                                <form>
                                    @if($u->id == Auth::user()->id)
                                        @if($own == true)
                                            <a href="{{route('profile')}}" class="btn btn-sm btn-primary" style="color: white"> My Profile </a>
                                            <input id="outlist" hidden="hidden" disabled>
                                        @else
                                            <input id="outlist" data-wk="yes" style="color: #ffffff" type="reset" class="btn btn-sm btn-primary" data-id="{{$u->id}}" value="Leave this list?">
                                        @endif
                                    @else
                                        @if($u->isCo != 0)
                                            <input data-wk="yes" type="reset" class="listwk btn btn-sm btn-primary" data-id="{{$u->id}}" value="Remove favourite">
                                        @else
                                            <input data-wk="no" type="reset" class="listwk btn btn-sm btn-primary" data-id="{{$u->id}}" value="Add favourite">
                                        @endif
                                        @if($own == true)
                                            <input data-wk="yes" type="reset" class="sharewk btn btn-sm btn-primary" data-id="{{$u->id}}" list-id="{{$list->id}}" value="Kick Out?">
                                        @else
                                            <input class="sharewk" hidden="hidden" disabled>
                                        @endif
                                    @endif
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button id="joinedcancel" class="btn btn-sm btn-primary">Cancel</button>
        </div>
    </dialog>

    <!-- notification dialog -->
    <dialog id="out_list_dialog">
        <form method="post" action="{{route('out.list')}}">
            @csrf
            <div class="row form-group">
                <div class="col-md-12">
                    <p>You really want to out this list?</p>
                    <input type="hidden" class="form-control" name="todo_list_id" value="{{$list->id}}">
                </div>
            </div>
            <div class="form-group">
                <input id="delete_access_submit" type="submit" value="Yes, I'm sure." class="btn btn-primary">
                <input id="delete_access_cancel" type="reset" value="Cancel" class="btn btn-primary">
            </div>
        </form>
    </dialog>

    <!-- favourite coworker share dialog -->
    @if(Auth::check())
    <dialog id="myfavourite_dialog">
        <div class="">
            <table id="customers">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>
                <tbody>
                @foreach($favourites as $u)
                    <tr>
                        <td>
                            {{$u->name}}
                        </td>
                        <td>
                            {{$u->email}}
                        </td>
                        <td>
                            <form>
                                @if($u->shared == 0)
                                    <input data-fv="no" type="reset" class="sharefv btn btn-sm btn-primary" data-id="{{$u->id}}" list-id="{{$list->id}}" value="Share this list">
                                @else
                                    <input data-fv="yes" type="reset" class="sharefv btn btn-sm btn-primary" data-id="{{$u->id}}" list-id="{{$list->id}}" value="UnShare">
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button id="fvdialogcancel" class="btn btn-sm btn-primary">Cancel</button>
        </div>
    </dialog>
    @endif
</section>
<dialog id="activiesdialog">
    <h2 class="alert alert-warning" style="color: red">This function is developing</h2>
    <input id="acti_cancel" type="reset" value="Cancel" class="btn btn-primary">
</dialog>
