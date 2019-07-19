<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusCreateRequest;
use App\Http\Requests\StatusUpdateRequest;
use App\Repositories\StatusRepository;
use App\Validators\StatusValidator;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
        $this->validator = $validator;
    }
}
