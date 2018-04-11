<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ResJson;
use App\Traits\Tools\Resource;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    use ResJson, Resource;

    public function __construct()
    {
        View::share('controller', $this->getController());
    }
}
