@foreach($users as $user)
    @if($user->id == 1) @continue
    @endif
    @if($user->level == 3) @continue
    @endif
    <tr>
        <td>
            {{$user->name}}
        </td>
        <td>
            {{$user->email}}
        </td>
        @if(\Illuminate\Support\Facades\Auth::user()->level == 2)
            <td>
                @if($user->level == 2) Admin
                @elseif($user->level == 1) User
                @else Not validate
                @endif
            </td>
        @endif
        <td>
            <a data-pjax href="{{route('admin.list').'?user_id='.$user->id}}" class="btn btn-sm btn-primary"
               style="color: whitesmoke"> List joined </a>
            @if($user->level != 2)
                <a data-index="{{$user->id}}" class="btn btn-sm btn-primary delete_u" style="color: whitesmoke">
                    Delete </a>
            @endif
        </td>
    </tr>
@endforeach
