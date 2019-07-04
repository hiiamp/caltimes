<?php

namespace App\Http\Controllers\Client;

use App\Entities\Tasks;
use App\Entities\TodoList;
use App\Entities\User;
use App\Repositories\TodoListRepository;
use App\Repositories\UserRepository;
use App\Validators\TodoListValidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Client\TodoListsController;


use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TasksCreateRequest;
use App\Http\Requests\TasksUpdateRequest;
use App\Repositories\TasksRepository;
use App\Validators\TasksValidator;

/**
 * Class TasksController.
 *
 * @package namespace App\Http\Controllers;
 */
class TasksController extends Controller
{
    /**
     * @var TasksRepository
     */
    protected $repository;

    /**
     * @var TasksValidator
     */
    protected $validator;


    protected $listRepo;

    protected $userRepo;

    protected $tasksRepo;


    /**
     * TasksController constructor.
     *
     * @param TasksRepository $repository
     * @param TasksValidator $validator
     */

    public function __construct(TasksRepository $repository, TasksValidator $validator, TodoListRepository $listRepo, UserRepository $userRepo)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->listRepo = $listRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $tasks = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tasks,
            ]);
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TasksCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TasksCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $task = $this->repository->create($request->all());

            $response = [
                'message' => 'Tasks created.',
                'data'    => $task->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $task,
            ]);
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = $this->repository->find($id);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TasksUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TasksUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $task = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Tasks updated.',
                'data'    => $task->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Tasks deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Tasks deleted.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createTask(Request $request)
    {
        $name = $request['name'];
        $priority = $request['priority'];
        $todo_list_id = $request['todoid'];
        $position = $request['position'];
        $status = $request['status'];
        $data = [
            'name' => $name,
            'priority' => $priority,
            'status_id' => $status,
            'todo_list_id' => $todo_list_id,
            'user_id' => Auth::user()->id,
            'position' => $position
        ];
        $this->repository->create($data);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editTask(Request $request)
    {
        $task = $this->repository->find($request['task_id']);
        $name = $request['name'];
        if($name=='') $name=$task->name;
        $content = $request['content'];
        $assign = $request['assign'];
        if($assign=='') $assign=$task->user_id;
        $data = [
            'name' => $name,
            //'priority' => $priority,
            'content' => $content,
            'user_id' => $assign
        ];
        $this->repository->find($request['task_id'])->update($data);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTask(Request $request)
    {
        $id = $request['task_id'];
        $task = $this->repository->find($id);
        $name = $task->name;
        $this->repository->delete($id);
        return redirect()->back()->with('notif', 'Delete task: \''.$name.'\' success!');
    }

    /**
     * @param Request $request
     */
    public function swapPosition(Request $request)
    {
        if(isset($request['update'])){
            foreach ($request['positions'] as $position){
                $index = $position[0];
                $newPosition = $position[1];
                $this->repository->find($index)->update([
                                            'position' => $newPosition,
                                            'status_id' => $position[2]
                                            ]);
            }
            exit('success');
        }
    }

    /**
     * @param Request $request
     */
    public function searchTask(Request $request)
    {
        if($request->ajax())
        {
            $error = 'No data found';
            $output = '';
            $todo = '';
            $inprocess = '';
            $done = '';
            $search = $request->search;
            $todo_list_id = $request->todo_list_id;
            if($search != '')
            {
                $data=$this->repository->searchTask($search,$todo_list_id);
            }
            else
            {
                $data=$this->repository->getTaskByIdList($todo_list_id);
            }
            $total_row = $data->count();
            if($total_row>0)
            {
                foreach ($data as $task)
                {
                    $userTask = $this->userRepo->find($task->user_id);
                    $t = $userTask->name;
                    $t = str_split($t);
                    $temp = $t[0];
                    $check = 0;
                    foreach ($t as $a)
                    {
                        if($check == 1) {
                            $temp.=$a;
                            $check = 0;
                        } else if( $a == ' ') $check = 1;
                    }
                    $userTask->character = $temp;
                    $task->assign = $userTask;
                    if ($task->todo_list_id != $todo_list_id) continue;
                    if($task-> status_id == 1)
                        $todo .= '<li data-index="'.$task->id.'" data-position="'.$task->position.'" data-status="'.$task->todo_list_id.' " class="has-dropdown">
                                    <p>
                                        <a style="color: black;" >'.$task->name.'</a>
                                    </p>
                                    <span id="ats" class="ats"><span><i class="icon-location-2"></i></span>'.$task->assign->name.'</span>
                                    <p class="badges">
                                        <span class="js-badges">
                                            <p class="badge js-due-date-badge is-due-past" title="This card is past due.">
                                                <span class="badge-icon icon-sm icon-clock"></span>
                                                <span class="badge-text js-due-date-text">'.$task->created_at.'</span>
                                                <span class="badge-text2 js-due-date-text" title="'.$task->assign->name.'" aria-label="'.$task->assign->name.'">'.$task->assign->character.'</span>
                                            </p>
                                        </span>
                                    </p>
                                </li>';
                    else
                    if($task-> status_id == 2)
                        $inprocess .= '<li data-index="'.$task->id.'" data-position="'.$task->position.'" data-status="'.$task->todo_list_id.' " class="has-dropdown">
                                    <p>
                                        <a style="color: black;" >'.$task->name.'</a>
                                    </p>
                                    <span id="ats" class="ats"><span><i class="icon-location-2"></i></span>'.$task->assign->name.'</span>
                                    <p class="badges">
                                        <span class="js-badges">
                                            <p class="badge js-due-date-badge is-due-past" title="This card is past due.">
                                                <span class="badge-icon icon-sm icon-clock"></span>
                                                <span class="badge-text js-due-date-text">'.$task->created_at.'</span>
                                                <span class="badge-text2 js-due-date-text" title="'.$task->assign->name.'" aria-label="'.$task->assign->name.'">'.$task->assign->character.'</span>
                                            </p>
                                        </span>
                                    </p>
                                </li>';
                    else
                        if($task-> status_id == 3)
                            $done .= '<li data-index="'.$task->id.'" data-position="'.$task->position.'" data-status="'.$task->todo_list_id.' " class="has-dropdown">
                                    <p>
                                        <a style="color: black;" >'.$task->name.'</a>
                                    </p>
                                    <span id="ats" class="ats"><span><i class="icon-location-2"></i></span>'.$task->assign->name.'</span>
                                    <p class="badges">
                                        <span class="js-badges">
                                            <p class="badge js-due-date-badge is-due-past" title="This card is past due.">
                                                <span class="badge-icon icon-sm icon-clock"></span>
                                                <span class="badge-text js-due-date-text">'.$task->created_at.'</span>
                                                <span class="badge-text2 js-due-date-text" title="'.$task->assign->name.'" aria-label="'.$task->assign->name.'">'.$task->assign->character.'</span>
                                            </p>
                                        </span>
                                    </p>
                                </li>';

                }
                $output .= '
                    <div class="col-md-4" id="todolist">
                        <article class="model">
                            <h2 class="art-h2">To do</h2>
                            <ul id="sortable1" class="connectedSortable detail-task1">
                                '.$todo.'
                            </ul>
                            <button id="add-task" type="submit" class="btn btn-primary">Add task</button>
                        </article>
                    </div>
                    <div class="col-md-4" id="inprocesslist">
                        <article class="model">
                            <h2 class="art-h2">In process</h2>
                            <ul id="sortable2" class="connectedSortable detail-task2">
                                '.$inprocess.'
                            </ul>
                        </article>
                    </div>
                    <div class="col-md-4" id="donelist">
                        <article class="model">
                            <h2 class="art-h2">Done</h2>
                            <ul id="sortable3" class="connectedSortable detail-task3">
                                '.$done.'
                            </ul>
                        </article>
                    </div>
                    ';
            }
            else
            {
                $output .= '
                    <div class="col-md-4">
                        <article class="model">
                            <h2>To do</h2>
                            <ul id="sortable1" class="connectedSortable detail-task1">
                                '.$error.'
                            </ul>
                            <button id="add-task" type="submit" class="btn btn-primary">Add task</button>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="model">
                            <h2>In process</h2>
                            <ul id="sortable2" class="connectedSortable detail-task2">
                                '.$error.'
                            </ul>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="model">
                            <h2>Done</h2>
                            <ul id="sortable3" class="connectedSortable detail-task3">
                                '.$error.'
                            </ul>
                        </article>
                    </div>
                    ';
            }
            $data1 = array(
                'table_data'  => $output,
                'ten' => $data
            );
            echo json_encode($data1);
        }
    }
}
