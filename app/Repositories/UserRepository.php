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
    //
    public function getToken();

    public function createActivation($id);

    public function find($id, $columns = ['*']);

    public function findCoWorker($id);

    public function allBuilder($columns = ['*']);
}
