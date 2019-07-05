<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Coworker;

/**
 * Class CoworkerTransformer.
 *
 * @package namespace App\Transformers;
 */
class CoworkerTransformer extends TransformerAbstract
{
    /**
     * Transform the Coworker entity.
     *
     * @param \App\Entities\Coworker $model
     *
     * @return array
     */
    public function transform(Coworker $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
