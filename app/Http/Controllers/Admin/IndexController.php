<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu()
    {
        return view('admin.index.menu');
    }
}
