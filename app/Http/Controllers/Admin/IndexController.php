<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = Menu::query()
                    ->whereNull('parent_id')
                    ->orderBy('sort', 'asc')
                    ->orderBy('id', 'asc')
                    ->get();
        return view('admin.index.index', [
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main()
    {
        return view('admin.index.main');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sidebar(Request $request)
    {
        $data = array();
        $parent_id = intval($request->input('parent_id'));
        if (!$parent_id) {
            $first = Menu::query()
                            ->whereNull('parent_id')
                            ->orderBy('sort', 'asc')
                            ->orderBy('id', 'asc')
                            ->first();
            if ($first) {
                $parent_id = $first->id;
            }
        }
        if ($parent_id) {
            $data = Menu::findOrFail($parent_id)->getDescendants()->toHierarchy();
        }
        return view('admin.index.sidebar', [
            'data' => $data
        ]);
    }
}
