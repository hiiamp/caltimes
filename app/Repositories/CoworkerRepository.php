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
    //
    public function findFavourites($user_id);
}
