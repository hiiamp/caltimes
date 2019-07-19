<?php

namespace App\Http\Controllers\Client;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Mail\UserResetPassEmail;
use App\Repositories\AccessRepository;
use App\Repositories\CoworkerRepository;
use App\Repositories\TasksRepository;
use App\Repositories\TempAccessRepository;
use App\Repositories\TodoListRepository;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


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

    /**
     * @var TasksRepository
     */
    protected $tasksRepo;

    /**
     * @var AccessRepository
     */
    protected $accessRepo;

    /**
     * @var TodoListRepository
     */
    protected $todoListRepo;

    /**
     * @var CoworkerRepository
     */
    protected $coworkerRepo;

    /**
     * @var TempAccessRepository
     */
    protected $tempAccessRepo;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator, TasksRepository $tasksRepo, AccessRepository $accessRepo,
                                TodoListRepository $todoListRepo, CoworkerRepository $coworkerRepo, TempAccessRepository $tempAccessRepo)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->tasksRepo = $tasksRepo;
        $this->accessRepo = $accessRepo;
        $this->todoListRepo = $todoListRepo;
        $this->coworkerRepo = $coworkerRepo;
        $this->tempAccessRepo = $tempAccessRepo;
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function manageUser(Request $request)
    {
        $check1 = 0;
        if (Auth::user()->level == User::isAdmin) {
            if (isset($request['list_id'])) {
                $list_id = $request['list_id'];
            } else {
                $list_id = null;
            }
            if ($list_id != null) {
                $temp = null;
                $temp = $this->todoListRepo->find($list_id);
                if ($temp == null) {
                    $users = $this->repository->allBuilder()->paginate(5);
                    $users->name_table = 'All User';
                } else {
                    $users = $this->todoListRepo->findUserShared($list_id)->paginate(5);
                    $users->name_table = 'Worker joined: ' . $temp->name;
                    $check1 = 1;
                }
            } else {
                $users = $this->repository->allBuilder()->paginate(5);
                $users->name_table = 'All User';
            }
            $t = Auth::user()->name;
            $t = str_split($t);
            $temp1 = $t[0];
            $check = 0;
            if (is_array($t) && count($t))
                foreach ($t as $a) {
                    if ($check == 1) {
                        $temp1 .= $a;
                        $check = 0;
                    } else if ($a == ' ') $check = 1;
                }
            if ($check1 == 0) {
                return view('admin.user', [
                    'users' => $users,
                    'character' => $temp1,
                ]);
            } else {
                return view('admin.user', [
                    'users' => $users,
                    'character' => $temp1,
                    'check' => $check1
                ]);
            }
        }
        return redirect()->route('home');
    }

    /**
     * @return Factory|RedirectResponse|View
     */
    public function profileUser()
    {
        if (Auth::user()->level > User::isNotActive) {
            $users = $this->repository->findCoWorker(Auth::user()->id)->paginate(5);
            foreach ($users as $u) {
                $a = $this->todoListRepo->find($u->id);
                $u->list_name = $a->name;
                $u->list_code = $a->link;
            }
            $lists = $this->todoListRepo->findListCanView(Auth::user()->id)->paginate(5);
            foreach ($lists as $list) {
                $users1 = $this->todoListRepo->findUserShared($list->id);
                $list->users = $users1;
                $user = $this->repository->find($list->owner_id);
                $list->owner = $user->name;
            }
            return view('user.profile.worker', [
                'users' => $users,
                'lists' => $lists,
            ]);
        }
        return redirect()->route('home');
    }

    /**
     * @return Factory|RedirectResponse|View
     */
    public function favoriteUser()
    {
        if (Auth::user()->level > User::isNotActive) {
            $favourites = $this->coworkerRepo->findFavourites(Auth::user()->id)->paginate(5);

            return view('user.profile.favorite', [
                'favourites' => $favourites,
            ]);
        }
        return redirect()->route('home');
    }

    public function recycleList()
    {
        if (Auth::user()->level > User::isNotActive) {
            $recycleList = $this->todoListRepo->findListInRecycle(Auth::user()->id)->paginate(5);
            if (isset($recycleList) && count($recycleList))
                foreach ($recycleList as $list) {
                    $list->numtask = count($this->tasksRepo->getTaskByIdList($list->id));
                }
            return view('user.profile.recycle', [
                'recycleList' => $recycleList
            ]);
        }
        return redirect()->route('home');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteUser(Request $request)
    {
        if (isset($request['user_id'])) {
            $user_id = $request['user_id'];
        } else {
            return redirect()->back()->with('notif', 'There was an error when you delete a user.');
        }
        $this->accessRepo->deleteWhere(['user_id' => $user_id]);
        $user_id = $request['user_id'];
        if ($user_id === '') return redirect()->back()->with('notif', 'Have an error when delete user!');
        $this->accessRepo->deleteWhere(['user_id' => $user_id]);
        $this->coworkerRepo->deleteWhere(['user_id' => $user_id]);
        $this->coworkerRepo->deleteWhere(['user_co_id' => $user_id]);
        $tasks = $this->tasksRepo->findWhere(['user_id' => $user_id]);
        if (is_array($tasks) && count($tasks))
            foreach ($tasks as $task) {
                $this->tasksRepo->update(['user_id' => 1], $task->id);
            }
        $todo_list = $this->todoListRepo->findByField('owner_id', $user_id);
        foreach ($todo_list as $list) {
            $users = $this->todoListRepo->findUserShared($list->id)->get();
            $temp = 0;
            $onew = 0;
            foreach ($users as $user) {
                if ($user->id != $user_id) {
                    $c = $this->tasksRepo->findWhere([
                        'todo_list_id' => $list->id,
                        'user_id' => $user->id
                    ])->count();
                    if ($c > $temp && $user->id != 1) {
                        $temp = $c;
                        $onew = $user->id;
                    }
                }
            }
            if ($onew == 0) {
                $this->tasksRepo->deleteWhere(['todo_list_id' => $list->id]);
                $this->accessRepo->deleteWhere(['todo_list_id' => $list->id]);
                $this->tempAccessRepo->deleteWhere(['todo_list_id' => $list->id]);
                $this->todoListRepo->delete($list->id);
            } else {
                $this->todoListRepo->update(['owner_id' => $onew], $list->id);
            }
        }
        $name = $this->repository->find($user_id)->name;
        $this->repository->delete($user_id);
        return redirect()->back()->with('notif', 'Delete user ' . $name . ' success!');
    }

    /**
     * @param Request $request
     */
    public function searchUser(Request $request)
    {
        if ($request->ajax()) {
            $search = isset($request['search']) ? $request['search'] : '';
            $page = isset($request['page']) ? $request['page'] : 1;
            if ($page < 1) $page = 1;
            $data = $this->repository->searchUser($search, 5, $page);
            while (!$data->count() && $page > 1) {
                $page--;
                $data = $this->repository->searchUser($search, 5, $page);
            }
            if (!$data->count()) {
                $output = '<h2></h2>
                               <img style="margin-left: 35%; width: 600px;height: 380px " src="' . asset('user/images/12.png') . '">';
            } else $output = view('user.render.user')->with(['users' => $data])->render();
            $data1 = array(
                'page_current' => $page,
                'table_data' => $output
            );
            echo json_encode($data1);
        }
    }

    /**
     * @param Request $request
     */
    public function changePassword(Request $request)
    {
        if ($request->ajax()) {
            $opass = '';
            $opass = $request['opass'];
            $npass = '';
            $npass = $request['npass'];
            if (Hash::check($opass, Auth::user()->getAuthPassword())) {
                $this->repository->update(['password' => Hash::make($npass)], Auth::user()->id);
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false));
            }
        }
    }

    /**
     * @param Request $request
     */
    public function checkEmail(Request $request)
    {
        if ($request->ajax()) {
            $email = '';
            $email = $request['email'];
            $user = null;
            $user = $this->repository->findByField('email', $email)->first();
            if ($user == null) {
                echo json_encode(array('success' => false));
            } else {
                echo json_encode(array('success' => true, 'name' => $user->name, 'email' => $user->email));
            }
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse|mixed
     */
    public function sendTokenResetPass(Request $request)
    {
        $email = '';
        $email = $request['email'];
        if ($email == '') return redirect()->route('welcome')->with('status', 'Have an error, sorry for this inconvenience!');
        $user = $this->repository->findByField('email', $email)->first();
        if ($user === null) return redirect()->route('welcome')->with('status', 'Have an error, sorry for this inconvenience!');
        $token = $this->repository->createActivation($user->id);
        $link = route('user.resetPassToken', $token);
        $mail = new UserResetPassEmail($link);
        Mail::to($user->email)->send($mail);
        return redirect()->route('welcome')->with('status', 'Please check mail to reset your password!');
    }

    /**
     * @param $token
     * @return Factory|RedirectResponse|View
     */
    public function tokenResetPass($token)
    {
        $user = null;
        $user = $this->repository->findByField('remember_token', $token);
        if ($user == null) return redirect()->route('welcome')->with('status', 'Have an error, sorry for this inconvenience!');
        return view('login', ['token' => $token]);
    }

    /**
     * @param Request $request
     */
    public function resetPassword(Request $request)
    {
        if ($request->ajax()) {
            $token = '';
            $token = $request['token'];
            $pass = '';
            $pass = $request['npass'];
            if ($pass == '' || $token == '') {
                echo json_encode(array('success' => false));
            }
            $user = null;
            $user = $this->repository->findByField('remember_token', $token)->first();
            if ($user == null) {
                echo json_encode(array('success' => false));
            }
            $level = $user->level;
            if ($user->level == 0) {
                $level = 1;
            }
            $this->repository->update([
                'level' => $level,
                'remember_token' => '',
                'password' => Hash::make($pass)
            ], $user->id);
            echo json_encode(array('success' => true, 'name' => $user->name, 'email' => $user->email));
        }
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function toggleVip(Request $request)
    {
        if ($request->ajax()) {
            $user_id = isset($request['user_id']) ? $request['user_id'] : 0;
            if ($user_id == 0) {
                return json_encode(array('success' => false, 'vip' => 0));
            }
            $user = $this->repository->find($user_id);
            $temp = ($user->isVip) ? false : true;
            $this->repository->update(['isVip' => $temp], $user->id);
            $user = $this->repository->find($user_id);
            return json_encode(array('success' => true, 'vip' => $user->isVip));
        }
    }
}
