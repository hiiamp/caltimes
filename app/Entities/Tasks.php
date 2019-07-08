<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Tasks.
 *
 * @package namespace App\Entities;
 */
class Tasks extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * define constant id user UnAssigned
     */
    const Unassigned = 1;

    protected $table='tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'content', 'user_id', 'position', 'status_id', 'important','todo_list_id',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function todo_list()
    {
        return $this->belongsTo('App\Entities\TodoList','todo_list_id','id');
    }
}
