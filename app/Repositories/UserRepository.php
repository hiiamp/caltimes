<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getToken();

    /**
     * @param $id
     * @return mixed
     */
    public function createActivation($id);

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param $id
     * @return mixed
     */
    public function findCoWorker($id);

    /**
     * @param array $columns
     * @return mixed
     */
    public function allBuilder($columns = ['*']);

    /**
     * @param $search
     * @return mixed
     */
    public function searchUser($search, $perpage = 5, $page = 1);

    /**
     * @param $todo_list_id
     * @return mixed
     */
    public function notiUser($todo_list_id);

    /**
     * @param $user_id
     * @return mixed
     */
    public function countNoti($user_id);
}
