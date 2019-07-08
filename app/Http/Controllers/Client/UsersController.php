<?php

namespace App\Http\Controllers\Client;

use App\Repositories\AccessRepository;
use App\Repositories\CoworkerRepository;
use App\Repositories\TasksRepository;
use App\Repositories\TodoListRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Http\Controllers\Controller;
use App\Entities\User;


/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    protected $tasksRepo;

    protected $accessRepo;

    protected $todoListRepo;

    protected $coworkerRepo;
    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator, TasksRepository $tasksRepo, AccessRepository $accessRepo, TodoListRepository $todoListRepo, CoworkerRepository $coworkerRepo)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->tasksRepo = $tasksRepo;
        $this->accessRepo = $accessRepo;
        $this->todoListRepo =$todoListRepo;
        $this->coworkerRepo = $coworkerRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $users = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $users,
            ]);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = $this->repository->create($request->all());

            $response = [
                'message' => 'User created.',
                'data'    => $user->toArray(),
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
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
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
        $user = $this->repository->find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function manageUser(Request $request)
    {
        if(Auth::user()->level == User::isAdmin){
            $list_id = $request['list_id'];
            if($list_id != null){
                $temp = null;
                $temp = $this->todoListRepo->find($list_id);
                if($temp == null){
                    $users = $this->repository->allBuilder()->paginate(5);
                    $users->name_table = 'All User';
                } else {
                    $users = $this->todoListRepo->findUserShared($list_id)->paginate(5);
                    $users->name_table = 'Worker joined: '.$temp->name;
                }
            } else{
                $users = $this->repository->allBuilder()->paginate(5);
                $users->name_table = 'All User';
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
            return view('admin.user', [
                'users' => $users,
                'character' => $temp1
            ]);
        }
        return redirect()->route('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function profileUser()
    {
        if(Auth::user()->level > User::isNotActive){
            $users = $this->repository->findCoWorker(Auth::user()->id)->paginate(5);
            foreach ($users as $u)
            {
                $a = $this->todoListRepo->find($u->id);
                $u->list_name = $a->name;
                $u->list_code = $a->link;
            }
            $lists = $this->todoListRepo->findListCanView(Auth::user()->id)->paginate(5);
            foreach ($lists as $list)
            {
                $users1 = $this->todoListRepo->findUserShared($list->id);
                $list->users = $users1;
                $user = $this->repository->find($list->owner_id);
                $list->owner = $user->name;
            }
            $favourites = $this->coworkerRepo->findFavourites(Auth::user()->id);
            $recycleList = $this->todoListRepo->findListInRecycle(Auth::user()->id);
            if(isset($recycleList) && count($recycleList))
                foreach ($recycleList as $list)
                {
                    $list->numtask = count($this->tasksRepo->getTaskByIdList($list->id));
                }
            return view('user.profile.index', [
                'users' => $users,
                'lists' =>$lists,
                'favourites' => $favourites,
                'recycleList' => $recycleList
            ]);
        }
        return redirect()->route('home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser(Request $request)
    {
        $user_id = $request['user_id'];
        if($user_id === '') return redirect()->back()->with('notif', 'Have an error when delete user!');
        $this->accessRepo->deleteWhere(['user_id' => $user_id]);
        $this->coworkerRepo->deleteWhere(['user_id' => $user_id]);
        $this->coworkerRepo->deleteWhere(['user_co_id' => $user_id]);
        $tasks = $this->tasksRepo->findWhere(['user_id' => $user_id]);
        foreach ($tasks as $task)
        {
            $this->tasksRepo->update(['user_id' => 1], $task->id);
        }
        $todo_list = $this->todoListRepo->findByField('owner_id', $user_id);
        foreach ($todo_list as $list)
        {
            $users = $this->todoListRepo->findUserShared($list->id)->get();
            $temp = 0;
            $onew = 0;
            foreach ($users as $user)
            {
                if($user->id != $user_id) {
                    $c = $this->tasksRepo->findWhere([
                        'todo_list_id'=> $list->id,
                        'user_id' => $user->id
                    ])->count();
                    if($c > $temp && $user->id != 1) {
                        $temp = $c;
                        $onew = $user->id;
                    }
                }
            }
            if($onew == 0) {
                $this->todoListRepo->delete($list->id);
            } else {
                $this->todoListRepo->update(['owner_id' => $onew], $list->id);
            }
        }
        $name = $this->repository->find($user_id)->name;
        $this->repository->delete($user_id);
        return redirect()->back()->with('notif', 'Delete user '.$name.' success!');
    }

    /**
     * @param Request $request
     */
    public function searchUser(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $a = '';
            $search = $request->search;
            if ($search != '') {
                $data = $this->repository->searchUser($search);
            } else {
                $data = $this->repository->allBuilder()->paginate(5);
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $user) {
                    if($user->level == User::isAdmin) $a = 'Admin';
                    else if($user->level == User::isUser) $a = 'User';
                    else $a = 'Not validate';
                    $output .= '
                        <tr>
                            <td>
                                '.$user->name.'
                            </td>
                            <td>
                                '.$user->email.'
                            </td>
                            <td>
                                '.$a.'
                            </td>
                            <td>
                                <a href="'.route('admin.list').'?user_id='.$user->id.'" class="btn btn-sm btn-primary" style="color: whitesmoke"> List joined </a>
                                <a data-index="'.$user->id.'" class="btn btn-sm btn-primary delete_u" style="color: whitesmoke"> Delete </a>
                            </td>
                        </tr>
                        ';
                }
            } else {
                $output = '<h2>No Data Found</h2>';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }
}
