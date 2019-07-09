<div class="colorlib-blog">
    <div class="container" style="margin-top: 100px">
        @if(\Illuminate\Support\Facades\Auth::Check())
            @if(auth()->user()->unreadNotifications->count())
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <div class="row mobile-wrap">
                            <div class="desc">
                                <div class="features">
                                    <a data-pjax href="{{route('link.board',['code'=>$notification->data['list']['link']])}}" style="color: dodgerblue" class="icon"><i class="icon-lightbulb"></i><span>   {{$notification->data['list']['link']}}</span></a>
                                    <div class="f-desc">
                                        <h3 style="color: grey">
                                            @if($notification->data['act'] == "share")
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} a list "{{$notification->data['list']['name']}}" at {{$notification->data['list']['created_at']}}
                                            @elseif($notification->data['act'] == "change")
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} status of a list at {{$notification->data['list']['created_at']}}
                                            @elseif($notification->data['act'] == "delete a list")
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} "{{$notification->data['list']['name']}}" at {{$notification->data['list']['created_at']}}
                                            @else
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} a task "{{$notification->data['task']['name']}}" on list "{{$notification->data['list']['name']}}" at {{$notification->data['task']['created_at']}}
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>