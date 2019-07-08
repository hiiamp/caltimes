<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Status.
 *
 * @package namespace App\Entities;
 */
class Status extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * define constant to show status of each tasks
     */
    const isToDo = 1;
    const isInProcess = 2;
    const isDone = 3;

    protected $table='status';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    public function tasks(){
        return $this->hasMany('App\Entities\Tasks','status_id','id');
    }
}
