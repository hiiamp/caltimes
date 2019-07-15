<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TempAccessCreateRequest;
use App\Http\Requests\TempAccessUpdateRequest;
use App\Repositories\TempAccessRepository;
use App\Validators\TempAccessValidator;
use App\Http\Controllers\Controller;

/**
 * Class TempAccessesController.
 *
 * @package namespace App\Http\Controllers;
 */
class TempAccessesController extends Controller
{
    /**
     * @var TempAccessRepository
     */
    protected $repository;

    /**
     * @var TempAccessValidator
     */
    protected $validator;

    /**
     * TempAccessesController constructor.
     *
     * @param TempAccessRepository $repository
     * @param TempAccessValidator $validator
     */
    public function __construct(TempAccessRepository $repository, TempAccessValidator $validator)
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
        $tempAccesses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tempAccesses,
            ]);
        }

        return view('tempAccesses.index', compact('tempAccesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TempAccessCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TempAccessCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tempAccess = $this->repository->create($request->all());

            $response = [
                'message' => 'TempAccess created.',
                'data'    => $tempAccess->toArray(),
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
        $tempAccess = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tempAccess,
            ]);
        }

        return view('tempAccesses.show', compact('tempAccess'));
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
        $tempAccess = $this->repository->find($id);

        return view('tempAccesses.edit', compact('tempAccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TempAccessUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TempAccessUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tempAccess = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TempAccess updated.',
                'data'    => $tempAccess->toArray(),
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
                'message' => 'TempAccess deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TempAccess deleted.');
    }
}
