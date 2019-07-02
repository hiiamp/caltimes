<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AccessRepository.
 *
 * @package namespace App\Repositories;
 */
interface AccessRepository extends RepositoryInterface
{
    //
    public function findUserByEmail($email);

    public function create(array $data);

    public function checkAcsExist($id, $idlist);
}
