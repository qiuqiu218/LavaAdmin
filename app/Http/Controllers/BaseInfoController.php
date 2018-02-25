<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'tableCol' => $this->module->getTableListFields(),
            'tableData' => $this->module->getTableData(),
            'tableField' => $this->module->getTableListFieldNames()
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
            'fields' => $this->module->getFormDetailFields(),
            'mark' => time()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $mark = $request->get('mark');
        $input = $request->only($this->module->getMainFieldNames());

        DB::beginTransaction();
        try {
            $data = $this->module->create($input);
            // 如果存在副表则增加到副表
            if ($this->module->isSubTable()) {
                $subInput = $request->only($this->module->getSubFieldNames());
                $data->subTable()->create($subInput);
            }
            File::query()->where('mark', $mark)->update([
                'info_id' => $data->id,
                'mark' => 0
            ]);
            DB::commit();
            return $this->success('发布成功', url('admin/'.snake_case($this->getController())));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            DB::rollBack();
            return $this->error('发布失败');
        }
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
        // 如果有副表，将副表字段追加到data中去
        if ($this->module->isSubTable()) {
            // 通过关联获取当前模型的副表
            $sub_data = $data->subTable;
            // 获取副表字段名称
            $sub_fields = $this->module->getSubFieldNames();
            // 将副表的字段追加到data中去
            foreach ($sub_fields as $field) {
                $data->$field = $sub_data->$field;
            }
        }
        // 获取表单需要输入的字段(包含主表与副表)
        $fields = $this->module->getFormDetailFields();
        // 如果有以下两种字段, 则查询files表的数据，追加到data中
        $fields->each(function ($item) use ($data) {
            if ($item->type === '多文件上传' || $item->type === '多图上传') {
                $data[$item->name] = File::query()->whereIn('id', $data[$item->name])->get();
            }
        });

        return view('common.base_info.edit', [
            'data' => $data,
            'fields' => $fields
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $data = $this->module->findOrFail($id);
        $input = $request->only($this->module->getMainFieldNames());

        DB::beginTransaction();

        try {
            $data->update($input);
            // 如果存在副表则更新副表
            if ($this->module->isSubTable()) {
                $subInput = $request->only($this->module->getSubFieldNames());
                $data->subTable()->update($subInput);
            }

            DB::commit();
            return $this->success('修改成功', url('admin/'.snake_case($this->getController())));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('修改失败');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $data = $this->module->findOrFail($id);

        DB::beginTransaction();

        try {
            // 如果存在副表则删除副表
            if ($this->module->isSubTable()) {
                $data->subTable()->delete();
            }

            // 获取关联的文件数据
            $file_sql = DB::table('files')
                ->where('model', $this->getModel())
                ->where('info_id', $data->id);
            // 删除文件
            $files = $file_sql->get();
            foreach ($files as $file) {
                switch ($file->type) {
                    case 1:
                        File::deleteImages($file->path);
                        break;
                    case 3:
                        File::deleteFiles($file->path);
                        break;
                }
            }
            // 删除关联的文件表数据
            $file_sql->delete();

            // 删除主表信息
            $data->delete();

            DB::commit();
            return $this->success('删除成功', url('admin/'.snake_case($this->getController())));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            DB::rollBack();
            return $this->error('删除失败');
        }
    }
}
