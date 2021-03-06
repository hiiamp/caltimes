<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TasksRepository;
use App\Entities\Tasks;
use App\Validators\TasksValidator;

/**
 * Class TasksRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TasksRepositoryEloquent extends BaseRepository implements TasksRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tasks::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TasksValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTaskByIdList($id)
    {
        return Tasks::where('todo_list_id', $id)->orderBy('position')->get();
    }

    /**
     * @param $search
     * @param $todo_list_id
     * @return mixed
     */
    public function searchTask($search,$todo_list_id)
    {
        return Tasks::where('name', 'like', '%'.$search.'%')->where('todo_list_id','=',$todo_list_id)->get();
    }

    public function checkName($todo_list_id,$name)
    {
        return Tasks::where('todo_list_id','=',$todo_list_id)->where('name', '=', $name)->get();
    }
}
