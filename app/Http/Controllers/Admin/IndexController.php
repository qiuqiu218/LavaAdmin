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
                    ->orderBy('id', 'asc')
                    ->get();
        return $this->view([
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main()
    {
        return $this->view();
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
                            ->orderBy('id', 'asc')
                            ->first();
            if ($first) {
                $parent_id = $first->id;
            }
        }
        if ($parent_id) {
            $data = Menu::findOrFail($parent_id)->getDescendants()->toHierarchy();
        }
        return $this->view([
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function successView()
    {
        return $this->view();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function errorView()
    {
        return $this->view();
    }
}
