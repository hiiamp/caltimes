<div class="colorlib-featured">
    <div class="row animate-box">
        <div class="featured-wrap">
            <div class="owl-carousel">
                <div class="item">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="featured-entry">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header border-0">
                                            <h2 class="mb-0">My board</h2>
                                        </div>
                                        <div class="">
                                            <table id="customers">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Create at</th>
                                                    <th scope="col">Owner</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($lists as $list)
                                                    <tr>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary" href="{{route('link.board',['code'=>$list->link])}}">{{$list->link}}</a>
                                                        </td>
                                                        <td>
                                                            {{$list->name}}
                                                        </td>
                                                        <td>
                                                            {{$list->created_at}}
                                                        </td>
                                                        <td>
                                                            {{$list->owner}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <ul class="pagination">
                                                    {{$lists->links()}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="featured-entry">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header border-0">
                                            <h2 class="mb-0">Co-worker</h2>
                                        </div>
                                        <div class="">
                                            <table id="customers">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">On list</th>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->level == 2)
                                                        <th scope="col">Level</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>
                                                            {{$user->name}}
                                                        </td>
                                                        <td>
                                                            {{$user->email}}
                                                        </td>
                                                        <td>
                                                            {{$user->list_name}}
                                                        </td>
                                                        @if(\Illuminate\Support\Facades\Auth::user()->level== 2)
                                                            <td>
                                                                @if($user->level == 2) Admin
                                                                @elseif($user->level == 1) User
                                                                @else Not validate
                                                                @endif
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <ul class="pagination">
                                                    {{$users->links()}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="featured-entry">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header border-0">
                                            <h2 class="mb-0">My account</h2>
                                        </div>
                                        <div id="colorlib-contact">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-4 col-md-push-8 animate-box">
                                                        <h2>About</h2>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="contact-info-wrap-flex">
                                                                    <div class="con-info">
                                                                        <p><span><i class="icon-location-2"></i></span> Email <br> {{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                                                                    </div>
                                                                    <div class="con-info">
                                                                        <p><span><i class="icon-globe"></i></span> Date join <br> {{\Illuminate\Support\Facades\Auth::user()->created_at}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-pull-4 animate-box">
                                                        <h2>{{\Illuminate\Support\Facades\Auth::user()->name}}</h2>
                                                        <form method="post" action="">
                                                            <div class="col-md-12">
                                                                <p>Title</p>
                                                                <input hidden="hidden" name="name" id="" cols="30" rows="1" class="hidden_dis" value="" >
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-4">
                                                                    <input type="submit" value="Save" class="btn btn-primary">
                                                                    <input type="submit" value="Cancel" class="btn btn-primary">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
