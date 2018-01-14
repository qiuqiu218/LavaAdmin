<?php

namespace App\Http\Controllers;

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
        $this->model = new Table();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model->all();
        return view('common.table.index', [
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
        return view('common.table.create');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->query()->findOrFail($id);
        return view('common.table.edit', [
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
