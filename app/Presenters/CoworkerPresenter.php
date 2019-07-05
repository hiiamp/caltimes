<?php

namespace App\Presenters;

use App\Transformers\CoworkerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CoworkerPresenter.
 *
 * @package namespace App\Presenters;
 */
class CoworkerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CoworkerTransformer();
    }
}
