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
        $data = Menu::all()->toHierarchy();
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
     * @param MenuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MenuRequest $request)
    {
        $input = array_filter($request->only(['parent_id', 'title', 'description', 'route', 'type', 'sort']));
        $res = Menu::query()->create($input);
        return $res ? $this->setAutoClose()->success('创建成功') : $this->error('创建失败');
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
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MenuRequest $request, $id)
    {
        $input = $request->only(['parent_id', 'title', 'description', 'route', 'type', 'sort']);
        $res = Menu::query()->findOrFail($id)->update($input);
        return $res ? $this->setAutoClose()->success('修改成功') : $this->error('修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Menu::query()->findOrFail($id)->delete();
        return $this->success('删除成功');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTree(Request $request)
    {
        $data = [];
        $query = Menu::query();
        $id = intval($request->input('id'));
        if ($id) {
            $item = Menu::query()->findOrFail($id);
            $data['path'] = $item->getPath();
            $data['children'] = $item->getChildrenAndSelf();
            $query = $query->whereNotIn('id', $data['children']);
        }
        $data['tree'] = $query->get()->toHierarchy()->values();
        return $this->setParams($data)->success('获取成功');
    }
}
