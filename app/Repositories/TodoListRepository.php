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
    //
    public function create(array $data);

    public function findListCanView($id);

    public function findOwner($id);

    public function addAccess($data);

    public function searchList($search);

    public function findUserShared($id_list);

    public function allBuider($columns = ['*']);

    public function changeIsPublicList($id);
}
