<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Admin\PermissionClassify;
use Illuminate\Http\Request;
use App\Models\Admin\Permission;

class PermissionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guard_name = $request->input('guard_name');
        $data = Permission::query()
                            ->with('permission_classify')
                            ->where('permission_classify_id', '<>', Permission::findByClassifyId('菜单管理'))
                            ->orderBy('sort')
                            ->get();
        return view('admin.permission.index', [
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
        $classify = PermissionClassify::query()->orderBy('sort')->get();
        $guard_name = $request->input('guard_name');
        return view('admin.permission.create', [
            'guard_name' => $guard_name,
            'classify' => $classify
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->only('name', 'display_name', 'guard_name', 'sort', 'permission_classify_id');
        $res = Permission::query()->create($input);
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
        $classify = PermissionClassify::query()->orderBy('sort')->get();
        $data = Permission::query()->findOrFail($id);
        return view('admin.permission.edit', [
            'data' => $data,
            'classify' => $classify
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->only('name', 'display_name', 'sort', 'permission_classify_id');
        $res = Permission::query()->findOrFail($id)->update($input);
        return $res ? $this->setAutoClose()->success('更新成功') : $this->error('更新失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $res = Permission::query()->findOrFail($id)->delete();
        return $res ? $this->success('删除成功') : $this->error('删除失败');
    }
}
