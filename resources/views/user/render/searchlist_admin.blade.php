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
        <td>
            <a data-pjax href="{{route('admin.user').'?list_id='.$list->id}}" class="btn btn-sm btn-primary" style="color: whitesmoke"> Worker </a>
            @if(Auth::user()->level==2)
                <a data-index="{{$list->id}}" id="Delete{{$list->id}}" class="btn btn-sm btn-primary delete_l" style="color: whitesmoke"> Delete </a>
            @endif
        </td>
    </tr>
@endforeach