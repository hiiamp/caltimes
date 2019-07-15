<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CoworkerCreateRequest;
use App\Http\Requests\CoworkerUpdateRequest;
use App\Repositories\CoworkerRepository;
use App\Validators\CoworkerValidator;
use App\Http\Controllers\Controller;

/**
 * Class CoworkersController.
 *
 * @package namespace App\Http\Controllers;
 */
class CoworkersController extends Controller
{
    /**
     * @var CoworkerRepository
     */
    protected $repository;

    /**
     * @var CoworkerValidator
     */
    protected $validator;

    /**
     * CoworkersController constructor.
     *
     * @param CoworkerRepository $repository
     * @param CoworkerValidator $validator
     */
    public function __construct(CoworkerRepository $repository, CoworkerValidator $validator)
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
        $coworkers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $coworkers,
            ]);
        }

        return view('coworkers.index', compact('coworkers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CoworkerCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CoworkerCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $coworker = $this->repository->create($request->all());

            $response = [
                'message' => 'Coworker created.',
                'data'    => $coworker->toArray(),
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
        $coworker = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $coworker,
            ]);
        }

        return view('coworkers.show', compact('coworker'));
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
        $coworker = $this->repository->find($id);

        return view('coworkers.edit', compact('coworker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CoworkerUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CoworkerUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $coworker = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Coworker updated.',
                'data'    => $coworker->toArray(),
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
                'message' => 'Coworker deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Coworker deleted.');
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function toggleCoWorker(Request $request)
    {
        if($request->ajax()) {
            if(isset($request['user_co_id'])) {
                $user_co_id = $request['user_co_id'];
            } else {
                return redirect()->back()->with('notif', 'There was an error when you performed this operation.');
            }
            if($user_co_id == Auth::user()->id) return json_encode(['status1' => 'error']);
            $check = $this->repository->findWhere([
                'user_id' => Auth::user()->id,
                'user_co_id' => $user_co_id
            ])->count();
            if($check == 0) {
                $this->repository->create([
                    'user_id' => Auth::user()->id,
                    'user_co_id' => $user_co_id
                ]);
                return json_encode(['status1' => 'add']);
            } else {
                $id = $this->repository->findWhere([
                    'user_id' => Auth::user()->id,
                    'user_co_id' => $user_co_id
                ])->first()->id;
                $this->repository->delete($id);
                return json_encode(['status1' => 'remove']);
            }
        }
    }
}
