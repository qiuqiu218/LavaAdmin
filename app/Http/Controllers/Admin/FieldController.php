<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\FieldRequest;
use App\Models\Field;
use App\Models\Table;
use Illuminate\Http\Request;

class FieldController extends BaseController
{
    protected $model = null;

    public function __construct()
    {
        $this->model = new Field();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $table_id = $request->input('table_id');
        // 根据table_id 获取关联的field表数据
        $data = Table::query()->findOrFail($table_id)->field_table;
        return $this->view([
            'data' => $data,
            'table_id' => $request->input('table_id')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return $this->view([
            'table_id' => $request->input('table_id')
        ]);
    }

    /**
     * @param FieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FieldRequest $request)
    {
        $input = $request->only($this->model->getFillable());
        $input['option'] = json_decode($input['option']);
        $res = $this->model->create($input);
        return $res ? $this->success('创建成功', 'admin/field?table_id='.$input['table_id']) : $this->error('创建失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->model->findOrFail($id);
        return $this->view([
            'data' => $data
        ]);
    }

    /**
     * @param FieldRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FieldRequest $request, $id)
    {
        $input = $request->only($this->model->getFillable());
        $input['option'] = json_decode($input['option']);
        $data = $this->model->findOrFail($id);
        $res = $data->update($input);
        return $res ? $this->success('更新成功', 'admin/field?table_id='.$data->table_id) : $this->error('更新失败');
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
