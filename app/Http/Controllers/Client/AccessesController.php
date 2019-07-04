<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AccessCreateRequest;
use App\Http\Requests\AccessUpdateRequest;
use App\Repositories\AccessRepository;
use App\Validators\AccessValidator;

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
     * @var AccessValidator
     */
    protected $validator;

    /**
     * AccessesController constructor.
     *
     * @param AccessRepository $repository
     * @param AccessValidator $validator
     */
    public function __construct(AccessRepository $repository, AccessValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
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
        $email = $request['email'];
        $todo_list_id = $request['todo_list_id'];
        $user = $this->repository->findUserByEmail($email);
        if($user == null){
            return redirect()->back()->with('message1','Email don\'t exist!');
        }
        if($user->id == Auth::user()->id){
            return redirect()->back()->with('message1','Can\'t share for yourself!');
        }

        $user_id = $user->id;
        $name = $user->name;
        if($this->repository->checkAcsExist($user_id, $todo_list_id)){
            return redirect()->back()->with('message1', 'User '.$name.' is shared this list before!');
        }
        $this->repository->create([
            'todo_list_id' => $todo_list_id,
            'user_id' => $user_id
        ]);
        return redirect()->back()->with('message1', 'This todo list is shared with '.$name);
    }
}
