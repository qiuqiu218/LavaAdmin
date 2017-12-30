<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Menu::all()->toHierarchy()->values();
        return view('admin.menu.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = config('enum.Menu.type');
        return view('admin.menu.create', ['type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $input = array_filter($request->only(['parent_id', 'title', 'description', 'route', 'type', 'sort']));
        Menu::query()->create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Menu::query()->findOrFail($id);
        $type = config('enum.Menu.type');
        return view('admin.menu.edit', [
            'data' => $data,
            'type' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MenuRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $input = array_filter($request->only(['parent_id', 'title', 'description', 'route', 'type', 'sort']));
        Menu::query()->findOrFail($id)->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTree(Request $request)
    {
        $data = [];
        $id = intval($request->input('id'));
        if ($id) {
            $item = Menu::query()->findOrFail($id);
            $data['path'] = $item->getPath();
        }
        $data['tree'] = Menu::all()->toHierarchy()->values();
        return $this->setParams($data)->success('获取成功');
    }
}
