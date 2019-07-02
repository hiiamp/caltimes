<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Status;

/**
 * Class StatusTransformer.
 *
 * @package namespace App\Transformers;
 */
class StatusTransformer extends TransformerAbstract
{
    /**
     * Transform the Status entity.
     *
     * @param \App\Entities\Status $model
     *
     * @return array
     */
    public function transform(Status $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
