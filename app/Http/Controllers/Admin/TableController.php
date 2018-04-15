<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TableRequest;
use App\Models\Table;

class TableController extends BaseController
{
    protected $model = null;

    /**
     * TableController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new Table();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->model->all();
        return $this->view([
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->view();
    }

    /**
     * @param TableRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TableRequest $request)
    {
        $input = $request->only($this->model->getFillable());
        $res = $this->model->query()->create($input);
        return $res ? $this->setAutoClose()->success('创建成功') : $this->error('创建失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->model->query()->findOrFail($id);
        return $this->view([
            'data' => $data
        ]);
    }

    /**
     * @param TableRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TableRequest $request, $id)
    {
        $input = $request->only($this->model->getFillable());
        $res = $this->model->query()->findOrFail($id)->update($input);
        return $res ? $this->setAutoClose()->success('更新成功') : $this->error('更新失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $res = $this->model->query()->findOrFail($id)->delete();
        return $res ? $this->setAutoClose()->success('删除成功') : $this->error('删除失败');
    }
}
