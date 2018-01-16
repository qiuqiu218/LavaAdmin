<?php

namespace App\Http\Controllers;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $table_id = $request->input('table_id');
        // 根据table_id 获取关联的field表数据
        $data = Table::query()->findOrFail($table_id)->field;
        return view('common.field.index', [
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
        $type = config('enum.Field.type');
        return view('common.field.create', [
            'type' => $type,
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
        $res = $this->model->query()->create($input);
        return $res ? $this->success('创建成功', 'admin/field?table_id='.$input['table_id']) : $this->error('创建失败');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = config('enum.Field.type');
        $data = $this->model->query()->findOrFail($id);
        return view('common.field.edit', [
            'data' => $data,
            'type' => $type
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
        $data = $this->model->query()->findOrFail($id);
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
        $res = $this->model->query()->findOrFail($id)->delete();
        return $res ? $this->success('删除成功') : $this->error('删除失败');
    }
}
