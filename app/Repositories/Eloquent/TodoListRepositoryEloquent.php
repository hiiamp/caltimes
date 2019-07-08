<?php

namespace App\Repositories\Eloquent;

use App\Entities\Access;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TodoListRepository;
use App\Entities\TodoList;
use App\Validators\TodoListValidator;

/**
 * Class TodoListRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TodoListRepositoryEloquent extends BaseRepository implements TodoListRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TodoList::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TodoListValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function create(array $data)
    {
        $model = $this->model->newInstance($data);
        $model->save();
        $this->resetModel();
    }

    public function findListCanView($id)
    {
        //$lists = TodoList::where('owner_id', $id);
        $lists = TodoList::select('todo_list.id', 'is_public', 'link', 'todo_list.name', 'owner_id', 'todo_list.created_at')->join('access', 'todo_list.id', '=', 'todo_list_id')
            ->where('access.user_id',$id)->where('todo_list.isDeleted', false)->orderByRaw('todo_list.created_at DESC');
        //$data['listshare'] = $listshare;
        return $lists;
    }

    public function findOwner($id)
    {
        $owner = User::where('id', $id)->first();
        return $owner->name;
    }

    public function addAccess($data)
    {
        return Access::create($data);
    }

    public function searchList($search)
    {
        return TodoList::where('name', 'like', '%' . $search . '%')->where('isDeleted', false)->get();
    }

    public function findUserShared($id_list)
    {
        $users = User::select('users.id', 'name', 'email', 'level')->join('access', 'users.id', '=', 'user_id')->where('todo_list_id', $id_list);
        return $users;
    }

    public function allBuider($columns = ['*'])
    {
        return TodoList::where('id','>',0);
    }

    public function changeIsPublicList($id)
    {
        $list = TodoList::where('id', $id)->first();
        if($list->is_public==0){
            TodoList::where('id', $id)->update(['is_public' => 1]);
        } else {
            TodoList::where('id', $id)->update(['is_public' => 0]);
        }
    }

    public function findListInRecycle($user_id)
    {
        return TodoList::where('owner_id', $user_id)->where('isDeleted', true)->get();
    }
}
