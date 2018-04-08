<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    /**
     * 实例化一个新的控制器实例。
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:menu_create')->only(['create', 'store']);
        $this->middleware('permission:menu_edit')->only(['edit', 'update']);
        $this->middleware('permission:menu_delete')->only('destroy');
    }

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
        $node = Menu::query()->findOrFail($id);
        $res = $node->update($input);
        return $res ? $this->setAutoClose()->success('修改成功') : $this->error('修改失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
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
