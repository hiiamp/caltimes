<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\TempAccessCreateRequest;
use App\Http\Requests\TempAccessUpdateRequest;
use App\Repositories\TempAccessRepository;
use App\Validators\TempAccessValidator;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
        $this->validator = $validator;
    }
}
