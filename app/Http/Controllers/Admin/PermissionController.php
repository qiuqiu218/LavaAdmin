<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\PermissionClassify;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends BaseController
{
    protected $model = null;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new Permission();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $guard_name = $request->input('guard_name');
        $data = $this->model
                    ->with('permission_classify')
                    ->where('guard_name', $guard_name)
                    ->where('permission_classify_id', '<>', Permission::findByClassifyId('菜单管理'))
                    ->orderBy('sort')
                    ->get();
        return $this->view([
            'data' => $data,
            'guard_name' => $guard_name
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $guard_name = $request->input('guard_name');

        $classify = PermissionClassify::query()
                    ->where('guard_name', $guard_name)
                    ->orderBy('sort')
                    ->get();
        return $this->view([
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
        $input = $request->only($this->model->getFillable());
        $res = $this->model->create($input);
        return $res ? $this->setAutoClose()->success('创建成功') : $this->error('创建失败');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $guard_name = $request->input('guard_name');

        $classify = PermissionClassify::query()
            ->where('guard_name', $guard_name)
            ->orderBy('sort')
            ->get();
        $data = $this->model->findOrFail($id);

        return $this->view([
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
        $input = $request->only($this->model->getFillable());
        $res = $this->model->findOrFail($id)->update($input);
        return $res ? $this->setAutoClose()->success('更新成功') : $this->error('更新失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $res = $this->model->findOrFail($id)->delete();
        return $res ? $this->success('删除成功') : $this->error('删除失败');
    }
}
