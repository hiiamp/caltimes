<?php

namespace App\Http\Controllers\Client;

use App\Entities\Tasks;
use App\Http\Controllers\Controller;
use App\Http\Requests\TasksCreateRequest;
use App\Http\Requests\TasksUpdateRequest;
use App\Notifications\RepliedToThread;
use App\Providers\Export;
use App\Repositories\TasksRepository;
use App\Repositories\TodoListRepository;
use App\Repositories\UserRepository;
use App\Validators\TasksValidator;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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

    /**
     * @var TodoListRepository
     */
    protected $listRepo;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * @var
     */
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function createTask(Request $request)
    {
        if ($request->ajax()) {
            $success_output = '';
            $detail = '';
            $error = '';
            if ($request->get('button_action') == "insert") {
                $name = $request->get('name');
                $content = $request->get('content');
                $important = $request->get('priority');
                $todo_list_id = $request->get('todoid');
                $user_id = $request->get('assign');
                $checkName = $this->repository->checkName($todo_list_id, $name);
                //if($checkName) {
                //    $error = 'This name has already existed.';
                //} else {
                $task1 = [
                    'name' => $name,
                    'content' => $content,
                    'important' => $important,
                    'status_id' => 1,
                    'todo_list_id' => $todo_list_id,
                    'user_id' => $user_id,
                    'position' => 0,
                ];
                $task1 = $this->repository->create($task1);
                $userTask = $this->userRepo->find($task1->user_id);
                $t = $userTask->name;
                $t = str_split($t);
                $temp = $t[0];
                $check = 0;
                foreach ($t as $a) {
                    if ($check == 1) {
                        $temp .= $a;
                        $check = 0;
                    } else if ($a == ' ') $check = 1;
                }
                $userTask->character = $temp;
                $task1->assign = $userTask;
                $task1->created = (new Carbon($task1->created_at))->toFormattedDateString();
                $success_output = view('user.render.addtask')->with(['task' => $task1])->render();
                $tasks = $this->repository->getTaskByIdList($todo_list_id);
                foreach ($tasks as $task) {
                    $userTask = $this->userRepo->find($task->user_id);
                    $t = $userTask->name;
                    $t = str_split($t);
                    $temp = $t[0];
                    $check = 0;
                    foreach ($t as $a) {
                        if ($check == 1) {
                            $temp .= $a;
                            $check = 0;
                        } else if ($a == ' ') $check = 1;
                    }
                    $userTask->character = $temp;
                    $task->assign = $userTask;
                }
                $list_users = $this->listRepo->findUserShared($todo_list_id)->get();

                $detail = view('user.render.detailtask')->with(['tasks' => $tasks, 'list_users' => $list_users, 'list_id' => $todo_list_id])->render();
                //}
            }
            $user = $this->userRepo->find(Auth::user()->id);
            $list = $this->listRepo->find($request->get('todoid'));
            $users = $this->userRepo->notiUser($request->get('todoid'));
            Notification::send($users, new RepliedToThread($list, Tasks::latest('id')->first(), 'create', $user));
            $output = array(
                'out' => $success_output,
                'detail' => $detail,
                'error' => $error,
            );
            echo json_encode($output);
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function editTask(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('edit_action') == 'edit') {
                $todo_list_id = $request->get('todo_list_id');
                $id_task = $request->get('task_id');
                $task = $this->repository->find($id_task);
                $name = $request->get('name');
                if ($name == '') $name = $task->name;
                $content = $request->get('content');
                $assign = $request->get('assign');
                $important = $request->get('priority');
                if ($assign == '') $assign = $task->user_id;
                $userTask = $this->userRepo->find($task->user_id);
                $t = $userTask->name;
                $t = str_split($t);
                $temp = $t[0];
                $check = 0;
                foreach ($t as $a) {
                    if ($check == 1) {
                        $temp .= $a;
                        $check = 0;
                    } else if ($a == ' ') $check = 1;
                }
                $userTask->character = $temp;
                $task->assign = $userTask;
                $data = [
                    'name' => $name,
                    'content' => $content,
                    'user_id' => $assign,
                    'created_at' => Carbon::now(),
                    'important' => $important
                ];
                $list = $this->listRepo->find($todo_list_id);
                $user = $this->userRepo->find(Auth::user()->id);
                $this->repository->find($id_task)->update($data);
                $users = $this->userRepo->notiUser($todo_list_id);
                Notification::send($users, new RepliedToThread($list, $data, 'edit', $user));
                $t = str_split(($this->userRepo->find($assign))->name);
                $temp = $t[0];
                $check = 0;
                foreach ($t as $a) {
                    if ($check == 1) {
                        $temp .= $a;
                        $check = 0;
                    } else if ($a == ' ') $check = 1;
                }
                echo json_encode(array(
                    'task_id' => $id_task,
                    'important' => $important,
                    'name' => $name,
                    'character' => $temp
                ));
            }
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteTask(Request $request)
    {
        if ($request->ajax()) {
            $id = $request['task_id'];
            $todo_list_id = $this->repository->find($id)->todo_list_id;
            $users = $this->userRepo->notiUser($todo_list_id);
            $user = $this->userRepo->find(Auth::user()->id);
            $list = $this->listRepo->find($todo_list_id);
            $task = $this->repository->find($id);
            Notification::send($users, new RepliedToThread($list, $task, 'delete', $user));
            $name = $task->name;
            $this->repository->delete($id);
            echo json_encode(true);
        }
    }

    /**
     * @param Request $request
     */
    public function swapPosition(Request $request)
    {
        if (isset($request['update']) && isset($request['positions'])) {
            if (is_array($request['positions']))
                foreach ($request['positions'] as $position) {
                    $index = $position[0];
                    $newPosition = $position[1];
                    $this->repository->find($index)->update([
                        'position' => $newPosition,
                        'status_id' => $position[2]
                    ]);
                }
            else {
                $position = $request['positions'];
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
        if ($request->ajax()) {
            $search = $request->search;
            $todo_list_id = $request->todo_list_id;
            if ($search != '') {
                $data = $this->repository->searchTask($search, $todo_list_id);
            } else {
                $data = $this->repository->getTaskByIdList($todo_list_id);
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $task) {
                    $userTask = $this->userRepo->find($task->user_id);
                    $t = $userTask->name;
                    $t = str_split($t);
                    $temp = $t[0];
                    $check = 0;
                    foreach ($t as $a) {
                        if ($check == 1) {
                            $temp .= $a;
                            $check = 0;
                        } else if ($a == ' ') $check = 1;
                    }
                    $userTask->character = $temp;
                    $task->assign = $userTask;
                    $task->created = (new Carbon($task->created_at))->toFormattedDateString();
                }
                $output = view('user.render.searchtask')->with('tasks', $data)->render();
            } else {
                $output = '<h2></h2>
                           <img style="margin-left: 40%; width: 600px;height: 380px " src="' . asset('user/images/11.png') . '">';
            }
            $out1 = array(
                'dataSearch' => $output,
                'total_data' => $total_row
            );
            echo json_encode($out1);
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */

    public function export_csv(Request $request)
    {
        $todo_list_id = $request->get('list_id');
        if ($todo_list_id == '') {
            return redirect()->back();
        }
        $list = $this->listRepo->find($todo_list_id);
        $tasks = $this->repository->getTaskByIdList($todo_list_id);
        $csv = new Export();
        $csv->beforeEach(function ($task) {
            $task->assign = $task->user->name;
            $task->status = $task->status->name;
            $task->important = $task->important;
            if ($task->important == 0) $task->important = 'High';
            else if ($task->important == 1) $task->important = 'Medium';
            else if ($task->important == 2) $task->important = 'Low';
            $task->create = $task->created_at;
        });
        $csv->build($tasks, ['name', 'content', 'assign', 'status', 'important', 'create']);
        $csv->download(($list->name) . '.csv');
    }
}
