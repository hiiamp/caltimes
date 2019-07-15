<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TempAccess.
 *
 * @package namespace App\Entities;
 */
class TempAccess extends Model implements Transformable
{
    use TransformableTrait;

    protected $table='temp_accesses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'todo_list_id'
    ];

}
