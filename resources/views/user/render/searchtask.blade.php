<div class="col-md-4 " id="todolist">
    <article class="model">
        <h2 class="art-h2">To do</h2>
        <ul id="sortable1" type="status1" class="connectedSortable detail-task1">
            @foreach($tasks as $task)
                @if($task->status_id==1)
                    <li data-index="{{$task->id}}" data-position="{{$task->position}}" data-status="{{$task->todo_list_id}} " class="has-dropdown">
                        <p>
                            <a style="color: black;" >{{$task->name}}</a>
                        </p>
                        <span id="ats" class="ats"><span><i class="icon-location-2"></i></span>{{$task->assign->name}}@if($task->assign->id == @Auth::user()->id) (me) @endif</span>
                        <p class="badges">
                                        <span class="js-badges">
                        <p id="priority1{{$task->id}}" class="badge js-due-date-badge is-due-past"
                           @if($task->important == 2) style="background-color: #c1c8e4" title="Low Priority"
                           @elseif($task->important == 1) style="background-color: #84ceeb" title="Medium Priority"
                           @else title="High Priority"
                                @endif>
                            <span class="badge-icon icon-sm icon-clock"></span>
                            <span class="badge-text js-due-date-text">{{$task->created_at}}</span>
                            <span class="badge-text2 js-due-date-text" title="{{$task->assign->name}}" aria-label="{{$task->assign->name}}">{{$task->assign->character}}</span>
                        </p>
                        </span>
                        </p>
                    </li>
                @endif
            @endforeach
        </ul>
        @if(\Illuminate\Support\Facades\Auth::check())
            <button id="add-task" type="submit" class="btn btn-primary">Add task</button>
        @endif
    </article>
</div>
<div class="col-md-4 " id="inprocesslist">
    <article class="model">
        <h2 class="art-h2">In process</h2>
        <ul id="sortable2" type="status2" class="connectedSortable detail-task2">
            @foreach($tasks as $task)
                @if($task->status_id==2)
                    <li data-index="{{$task->id}}" data-position="{{$task->position}}" data-status="{{$task->todo_list_id}} " class="has-dropdown">
                        <p>
                            <a style="color: black;" >{{$task->name}}</a>
                        </p>
                        <span id="ats" class="ats"><span><i class="icon-location-2"></i></span>{{$task->assign->name}}@if($task->assign->id == @Auth::user()->id) (me) @endif</span>
                        <p class="badges">
                                        <span class="js-badges">
                        <p id="priority1{{$task->id}}" class="badge js-due-date-badge is-due-past"
                           @if($task->important == 2) style="background-color: #c1c8e4" title="Low Priority"
                           @elseif($task->important == 1) style="background-color: #84ceeb" title="Medium Priority"
                           @else title="High Priority"
                                @endif>
                            <span class="badge-icon icon-sm icon-clock"></span>
                            <span class="badge-text js-due-date-text">{{$task->created_at}}</span>
                            <span class="badge-text2 js-due-date-text" title="{{$task->assign->name}}" aria-label="{{$task->assign->name}}">{{$task->assign->character}}</span>
                        </p>
                        </span>
                        </p>
                    </li>
                @endif
            @endforeach
        </ul>
    </article>
</div>
<div class="col-md-4" id="donelist">
    <article class="model">
        <h2 class="art-h2">Done</h2>
        <ul id="sortable3" type="status3" class="connectedSortable detail-task3">
            @foreach($tasks as $task)
                @if($task->status_id==3)
                    <li data-index="{{$task->id}}" data-position="{{$task->position}}" data-status="{{$task->todo_list_id}} " class="has-dropdown">
                        <p>
                            <a style="color: black;" >{{$task->name}}</a>
                        </p>
                        <span id="ats" class="ats"><span><i class="icon-location-2"></i></span>{{$task->assign->name}}@if($task->assign->id == @Auth::user()->id) (me) @endif</span>
                        <p class="badges">
                                        <span class="js-badges">
                        <p id="priority1{{$task->id}}" class="badge js-due-date-badge is-due-past"
                           @if($task->important == 2) style="background-color: #c1c8e4" title="Low Priority"
                           @elseif($task->important == 1) style="background-color: #84ceeb" title="Medium Priority"
                           @else title="High Priority"
                                @endif>
                            <span class="badge-icon icon-sm icon-clock"></span>
                            <span class="badge-text js-due-date-text">{{$task->created_at}}</span>
                            <span class="badge-text2 js-due-date-text" title="{{$task->assign->name}}" aria-label="{{$task->assign->name}}">{{$task->assign->character}}</span>
                        </p>
                        </span>
                        </p>
                    </li>
                @endif
            @endforeach
        </ul>
    </article>
</div>