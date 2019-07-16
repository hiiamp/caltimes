<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TasksRepository.
 *
 * @package namespace App\Repositories;
 */
interface TasksRepository extends RepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getTaskByIdList($id);

    /**
     * @param $search
     * @param $todo_list_id
     * @return mixed
     */
    public function searchTask($search,$todo_list_id);

    public function checkName($todo_list_id,$name);
}
