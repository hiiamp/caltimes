<?php

namespace App\Http\Controllers\Client;

use App\Repositories\CoworkerRepository;
use App\Notifications\RepliedToThread;
use App\Repositories\TempAccessRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
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
use App\Http\Controllers\Controller;

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
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * @var TasksRepository
     */
    protected $tasksRepo;

    /**
     * @var AccessRepository
     */
    protected $accessRepo;

    /**
     * @var CoworkerRepository
     */
    protected $coworkerRepo;

    /**
     * @var TempAccessRepository
     */
    protected $tempAccessRepo;
    /**
     * TodoListsController constructor.
     *
     * @param TodoListRepository $repository
     * @param TodoListValidator $validator
     */
    public function __construct(TodoListRepository $repository, TodoListValidator $validator, UserRepository $userRepo,
        TasksRepository $tasksRepo, AccessRepository $accessRepo, CoworkerRepository $coworkerRepo, TempAccessRepository $tempAccessRepo)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->userRepo = $userRepo;
        $this->tasksRepo = $tasksRepo;
        $this->accessRepo = $accessRepo;
        $this->coworkerRepo = $coworkerRepo;
        $this->tempAccessRepo = $tempAccessRepo;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createList(Request $request)
    {
        $name = $request['name'];
        $is_public = $request['is_public'];
        if((!Auth::user()->isVip || Auth::user()->isVip != '0') && $this->repository->findByField('owner_id', Auth::user()->id)->count() >= 10) {
            return redirect()->back()->with('max_list', true);
        }
        $user_id = Auth::user()->id;
        $link = str_random(8);
        while($this->repository->findByField('link', $link)->first())
        {
            $link = str_random(8);
        }
        $tdLists = $this->repository->findByField('name', $name);
        foreach ($tdLists as $tdList)
        {
            if($tdList->owner_id == Auth::user()->id) {
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
            if($todolist->owner_id == Auth::user()->id) {
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

    /**
     * @param $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewList($code, Request $request)
    {
        $noti_id = isset($request['noti']) ? $request['noti'] : '';
        if($noti_id != '') {
            $this->repository->maskAsReadNoti($noti_id);
        }
        $todoList = $this->repository->findByField('link',$code)->first();
        $user = $this->userRepo->find($todoList->owner_id);
        $username = $user->name;
        if($todoList->isDeleted) return redirect()->route('home')->with('notif', $todoList->name.' is deleted, contact '.$user->email.'('.$username.') to recover it.');
        $tasks = $this->tasksRepo->getTaskByIdList($todoList->id);
        foreach ($tasks as $task)
        {
            $tt = new Carbon($task->created_at);
            $task->created = $tt->toFormattedDateString();
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
            /*if($task->status_id == 1) $task->status = 'To do';
            else if($task->status_id == 2) $task->status = 'In process';
                else if($task->status_id == 3) $task->status = 'Done';
                    else $task->status = 'Unknown 404';*/
        }
        $userShared = $this->repository->findUserShared($todoList->id)->get();
        foreach ($userShared as $u)
        {
            $u->countTask = $this->tasksRepo->findWhere([
                    'todo_list_id'=> $todoList->id,
                    'user_id' => $u->id
                ])->count();
            if(!Auth::check()) $u->isCo = 0;
            else {
                $u->isCo = $this->coworkerRepo->findWhere([
                    'user_id' => Auth::user()->id,
                    'user_co_id' => $u->id
                ])->count();
            }
        }
        $check_own = true;
        if(!Auth::check()) {
            $check_own = false;
            return view('user.todo_list.index')->with([
                'list' => $todoList,
                'username' => $username,
                'tasks' => $tasks,
                'list_users' => $userShared,
                'own' => $check_own,
            ]);
        }
        if($user->id != Auth::user()->id) $check_own = false;
        $favourites = $this->coworkerRepo->findFavourites(Auth::user()->id);
        foreach ($favourites as $u)
        {
            $u->shared = $this->accessRepo->findWhere([
                'todo_list_id' => $todoList->id,
                'user_id' => $u->id
            ])->count();
        }
        return view('user.todo_list.index')->with([
            'list' => $todoList,
            'username' => $username,
            'tasks' => $tasks,
            'list_users' => $userShared,
            'own' => $check_own,
            'favourites' => $favourites
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewAllLists()
    {
        $user = $this->userRepo->find(Auth::user()->id);
        if(strlen($user->remember_token) > 9) {
            do {
                $temp = str_random(8);
            } while($this->userRepo->findByField('remember_token', $temp)->count());
            $this->userRepo->update(['remember_token' => $temp], $user->id);
        }
        $tempacs = $this->tempAccessRepo->findByField('email', $user->email);
        if($tempacs->count())
        {
            foreach ($tempacs as $t)
            {
                if(!$this->accessRepo->findWhere(['user_id' => Auth::user()->id, 'todo_list_id' => $t->todo_list_id])->count()) {
                    $this->accessRepo->create(['user_id' => Auth::user()->id, 'todo_list_id' => $t->todo_list_id]);
                }
                $this->tempAccessRepo->delete($t->id);
            }
        }
        $lists = $this->repository->findListCanView(Auth::user()->id)->paginate(6);
        foreach ($lists as $list)
        {
            $list->created = (new Carbon($list->created_at))->toFormattedDateString();
            $list->owner = $this->userRepo->find($list->owner_id);
            $list->member = $this->accessRepo->findByField('todo_list_id', $list->id)->count();
        }
        return view('user.home.index',[
            'lists' => $lists
        ]);
    }

    /**
     * ajax
     * @param Request $request
     */
    public function searchList(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $search = isset($request['search']) ? $request['search'] : '';
            $page = isset($request['page']) ? $request['page'] : 1;
            if($page < 1) $page = 1;
            $check_admin = isset($request['admin']) ? $request['admin'] : false;
            if($check_admin) {
                $data = $this->repository->searchList($search, 7, $page);
                while ($data->count() == 0 && $page > 1) {
                    $page--;
                    $data = $this->repository->searchList($search, 7, $page);
                }
            } else {
                $data = $this->repository->searchList($search, 6, $page);
                while ($data->count() == 0 && $page > 1) {
                    $page--;
                    $data = $this->repository->searchList($search, 6 , $page);
                }
            }
            $total_row = $data->count();
            if(!$check_admin) {
                if ($total_row > 0) {
                    foreach ($data as $list) {
                        $list->owner = $this->userRepo->find($list->owner_id);
                        $list->member = $this->accessRepo->findByField('todo_list_id', $list->id)->count();
                    }
                    $output = view('user.render.searchlist_user')->with('lists',$data)->render();
                } else {
                    $output = '<h2></h2>
                               <img style="margin-left: 35%; width: 600px;height: 380px " src="'. asset('user/images/11.png').'">';
                }
            } else {
                if ($total_row > 0) {
                    foreach ($data as $list) {
                        $user = $this->userRepo->find($list->owner_id);
                        $list->owner = $user->name;
                    }
                    $output = view('user.render.searchlist_admin')->with('lists',$data)->render();
                } else {
                    $output = '<h2></h2>
                               <img style="margin-left: 35%; width: 600px;height: 380px " src="'. asset('user/images/12.png').'">';
                }
            }
            $data = array(
                'page_current' => $page,
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteList(Request $request)
    {
        $admin = '';
        if(isset($request['checkadmin']) && isset($request['todo_list_id'])) {
            $admin = $request['checkadmin'];
            $todo_list_id = $request['todo_list_id'];
        } else {
            return redirect()->back()->with('notif', 'There was an error when you delete a list.');
        }
        $users = $this->userRepo->notiUser($todo_list_id);
        $user = $this->userRepo->find(Auth::user()->id);
        $task = [
            'id'   => '0',
            'name' => 'null',
            'content' => 'null',
            'user_id' => 'null',
            'created_at' => Carbon::now(),
        ];
        $list = $this->repository->find($request['todo_list_id']);
        Notification::send($users,new RepliedToThread($list,$task,'delete a list',$user));
        $name = $list->name;
        $this->tasksRepo->deleteWhere([
            'todo_list_id' => $todo_list_id
        ]);
        $this->accessRepo->deleteWhere([
            'todo_list_id' => $todo_list_id
        ]);
        $this->tempAccessRepo->deleteWhere([
            'todo_list_id' => $todo_list_id
        ]);
        $this->repository->delete($request['todo_list_id']);
        if($admin != '') return redirect()->back()->with('notif', 'Deleted '.$name.' success!');
        return redirect()->route('home')->with('deleted_list', 'Deleted '.$name.' success!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveListToRecycle(Request $request)
    {
        $admin = '';
        $admin = @$request['checkadmin'];
        $list = $this->repository->find($request['todo_list_id']);
        $name = $list->name;
        $users = $this->userRepo->notiUser($request['todo_list_id']);
        $user = $this->userRepo->find(Auth::user()->id);
        $task = [
            'id'   => '0',
            'name' => 'null',
            'content' => 'null',
            'user_id' => 'null',
            'created_at' => Carbon::now(),
        ];
        Notification::send($users,new RepliedToThread($list,$task,'move a list',$user));
        $this->repository->update(['isDeleted' => true], $list->id);
        if($admin != '') return redirect()->back()->with('notif', 'Deleted '.$name.' success!');
        return redirect()->route('home')->with('deleted_list', 'Move '.$name.' to your recycle, come there to recover it!');
    }

    public function recoverList($code)
    {
        $list = $this->repository->findByField('link', $code)->first( );
        $name = $list->name;
        $users = $this->userRepo->notiUser($list->id);
        $user = $this->userRepo->find(Auth::user()->id);
        $task = [
            'id'   => '0',
            'name' => 'null',
            'content' => 'null',
            'user_id' => 'null',
            'created_at' => Carbon::now(),
        ];
        Notification::send($users,new RepliedToThread($list,$task,'recover a list',$user));
        $this->repository->update(['isDeleted' => false], $list->id);
        //if($admin != '') return redirect()->back()->with('notif', 'Recover '.$name.' success!');
        return redirect()->route('link.board', ['code' => $list->link])->with('notif', 'Recover '.$name.' success!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function manageList(Request $request)
    {
        $check1=0;
        if(Auth::user()->level == User::isAdmin){
            $user_id = $request['user_id'];
            if($user_id!=null) {
                $temp = $this->userRepo->find($user_id);
                if($temp == null) {
                    $lists = $this->repository->allBuider()->paginate(7);
                    $lists->table_name = 'All list';
                } else {
                    $lists = $this->repository->findListCanView($user_id)->paginate(5);
                    $lists->table_name = 'List of user: '.$temp->name;
                    $check1=1;
                }
            } else {
                $lists = $this->repository->allBuider()->paginate(7);
                $lists->table_name = 'All list';
            }
            foreach ($lists as $list)
            {
                $users = $this->repository->findUserShared($list->id);
                $list->users = $users;
                $user = $this->userRepo->find($list->owner_id);
                $list->owner = $user->name;
            }
            $t = Auth::user()->name;
            $t = str_split($t);
            $temp1 = $t[0];
            $check = 0;
            foreach ($t as $a)
            {
                if($check == 1) {
                    $temp1.=$a;
                    $check = 0;
                } else if( $a == ' ') $check = 1;
            }
            if($check1 == 0) {
                return view('admin.list', [
                    'lists' => $lists,
                    'character' => $temp1,
                ]);
            } else {
                return view('admin.list', [
                    'lists' => $lists,
                    'character' => $temp1,
                    'check' => $check1
                ]);
            }

        }
        return redirect()->route('home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeIsPublicList(Request $request)
    {
        if(isset($request['list_id'])) {
            $id = $request['list_id'];
        } else {
            return redirect()->back()->with('notif', 'There was an error when you change status of a list.');
        }
        $list = $this->repository->find($id);
        if($list->owner_id != Auth::user()->id){
            return redirect()->route('home');
        }
        $this->repository->changeIsPublicList($id);
        $users = $this->userRepo->notiUser($id);
        $user = $this->userRepo->find(Auth::user()->id);
        $task = [
            'id'   => '0',
            'name' => 'null',
            'content' => 'null',
            'user_id' => 'null',
            'created_at' => Carbon::now(),
        ];
        Notification::send($users,new RepliedToThread($list,$task,'change',$user));
        return redirect()->back()->with('notif', 'You have changed the status of the list successfully ');
    }

    public function maskRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function deleteNoti()
    {
        auth()->user()->notifications()->delete();
        return redirect()->back();
    }
}
