<?php

namespace App\Repositories\Eloquent;

use App\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\coworkerRepository;
use App\Entities\Coworker;
use App\Validators\CoworkerValidator;

/**
 * Class CoworkerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CoworkerRepositoryEloquent extends BaseRepository implements CoworkerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Coworker::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CoworkerValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $user_id
     * @return list favourite co-worker
     */
    public function findFavourites($user_id)
    {
        return User::select('users.id', 'name', 'email')->join('coworkers', 'user_co_id', '=', 'users.id')->where('user_id', $user_id);
    }
}
