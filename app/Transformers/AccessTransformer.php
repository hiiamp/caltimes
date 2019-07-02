<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Access;

/**
 * Class AccessTransformer.
 *
 * @package namespace App\Transformers;
 */
class AccessTransformer extends TransformerAbstract
{
    /**
     * Transform the Access entity.
     *
     * @param \App\Entities\Access $model
     *
     * @return array
     */
    public function transform(Access $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
