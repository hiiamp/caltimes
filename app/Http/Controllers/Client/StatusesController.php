<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StatusCreateRequest;
use App\Http\Requests\StatusUpdateRequest;
use App\Repositories\StatusRepository;
use App\Validators\StatusValidator;
use App\Http\Controllers\Controller;

/**
 * Class StatusesController.
 *
 * @package namespace App\Http\Controllers;
 */
class StatusesController extends Controller
{
    /**
     * @var StatusRepository
     */
    protected $repository;

    /**
     * @var StatusValidator
     */
    protected $validator;

    /**
     * StatusesController constructor.
     *
     * @param StatusRepository $repository
     * @param StatusValidator $validator
     */
    public function __construct(StatusRepository $repository, StatusValidator $validator)
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
        $statuses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $statuses,
            ]);
        }

        return view('statuses.index', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StatusCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StatusCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $status = $this->repository->create($request->all());

            $response = [
                'message' => 'Status created.',
                'data'    => $status->toArray(),
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
        $status = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $status,
            ]);
        }

        return view('statuses.show', compact('status'));
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
        $status = $this->repository->find($id);

        return view('statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StatusUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StatusUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $status = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Status updated.',
                'data'    => $status->toArray(),
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
                'message' => 'Status deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Status deleted.');
    }
}
