<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CoworkerRepository.
 *
 * @package namespace App\Repositories;
 */
interface CoworkerRepository extends RepositoryInterface
{
    /**
     * @param $user_id
     * @return list favourite co-worker
     */
    public function findFavourites($user_id);
}
