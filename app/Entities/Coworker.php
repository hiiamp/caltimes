<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Coworker.
 *
 * @package namespace App\Entities;
 */
class Coworker extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'coworkers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_co_id'
    ];

}
