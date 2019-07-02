<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($id)
    {
        $token = $this->getToken();
        User::where('id', $id)->update([
            'remember_token' => $token,
            'updated_at' => new Carbon()
        ]);
        return $token;
    }

    public function find($id, $columns = ['*'])
    {
        return User::where('id', $id)->first();
    }

    public function findCoWorker($id)
    {
        $users = User::select('todo_list.id', 'users.name', 'email', 'level')->join('access', 'users.id', '=', 'user_id')
            ->join('todo_list', 'access.todo_list_id', '=', 'todo_list.id')
            ->where('todo_list.owner_id', $id)->where('users.id', '!=', $id);
        return $users;
    }

    public function allBuilder($columns = ['*'])
    {
        return User::where('id', '>', 0);
    }

    public function searchUser($search)
    {
        return User::where('name', 'like', '%' . $search . '%')->get();
    }
}
