<div class="container container1" style="padding-top: 15%">
    <div class="colorlib-featured ">
        <div class="row animate-box">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h2 style="color: whitesmoke" class="mb-0">All people you are working with:</h2>
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