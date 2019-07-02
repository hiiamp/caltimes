<?php

namespace App\Presenters;

use App\Transformers\AccessTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AccessPresenter.
 *
 * @package namespace App\Presenters;
 */
class AccessPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AccessTransformer();
    }
}
