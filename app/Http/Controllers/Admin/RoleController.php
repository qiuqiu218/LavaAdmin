<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Menu;
use App\Models\PermissionClassify;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    protected $model = null;

    public function __construct()
    {
        $this->model = new Role();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guard_name = $request->input('guard_name', 'admin');
        $data = $this->model->where('guard_name', $guard_name)->get();
        return view('admin.role.index', [
            'data' => $data,
            'guard_name' => $guard_name
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $guard_name = $request->input('guard_name');
        return view('admin.role.create', [
            'guard_name' => $guard_name
        ]);
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request)
    {
        $input = $request->only('name', 'display_name', 'guard_name');
        $res = Role::query()->create($input);
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
        $data = Role::query()->findOrFail($id);
        return view('admin.role.edit', [
            'data' => $data
        ]);
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleRequest $request, $id)
    {
        $input = $request->only('name', 'display_name');
        $res = Role::query()->findOrFail($id)->update($input);
        return $res ? $this->setAutoClose()->success('更新成功') : $this->error('更新失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $res = Role::query()->findOrFail($id)->delete();
        return $res ? $this->setAutoClose()->success('删除成功') : $this->error('删除失败');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function permission(Request $request, $id)
    {
        if ($request->method() === 'GET') {
            // 获取该角色所有的权限
            $permission = Role::getPermission($id);
            // 根据分类获取所有权限列表
            $data = PermissionClassify::getAllPermission();
            foreach ($data as $classify) {
                foreach ($classify->permission as $item) {
                    $item->checked = in_array($item->name, $permission);
                }
            }

            $menu = Menu::all();
            foreach ($menu as $item) {
                $item->checked = in_array('menu_'.$item->id, $permission);
            }
            $menu = $menu->toHierarchy();

            return view('admin.role.permission', [
                'data' => $data,
                'id' => $id,
                'menu' => $menu
            ]);
        } else {
            $role = Role::query()->findOrFail($id);
            $res = $role->syncPermissions($request->input('permission'));
            return $res ? $this->setAutoClose()->success() : $this->error();
        }
    }
}
