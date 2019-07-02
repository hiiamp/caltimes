<?php

namespace App\Presenters;

use App\Transformers\ListTaskTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ListTaskPresenter.
 *
 * @package namespace App\Presenters;
 */
class ListTaskPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ListTaskTransformer();
    }
}
