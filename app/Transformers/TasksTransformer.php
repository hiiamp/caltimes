<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Tasks;

/**
 * Class TasksTransformer.
 *
 * @package namespace App\Transformers;
 */
class TasksTransformer extends TransformerAbstract
{
    /**
     * Transform the Tasks entity.
     *
     * @param \App\Entities\Tasks $model
     *
     * @return array
     */
    public function transform(Tasks $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
