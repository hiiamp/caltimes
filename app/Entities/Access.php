<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Access.
 *
 * @package namespace App\Entities;
 */
class Access extends Model implements Transformable
{
    use TransformableTrait;

    protected $table='access';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'todo_list_id',
    ];

}
