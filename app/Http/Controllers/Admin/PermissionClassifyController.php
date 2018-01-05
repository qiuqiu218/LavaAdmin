<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\PermissionClassifyRequest;
use App\Models\Admin\PermissionClassify;
use Illuminate\Http\Request;

class PermissionClassifyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PermissionClassify::query()->where('name', '<>', '菜单管理')->orderBy('sort')->get();
        return view('admin.permission_classify.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission_classify.create');
    }

    /**
     * @param PermissionClassifyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionClassifyRequest $request)
    {
        $input = $request->only('name', 'sort');
        $res = PermissionClassify::query()->create($input);
        return $res ? $this->setAutoClose()->success('创建成功') : $this->error('创建失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = PermissionClassify::query()->findOrFail($id);
        return view('admin.permission_classify.edit', [
            'data' => $data
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->only('name', 'sort');
        $res = PermissionClassify::query()->findOrFail($id)->update($input);
        return $res ? $this->setAutoClose()->success('更新成功') : $this->error('更新失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $res = PermissionClassify::query()->findOrFail($id)->delete();
        return $res ? $this->success('删除成功') : $this->error('删除失败');
    }
}
