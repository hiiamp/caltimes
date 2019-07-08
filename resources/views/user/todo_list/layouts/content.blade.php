<div class="colorlib-blog" >
    <div class="container">
        @foreach($tasks as $task)
            <input id="list_id1" type="hidden" value="{{$task->todo_list_id}}">
            @break
        @endforeach
        <div class="row displayTask" id="Task123">
            <div class="col-md-4 animate-box" id="todolist">
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
                                            <p class="badge js-due-date-badge is-due-past" @if($task->important == 2) style="background-color: #008700" title="Low Priority" @elseif($task->important == 1) style="background-color: #979107" title="Medium Priority" @else title="High Priority" @endif>
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
            <div class="col-md-4 animate-box" id="inprocesslist">
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
                                            <p class="badge js-due-date-badge is-due-past" @if($task->important == 2) style="background-color: #008700" title="Low Priority" @elseif($task->important == 1) style="background-color: #979107" title="Medium Priority" @else title="High Priority" @endif>
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
            <div class="col-md-4 animate-box" id="donelist">
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
                                            <p class="badge js-due-date-badge is-due-past" @if($task->important == 2) style="background-color: #008700" title="Low Priority" @elseif($task->important == 1) style="background-color: #979107" title="Medium Priority" @else title="High Priority" @endif>
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
        </div>
    </div>
</div>

<!--Detail task-->
<dialog id="detail-dialog">
    <form method="post" action="{{route('edit.task')}}">
        @csrf()
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-8 animate-box">
                    <h2>Task's Information</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-info-wrap-flex">
                                <div class="con-info">
                                    <p><span><i class="icon-location-2"></i></span> Assign </p>
                                    <input type="hidden" class="form-control" name="todo_list_id" value="{{$list->id}}">
                                    <input hidden="hidden" value="" id="task_edit_id" name="task_id" >
                                    <select class="btn" name="assign" class="custom-select" id="assign">
                                        @foreach($tasks as $task)
                                            <option class="hiddenn" hidden="hidden" id="assign{{$task->id}}" value="{{$task->assign->id}}">{{$task->assign->name}}@if($task->assign->id == @Auth::user()->id) (me) @endif</option>
                                        @endforeach
                                        @foreach($list_users as $userp)
                                            <option class="showw" id="choose{{$userp->id}}" value="{{$userp->id}}">{{$userp->name}}@if($userp->id == @Auth::user()->id) (me) @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="con-info">
                                    <p class="hiddenn" id="status1" hidden="hidden"><span><i class="icon-paperplane"></i></span> Status <br> To do </p>
                                    <p class="hiddenn" id="status2" hidden="hidden"><span><i class="icon-paperplane"></i></span> Status <br> In process </p>
                                    <p class="hiddenn" id="status3" hidden="hidden"><span><i class="icon-paperplane"></i></span> Status <br> Done </p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-globe"></i></span>Prioty level <br></p>
                                    @foreach($tasks as $task)
                                        <select class="btn prioty" name="priority" class="custom-select" id="priority{{$task->id}}">
                                            @if($task->important == 0)
                                                <option id="p0" value="0" style="background-color: #0da5c0" selected>High</option>
                                                <option id="p1" value="1" style="background-color: #00b3ee">Medium</option>
                                                <option id="p2" value="2" style="background-color: #00f7b5">Low</option>
                                            @elseif($task->important == 1)
                                                <option id="p0" value="0" style="background-color: #0da5c0">High</option>
                                                <option id="p1" value="1" style="background-color: #00b3ee" selected>Medium</option>
                                                <option id="p2" value="2" style="background-color: #00f7b5">Low</option>
                                            @else
                                                <option id="p0" value="0" style="background-color: #0da5c0">High</option>
                                                <option id="p1" value="1" style="background-color: #00b3ee">Medium</option>
                                                <option id="p2" value="2" style="background-color: #00f7b5" selected>Low</option>
                                            @endif
                                        </select>
                                    @endforeach
                                </div>
                                <div class="con-info">
                                    @foreach($tasks as $task)
                                        <input class="delete_task" data-index="{{$task->id}}" id="deletetask{{$task->id}}" type="button" value="Delete this task">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-pull-4 animate-box">
                    <div class="row form-group">
                        @foreach($tasks as $task)
                            <div class="col-md-12">
                                <p>Title</p>
                                <input hidden="hidden" name="name" id="name{{$task->id}}" cols="30" rows="1" class="hidden_dis" value="{{$task->name}}" >
                            </div>
                            <div class="col-md-12">
                                <p>Content</p>
                                <textarea hidden="hidden" name="content" id="content{{$task->id}}" cols="30" rows="10" class="hidden_dis" >{{$task->content}}</textarea>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <input id="save11" type="submit" value="Save" class="btn btn-primary">
                        @endif
                        <input id="out11" type="reset" value="Cancel" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
</dialog>

<!--delete task-->
<dialog id="deletetaskdialog">
    <form method="post" action="{{route('delete.task')}}">
        @csrf
        <div class="row form-group">
            <div class="col-md-12">
                <p>You really want to delete this task?</p>
                <input id="delete_task_id" type="hidden" class="form-control" name="task_id" value="">
                <input type="hidden" class="form-control" name="todo_list_id" value="{{$list->id}}">
            </div>
        </div>
        <div class="form-group">
            <input id="delete_task_submit" type="submit" value="Yes, I'm sure." class="btn btn-primary">
            <input id="delete_task_cancel" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>
<!--Create task-->
<dialog id="create-task">
    <form method="post" action="{{route('create_task')}}">
        @csrf
        <div class="row form-group">
            <div class="col-md-12">
                <p>Create task</p>
                <input type="hidden" id="todoid" class="form-control" name="todoid" value="{{$list->id}}">
                <input type="hidden" id="link" class="form-control" name="link" value="{{$list->link}}">
                <input type="hidden" id="status" class="form-control" name="status" value="1">
                <input type="hidden" id="position" class="form-control" name="position" value="0">
                <input id="name" type="name" class="form-control" name="name" required autofocus placeholder="Your task title">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Importance</label>
                    </div>
                    <select class="btn" name="priority" class="custom-select" id="priority">
                        <option value="0">High</option>
                        <option value="1" selected>Medium</option>
                        <option value="2">Low</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input id="save1" type="submit" value="Save" class="btn btn-primary">
            <input id="out1" type="submit" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>

@include('user.todo_list.layouts.script')
