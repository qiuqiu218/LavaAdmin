<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ResJson;
use App\Http\Controllers\Traits\Tools;

class BaseController extends Controller
{
    use ResJson, Tools;
}
