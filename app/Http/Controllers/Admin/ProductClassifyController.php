<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\ProductClassify;
use Illuminate\Http\Request;

class ProductClassifyController extends BaseController
{
    protected $model = null;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        $this->model = new ProductClassify();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->model->get()->toHierarchy();
        return $this->view([
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->view([
            'classify' => $this->model->getClassifyTree()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = array_filter($request->only($this->model->getFillable()));
        $res = $this->model->create($input);
        return $res ? $this->setAutoClose()->success('创建成功') : $this->error('创建失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->view([
            'data' => $this->model->findOrFail($id),
            'classify' => $this->model->getClassifyTree($id)
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
        return $res ? $this->setAutoClose()->success('创建成功') : $this->error('创建失败');
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
