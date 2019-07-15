<?php

namespace App\Http\Controllers\Client;

use App\Entities\User;
use App\Mail\ShareListEmail;
use App\Repositories\TempAccessRepository;
use App\Repositories\TodoListRepository;
use App\Notifications\RepliedToThread;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AccessCreateRequest;
use App\Http\Requests\AccessUpdateRequest;
use App\Repositories\AccessRepository;
use App\Validators\AccessValidator;
use App\Http\Controllers\Controller;

/**
 * Class AccessesController.
 *
 * @package namespace App\Http\Controllers;
 */
class AccessesController extends Controller
{
    /**
     * @var AccessRepository
     */
    protected $repository;

    /**
     * @var TodoListRepository
     */
    protected $listRepo;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * @var AccessValidator
     */
    protected $validator;

    /**
     * @var
     */
    protected $todolistRepo;

    /**
     * @var TempAccessRepository
     */
    protected $tempAccessRepo;
    /**
     * AccessesController constructor.
     *
     * @param AccessRepository $repository
     * @param AccessValidator $validator
     */
    public function __construct(AccessRepository $repository, AccessValidator $validator,
        TodoListRepository $listRepo, UserRepository $userRepo, TempAccessRepository $tempAccessRepo)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->listRepo = $listRepo;
        $this->userRepo = $userRepo;
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
        $accesses = $this->repository->all();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $accesses,
            ]);
        }
        return view('accesses.index', compact('accesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AccessCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AccessCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $access = $this->repository->create($request->all());

            $response = [
                'message' => 'Access created.',
                'data'    => $access->toArray(),
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
        $access = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $access,
            ]);
        }

        return view('accesses.show', compact('access'));
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
        $access = $this->repository->find($id);

        return view('accesses.edit', compact('access'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AccessUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AccessUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $access = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Access updated.',
                'data'    => $access->toArray(),
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
                'message' => 'Access deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Access deleted.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createShare(Request $request)
    {
        if(isset($request['email']) && isset($request['todo_list_id'])) {
            $email = $request['email'];
            $todo_list_id = $request['todo_list_id'];
        }
        else {
            return redirect()->back()->with('notif', 'There was an error when you shared the list.');
        }
        $list = $this->listRepo->find($todo_list_id);
        $user = $this->repository->findUserByEmail($email);
        if($user == null) {
            if($this->tempAccessRepo->findWhere(['email' => $email, 'todo_list_id' => $todo_list_id])->count()) {
                return redirect()->back()->with('message1','We sent a email to '.$email.' before, this list will share for this user when she/he create account.');
            } else {
                $this->tempAccessRepo->create([
                    'email' => $email,
                    'todo_list_id' => $todo_list_id
                ]);
            }
            $code = $list->link;
            $status = 'private';
            if($list->is_public) $status = 'public';
            $letter = new ShareListEmail(route('link.board', $code), Auth::user()->name, $status);
            Mail::to($email)->send($letter);
            return redirect()->back()->with('message1','Email don\'t match any account! So we sent a email instead.');
        }
        if($user->id == Auth::user()->id) {
            return redirect()->back()->with('message1','Can\'t share for yourself!');
        }
        if($user->level == User::isBlocked) {
            return redirect()->back()->with('message1','This account is deleted/banned!');
        }
        $user_id = $user->id;
        $name = $user->name;
        if($this->repository->checkAcsExist($user_id, $todo_list_id)) {
            return redirect()->back()->with('message1', 'User '.$name.' is shared this list before!');
        }
        $own_user = $this->userRepo->find(Auth::user()->id);
        $this->repository->create([
            'todo_list_id' => $todo_list_id,
            'user_id' => $user_id
        ]);
        $task = [
            'id'   => '0',
            'name' => 'null',
            'content' => 'null',
            'user_id' => 'null',
            'created_at' => Carbon::now(),
        ];
        $users = $this->userRepo->notiUser($todo_list_id);
        Notification::send($users,new RepliedToThread($list,$task,'share',$own_user));
        return redirect()->back()->with('message1', 'This todo list is shared with '.$name);
    }

    /**
     * @param Request $request: todo_list_id + user_id
     * sql=> share <--> not share per call
     */
    public function toggleShareList(Request $request)
    {
        if($request->ajax()){
            if(isset($request['todo_list_id'])&&isset($request['user_id'])) {
                $todo_list_id = $request['todo_list_id'];
                $user_id = $request['user_id'];
            }
            else {
                return redirect()->back()->with('notif', 'There was an error when you toggle the list.');
            }
            $acs = $this->repository->findWhere(['todo_list_id' => $todo_list_id, 'user_id' => $user_id]);
            if($acs->count() != 0) {
                $this->repository->delete($acs->first()->id);
            }
            else {
                $this->repository->create([
                    'todo_list_id' => $todo_list_id,
                    'user_id' => $user_id
                ]);
            }
        }
    }

    /**
     * @param Request $request: todo_list_id
     * @return \Illuminate\Http\RedirectResponse
     * delete access to list of current user
     */
    public function outList(Request $request)
    {
        if(isset($request['todo_list_id'])) {
            $todo_list_id = $request['todo_list_id'];
        }
        else {
            return redirect()->back()->with('notif', 'There was an error when you leave the list.');
        }
        $name = $this->todolistRepo->find($todo_list_id)->name;
        $acs = $this->repository->findWhere([
            'todo_list_id' => $todo_list_id,
            'user_id' => Auth::user()->id
        ]);
        if($acs->count() != 0) {
            $this->repository->delete($acs->first()->id);
        }
        return redirect()->route('home')->with('notif', 'You leaved '.$name.'!');
    }
}
