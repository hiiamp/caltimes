<?php

namespace App\Http\Controllers\Client;

use Response;
use App\Entities\Access;
use App\Entities\TodoList;
use App\Entities\Tasks;
use App\Repositories\TasksRepository;
use App\Repositories\UserRepository;
use App\Repositories\AccessRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TodoListCreateRequest;
use App\Http\Requests\TodoListUpdateRequest;
use App\Repositories\TodoListRepository;
use App\Validators\TodoListValidator;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use Illuminate\Support\Facades\DB;

/**
 * Class TodoListsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TodoListsController extends Controller
{
    /**
     * @var TodoListRepository
     */
    protected $repository;

    /**
     * @var TodoListValidator
     */
    protected $validator;

    /**
     * @var
     */
    protected $userRepo;

    /**
     * @var
     */
    protected $tasksRepo;

    protected $accessRepo;

    /**
     * TodoListsController constructor.
     *
     * @param TodoListRepository $repository
     * @param TodoListValidator $validator
     */
    public function __construct(TodoListRepository $repository, TodoListValidator $validator, UserRepository $userRepo, TasksRepository $tasksRepo, AccessRepository $accessRepo)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->userRepo = $userRepo;
        $this->tasksRepo = $tasksRepo;
        $this->accessRepo = $accessRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $todoLists = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $todoLists,
            ]);
        }

        return view('todoLists.index', compact('todoLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TodoListCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TodoListCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $todoList = $this->repository->create($request->all());

            $response = [
                'message' => 'TodoList created.',
                'data'    => $todoList->toArray(),
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
        $todoList = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $todoList,
            ]);
        }

        return view('todoLists.show', compact('todoList'));
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
        $todoList = $this->repository->find($id);

        return view('todoLists.edit', compact('todoList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TodoListUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TodoListUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $todoList = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TodoList updated.',
                'data'    => $todoList->toArray(),
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
                'message' => 'TodoList deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TodoList deleted.');
    }

    public function createList(Request $request)
    {
        $name = $request['name'];
        $is_public = $request['is_public'];
        $user_id = Auth::user()->id;
        $link = str_random(8);
        $tdLists = $this->repository->findByField('name', $name);
        foreach ($tdLists as $tdList)
        {
            if($tdList->owner_id == Auth::user()->id){
                return redirect()->back()->with([
                    'name_exist' => 'temp',
                    'name' => $name
                ]);
            }
        }
        $data = [
            'name' => $name,
            'link' => $link,
            'is_public' => $is_public,
            'owner_id' => $user_id
        ];
        $this->repository->create($data);

        $todolists = $this->repository->findByField('name', $name);
        foreach ($todolists as $todolist)
        {
            if($todolist->owner_id == Auth::user()->id){
                $this->repository->addAccess([
                    'user_id' => $user_id,
                    'todo_list_id' => $todolist->id
                ]);
                return redirect()->route('link.board', [
                    'code' => $link
                ]);
            }
        }
        return redirect()->route('link.board', [
            'code' => $link
        ]);
    }

    public function viewList($code)
    {
        $todoList = $this->repository->findByField('link',$code)->first();
        $user = $this->userRepo->find($todoList->owner_id);
        $username = $user->name;
        $tasks = $this->tasksRepo->getTaskByIdList($todoList->id);
        foreach ($tasks as $task)
        {
            $userTask = $this->userRepo->find($task->user_id);
            $task->assign = $userTask;
            /*if($task->status_id == 1) $task->status = 'To do';
            else if($task->status_id == 2) $task->status = 'In process';
                else if($task->status_id == 3) $task->status = 'Done';
                    else $task->status = 'Unknown 404';*/
        }
        $userShared = $this->repository->findUserShared($todoList->id)->get();
        $check_own = true;
        if($user->id != Auth::user()->id) $check_own = false;
        return view('user.todo_list.index')->with([
            'list' => $todoList,
            'username' => $username,
            'tasks' => $tasks,
            'list_users' => $userShared,
            'own' => $check_own
        ]);
    }

    public function viewAllLists()
    {
        $lists = $this->repository->findListCanView(Auth::user()->id)->paginate(6);
        foreach ($lists as $list)
        {
            $list->owner = $this->userRepo->find($list->owner_id);
        }
        return view('user.home.index',[
            'lists' => $lists
        ]);
    }

    /**
     * @param Request $request
     */
    public function searchList(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $search = $request->search;
            if ($search != '') {
                $data = $this->repository->searchList($search);
            } else {
                if(Auth::user()->level == 1) {
                    $data = $this->repository->findListCanView(Auth::user()->id)->paginate(6);
                }
                else {
                    $data = $this->repository->allBuider()->paginate(5);
                }
            }
            $total_row = $data->count();
            if(Auth::user()->level == 1)
            {
                if ($total_row > 0) {
                    foreach ($data as $list) {
                        $list->owner = $this->userRepo->find($list->owner_id);
                        if ($list->is_public == 1) {
                            $is_public = '<p><span><i class="icon-globe"></i></span> Public <br></p>';
                        } else {
                            $is_public = '<p><span><i class="icon-globe"></i></span> Private <br></p>';
                        }
                        $output .= '
                    <div class="col-md-2 col-sm-3 col-xs-6 text-center">
                        <div class="product-entry">
                            <div class="product-img">
                                <article>
                                    <h2>' . $list->name . '</h2>
                                    <p class="admin"><span>' . $list->created_at . '</span></p>
                                    ' . $is_public . '
                                    <p><span><i class="icon-location-2"></i></span> Created By: '.$list->owner->name.'<br></p>
                                    <p><a href="' . route('link.board', ['code' => $list->link]) . '" class="btn btn-primary btn-outline with-arrow">See more</a></p>
                                </article>
                            </div>
                        </div>
                    </div>
                    ';
                    }
                } else {
                    $output = '<h2>No Data Found</h2>';
                }
            }
            else
            {
                if ($total_row > 0) {

                    foreach ($data as $list) {
                        $output .= '
                            <tr>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="'.route('link.board',['code'=>$list->link]).'">'.$list->link.'</a>
                                </td>
                                <td>
                                    '.$list->name.'
                                </td>
                                <td>
                                    '.$list->created_at.'
                                </td>
                                <td>
                                    '.$list->owner.'
                                </td>
                                <td>
                                    <a href="'.route('admin.user').'?list_id='.$list->id.'" class="btn btn-sm btn-primary" style="color: whitesmoke"> Worker </a>
                                    <a data-index="'.$list->id.'" id="Delete'.$list->id.'" class="btn btn-sm btn-primary delete_l" style="color: whitesmoke"> Delete </a>;
                                </td>
                            </tr>
                        ';
                    }
                }
                else
                {
                    $output = '<h2>No Data Found</h2>';
                }
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }
    public function deleteList(Request $request)
    {
        $admin = '';
        $admin = @$request['checkadmin'];
        $todo_list_id = $request['todo_list_id'];
        $list = $this->repository->find($request['todo_list_id']);
        $name = $list->name;
        $this->tasksRepo->deleteWhere([
            'todo_list_id' => $todo_list_id
        ]);
        $this->accessRepo->deleteWhere([
            'todo_list_id' => $todo_list_id
        ]);
        $this->repository->delete($request['todo_list_id']);
        if($admin != '') return redirect()->back()->with('notif', 'Deleted '.$name.' success!');
        return redirect()->route('home')->with('deleted_list', 'Deleted '.$name.' success!');
    }

    public function manageList(Request $request)
    {
        if(Auth::user()->level == 2){
            $user_id = $request['user_id'];
            if($user_id!=null){
                $temp = $this->userRepo->find($user_id);
                if($temp == null) {
                    $lists = $this->repository->allBuider()->paginate(5);
                    $lists->table_name = 'All list';
                } else {
                    $lists = $this->repository->findListCanView($user_id)->paginate(5);
                    $lists->table_name = 'List of user: '.$temp->name;
                }
            } else {
                $lists = $this->repository->allBuider()->paginate(5);
                $lists->table_name = 'All list';
            }
            foreach ($lists as $list)
            {
                $users = $this->repository->findUserShared($list->id);
                $list->users = $users;
                $user = $this->userRepo->find($list->owner_id);
                $list->owner = $user->name;
            }
            return view('admin.list', [
                'lists' => $lists,
            ]);
        }
        return redirect()->route('home');
    }

    public function changeIsPublicList(Request $request)
    {
        $id = $request['list_id'];
        $list = $this->repository->find($id);
        if($list->owner_id != Auth::user()->id){
            return redirect()->route('home');
        }
        $this->repository->changeIsPublicList($id);
        return redirect()->back();
    }
}
