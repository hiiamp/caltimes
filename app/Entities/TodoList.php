<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TodoList.
 *
 * @package namespace App\Entities;
 */
class TodoList extends Model implements Transformable
{
    use TransformableTrait;

    protected $table='todo_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'link', 'owner_id', 'is_public', 'isDeleted'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public static function findTodoListByLink($code)
    {
        return TodoList::where('link', $code)->first();
    }

    public function tasks()
    {
        return $this->hasMany('App\Entities\Tasks','todo_list_id','id');
    }

}
