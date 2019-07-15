<?php

namespace App\Presenters;

use App\Transformers\TempAccessTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TempAccessPresenter.
 *
 * @package namespace App\Presenters;
 */
class TempAccessPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TempAccessTransformer();
    }
}
