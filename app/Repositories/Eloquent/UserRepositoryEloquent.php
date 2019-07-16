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

    /**
     * @return mixed|string
     */
    public function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    /**
     * @param $id
     * @return mixed|string
     * @throws \Exception
     */
    public function createActivation($id)
    {
        $token = $this->getToken();
        User::where('id', $id)->update([
            'remember_token' => $token,
            'updated_at' => new Carbon()
        ]);
        return $token;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return User::where('id', $id)->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCoWorker($id)
    {
        return User::select('todo_list.id', 'users.name', 'email', 'level')->join('access', 'users.id', '=', 'user_id')
            ->join('todo_list', 'access.todo_list_id', '=', 'todo_list.id')
            ->where('todo_list.owner_id', $id)->where('users.id', '!=', $id);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function allBuilder($columns = ['*'])
    {
        return User::where('id', '>', 1);
    }

    /**
     * @param $search
     * @return mixed
     */
    public function searchUser($search, $perpage = 5, $page = 1)
    {
        if($page == 1) $perpage++;
        return User::where('name', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . strtolower($search) . '%')
            ->orWhere('name', 'like', '%' . ucwords($search) . '%')->offset($perpage*($page-1))->limit($perpage)->get();
    }

    /**
     * @param $todo_list_id
     * @return mixed
     */
    public function notiUser($todo_list_id)
    {
        $users = User::select('users.id','users.name')->join('access', 'users.id', '=', 'user_id')
            ->where('access.todo_list_id', $todo_list_id)->get();
        return $users;
    }
}
