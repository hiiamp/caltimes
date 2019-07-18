<div class="colorlib-blog" style="padding-top: 150px;">
    <div class="container" style="margin-top: 100px">
        @if(\Illuminate\Support\Facades\Auth::Check())
            <div class="row mobile-wrap">
                <div class="desc">
                    <div class="features">
                        <div class="f-desc">
                            @if(auth()->user()->notifications->count())
                                @foreach(auth()->user()->notifications()->limit(15)->get() as $notification)
                                    @if($notification->read_at == '')
                                        <h3 style="color: grey; padding: 10px; border: 1px solid green; background-color: lightskyblue">
                                            <a id="noti" data-pjax href="{{route('link.board',['code'=>$notification->data['list']['link']]).'?noti='.$notification->id}}" style="color: grey" class="icon"><i class="icon-lightbulb"></i>
                                                @if($notification->data['act'] == "share")
                                                    {{$notification->data['user']['name']}} {{$notification->data['act']}} a list "{{$notification->data['list']['name']}}" at {{$notification->data['list']['created_at']}}
                                                @elseif($notification->data['act'] == "change")
                                                    {{$notification->data['user']['name']}} {{$notification->data['act']}} status of a list at {{$notification->data['list']['created_at']}}
                                                @elseif($notification->data['act'] == "move a list")
                                                    {{$notification->data['user']['name']}} {{$notification->data['act']}} "{{$notification->data['list']['name']}}" at {{$notification->data['list']['created_at']}}
                                                @elseif($notification->data['act'] == "recover a list")
                                                    {{$notification->data['user']['name']}} {{$notification->data['act']}} "{{$notification->data['list']['name']}}" at {{$notification->data['list']['created_at']}}
                                                @else
                                                    {{$notification->data['user']['name']}} {{$notification->data['act']}} a task "{{$notification->data['task']['name']}}" on list "{{$notification->data['list']['name']}}" at {{$notification->data['task']['created_at']}}
                                                @endif
                                            </a>
                                        </h3>
                                    @else
                                    <h3 style="color: grey; padding: 10px; border: 1px solid green; background-color: lightcyan">
                                        <a data-pjax href="{{route('link.board',['code'=>$notification->data['list']['link']])}}" style="color: grey" class="icon"><i class="icon-lightbulb"></i>
                                            @if($notification->data['act'] == "share")
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} a list "{{$notification->data['list']['name']}}" at {{$notification->data['list']['created_at']}}
                                            @elseif($notification->data['act'] == "change")
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} status of a list at {{$notification->data['list']['created_at']}}
                                            @elseif($notification->data['act'] == "move a list")
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} "{{$notification->data['list']['name']}}" at {{$notification->data['list']['created_at']}}
                                            @elseif($notification->data['act'] == "recover a list")
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} "{{$notification->data['list']['name']}}" at {{$notification->data['list']['created_at']}}
                                            @else
                                                {{$notification->data['user']['name']}} {{$notification->data['act']}} a task "{{$notification->data['task']['name']}}" on list "{{$notification->data['list']['name']}}" at {{$notification->data['task']['created_at']}}
                                            @endif
                                        </a>
                                    </h3>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
