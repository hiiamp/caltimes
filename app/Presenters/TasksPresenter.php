<?php

namespace App\Presenters;

use App\Transformers\TasksTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TasksPresenter.
 *
 * @package namespace App\Presenters;
 */
class TasksPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TasksTransformer();
    }
}
