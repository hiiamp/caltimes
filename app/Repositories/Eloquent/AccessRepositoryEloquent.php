<?php

namespace App\Repositories\Eloquent;

use App\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AccessRepository;
use App\Entities\Access;
use App\Validators\AccessValidator;

/**
 * Class AccessRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AccessRepositoryEloquent extends BaseRepository implements AccessRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Access::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AccessValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function create(array $data)
    {
        $model = $this->model->newInstance($data);
        $model->save();
        $this->resetModel();
    }

    public function checkAcsExist($id, $idlist)
    {
        $accesses = Access::where('user_id', $id)->get();
        foreach ($accesses as $access)
        {
            if($access->todo_list_id == $idlist) return true;
        }
        return false;
    }
}
