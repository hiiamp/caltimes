<li data-name="{{$task->name}}" data-index="{{$task->id}}" data-position="{{$task->position}}" data-status="{{$task->todo_list_id}} " class="has-dropdown">
    <p>
        <a style="color: black;" >{{$task->name}}</a>
    </p>
    <span id="ats" class="ats"><span><i class="icon-location-2"></i></span>{{$task->assign->name}}@if($task->assign->id == @Auth::user()->id) (me) @endif</span>
    <p class="badges">
                <span class="js-badges">
    <p class="badge js-due-date-badge is-due-past"
        @if($task->important == 2) style="background-color: #c1c8e4" title="Low Priority"
        @elseif($task->important == 1) style="background-color: #84ceeb" title="Medium Priority"
        @else title="High Priority"
        @endif>
        <span class="badge-icon icon-sm icon-clock"></span>
        <span class="badge-text js-due-date-text">{{$task->created}}</span>
        <span class="badge-text2 js-due-date-text" title="{{$task->assign->name}}" aria-label="{{$task->assign->name}}">{{$task->assign->character}}</span>
    </p>
    </span>
    </p>
</li>
