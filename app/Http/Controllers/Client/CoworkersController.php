<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoworkerCreateRequest;
use App\Http\Requests\CoworkerUpdateRequest;
use App\Repositories\CoworkerRepository;
use App\Validators\CoworkerValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function toggleCoWorker(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request['user_co_id'])) {
                $user_co_id = $request['user_co_id'];
            } else {
                return redirect()->back()->with('notif', 'There was an error when you performed this operation.');
            }
            if ($user_co_id == Auth::user()->id) return json_encode(['status1' => 'error']);
            $check = $this->repository->findWhere([
                'user_id' => Auth::user()->id,
                'user_co_id' => $user_co_id
            ])->count();
            if ($check == 0) {
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
