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
                                                        <form data-pjax method="get" action="#">
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
                <div class="item">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="featured-entry">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header border-0">
                                            <h2 class="mb-0">Favourite Co-Worker</h2>
                                        </div>
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
                                                            <input data-wk="yes" type="reset" class="listfv btn btn-sm btn-primary" data-id="{{$u->id}}" value="Remove favourite">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div data-pjax class="col-md-12 text-center">
                                                <ul class="pagination">

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
                                            <h2 class="mb-0">All people you are working with:</h2>
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
                                                            <a data-pjax class="btn btn-sm btn-primary" href="{{route('link.board',['code'=>$user->list_code])}}">{{$user->list_name}}</a>
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
                                            <div data-pjax class="col-md-12 text-center">
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
                                            <h2 class="mb-0">Recycle:</h2>
                                        </div>
                                        <div class="">
                                            <table id="customers">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Number of tasks</th>
                                                    <th scope="col">Created at</th>
                                                    <th scope="col">Option</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($recycleList as $list)
                                                    <tr>
                                                        <td>
                                                            {{$list->name}}
                                                        </td>
                                                        <td>
                                                            {{$list->numtask}}
                                                        </td>
                                                        <td>
                                                            {{$list->created_at}}
                                                        </td>
                                                        <td>
                                                            <a data-pjax class="btn btn-sm btn-primary" href="{{route('list.recover',['code'=>$list->link])}}">Recover List</a>
                                                            <a data-pjax data-index="{{$list->id}}" id="Delete{{$list->id}}" class="btn btn-sm btn-primary delete_l" style="color: whitesmoke"> Delete </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div data-pjax class="col-md-12 text-center">
                                                <ul class="pagination">
                                                    <!--{{$users->links()}}-->
                                                </ul>
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
<script>
    $('.listfv').each(function () {
        $(this).click(function () {
            var user_co_id = $(this).attr('data-id');
            var check = true;
            if($(this).attr('data-wk') === 'no') check = false;
            if(check){
                $(this).attr('data-wk', 'no');
                $(this).attr('value', 'Add favorite');
            } else {
                $(this).attr('data-wk', 'yes');
                $(this).attr('value', 'Remove favorite');
            }
            $.ajax({
                url : '{{ route('toggleCoWorker') }}',
                dataType: 'json',
                data:{'user_co_id': user_co_id},
                success:function(data){

                }
            });
        });
    });
</script>
<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items:1,
        loop:true,
        autoplay:false,
        autoplayTimeout:1000,
        autoplayHoverPause:true
    });
    owl.trigger('stop.owl.autoplay');
</script>

<dialog id="deletelistdialog1">
    <form data-pjax method="post" action="{{route('delete.list')}}">
        @csrf
        <div class="row form-group">
            <div class="col-md-12">
                <p>You really want to delete this list?</p>
                <input id="todo_list_id_delete" type="hidden" class="form-control" name="todo_list_id" value="">
                <input name="checkadmin" value="true" hidden="hidden">
            </div>
        </div>
        <div class="form-group">
            <input id="delete_submit1" type="submit" value="Yes, I'm sure." class="btn btn-primary">
            <input id="delete_cancel1" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>

<script>
    $(function(){
        var dialog_delete = document.querySelector('#deletelistdialog1');
        dialog_delete.close();
        $(".delete_l").each(function (index) {
            $(this).click(function () {
                dialog_delete.showModal();
                var list_id = $(this).attr('data-index');
                $('#todo_list_id_delete').attr('value', list_id);
            });
        });
        document.querySelector('#delete_submit1').onclick = function () {
            dialog_delete.close();
        };
        document.querySelector('#delete_cancel1').onclick = function () {
            dialog_delete.close();
        };
    });
</script>
