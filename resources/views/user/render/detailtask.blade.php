<form id="edit-task-form">
    @csrf()
    <div class="container">
        <div class="row">
            <h2 style="padding-left: 35%">Task's Information</h2>
            <div class="col-md-4 col-md-push-8 ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-info-wrap-flex">
                            <div class="con-info">
                                <p><span><i class="icon-location-2"></i></span> Assign </p>
                                @foreach($tasks as $task)
                                <input type="hidden" id="todo_list_id" class="form-control" name="todo_list_id" value="{{$task->todo_list_id}}">
                                @break
                                @endforeach
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
                                <p><span><i class="icon-globe"></i></span> Priority level </p>
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
            <div class="col-md-8 col-md-pull-4 ">
                <div class="row form-group">
                    @foreach($tasks as $task)
                        <div class="col-md-12">
                            <p></p>
                            <p>Title</p>
                            <input hidden="hidden" name="name" id="name{{$task->id}}" cols="30" rows="1" class="hidden_dis" value="{{$task->name}}" >
                        </div>
                        <div class="col-md-12">
                            <p></p>
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