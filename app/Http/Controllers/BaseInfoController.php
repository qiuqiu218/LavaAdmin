<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseInfoController extends BaseController
{
    protected $module = null;

    public function __construct()
    {
        $this->module = $this->getInstantiationModel();
        View::share('controller', $this->getController());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('common.base_info.index', [
            'tableCol' => $this->module->getTableCol(),
            'tableData' => $this->module->getTableData(),
            'tableField' => $this->module->getTableListField()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('common.base_info.create', [
            'fields' => $this->module->getTableDetailField()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $mark = $request->get('mark');
        $input = $request->only($this->module->getFillable());
        $res = $this->module->create($input);
        File::query()->where('mark', $mark)->update([
            'info_id' => $res->id,
            'mark' => 0
        ]);
        return $res ? $this->success('发布成功', url('admin/'.snake_case($this->getController()))) : $this->error('发布失败');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->module->findOrFail($id);
        return view('common.base_info.edit', [
            'data' => $data,
            'fields' => $this->module->getTableDetailField()
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $this->module->findOrFail($id);
        $input = $request->only($this->module->getFillable());
        $res = $data->update($input);
        return $res ? $this->success('修改成功', url('admin/'.snake_case($this->getController()))) : $this->error('修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
