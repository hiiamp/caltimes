<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    //constant
    const isAdmin = 2;

    const isUser = 1;

    const isNotActive = 0;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
