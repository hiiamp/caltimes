<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TempAccess;

/**
 * Class TempAccessTransformer.
 *
 * @package namespace App\Transformers;
 */
class TempAccessTransformer extends TransformerAbstract
{
    /**
     * Transform the TempAccess entity.
     *
     * @param \App\Entities\TempAccess $model
     *
     * @return array
     */
    public function transform(TempAccess $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
