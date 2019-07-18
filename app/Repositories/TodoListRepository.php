<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TodoListRepository.
 *
 * @package namespace App\Repositories;
 */
interface TodoListRepository extends RepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id (user)
     * @return lists user can view
     */
    public function findListCanView($id);

    /**
     * @param $id (list)
     * @return find user who owner list
     */
    public function findOwner($id);

    /**
     * @param $data
     * @return access which created now
     */
    public function addAccess($data);

    /**
     * @param $search
     * @return mixed
     */
    public function searchList($search, $perpage, $page);

    /**
     * @param $id_list
     * @return mixed
     */
    public function findUserShared($id_list);

    /**
     * @param array $columns
     * @return mixed
     */
    public function allBuider($columns = ['*']);

    /**
     * @param $id
     * @return mixed
     */
    public function changeIsPublicList($id);

    /**
     * @param $user_id
     * @return mixed
     */
    public function findListInRecycle($user_id);

    /**
     * @param $noti_id
     * @return mixed
     */
    public function maskAsReadNoti($noti_id);
}
