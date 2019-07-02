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
    public function getTaskByIdList($id);

    public function searchTask($search,$todo_list_id);
}
