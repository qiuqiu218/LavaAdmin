<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ResJson;
use App\Traits\Tools\Resource;

class BaseController extends Controller
{
    use ResJson, Resource;
}
