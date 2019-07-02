<?php

namespace App\Presenters;

use App\Transformers\TodoListTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TodoListPresenter.
 *
 * @package namespace App\Presenters;
 */
class TodoListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TodoListTransformer();
    }
}
