<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TodoList;

/**
 * Class TodoListTransformer.
 *
 * @package namespace App\Transformers;
 */
class TodoListTransformer extends TransformerAbstract
{
    /**
     * Transform the TodoList entity.
     *
     * @param \App\Entities\TodoList $model
     *
     * @return array
     */
    public function transform(TodoList $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
