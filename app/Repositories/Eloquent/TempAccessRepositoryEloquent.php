<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TempAccessRepository;
use App\Entities\TempAccess;
use App\Validators\TempAccessValidator;

/**
 * Class TempAccessRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TempAccessRepositoryEloquent extends BaseRepository implements TempAccessRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TempAccess::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TempAccessValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
