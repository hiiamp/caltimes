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
    /**
     * @param $email
     * @return mixed
     */
    public function findUserByEmail($email);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @param $idlist
     * @return mixed
     */
    public function checkAcsExist($id, $idlist);
}
