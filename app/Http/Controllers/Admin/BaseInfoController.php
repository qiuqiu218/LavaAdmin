<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Admin\Classify;
use App\Models\Admin\Table;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaseInfoController extends BaseController
{
    protected $model = null;

    public function __construct()
    {
        $this->model = $this->getInstantiationModel();
        View::share('controller', $this->getController());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = [
            'keywords' => $request->input('keywords', ''),
            'field' => $request->input('field', '')
        ];

        $query = $this->model->query();

        if ($search['keywords'] && $search['field']) {
            $query = $query->where($search['field'], 'like', '%'.$search['keywords'].'%');
        }
        $data = $query->orderBy('id', 'desc')->paginate(15);

        return $this->baseInfoView([
            'tableCol' => $this->model->getTableListFields(),
            'tableData' => $this->model->getTableData($data),
            'tableField' => $this->model->getTableListFieldNames(),
            'search' => [
                'keywords' => $request->input('keywords') ?? '',
                'field' => $request->input('field') ?? '',
                'option' => $this->model->getMainFields()
            ]
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $table = (new Table())->getTableInfo($this->getModel());

        $classify = [];
        if ($table->is_classify) {
            $classify = $table->classify_table->toHierarchy()->values();
        }

        return $this->baseInfoView([
            'fields' => $this->model->getFormDetailFields(),
            'classify' => $classify,
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
        $input = $request->only($this->model->getMainFieldNames());

        DB::beginTransaction();
        try {
            $data = $this->model->create($input);
            // 如果存在副表则增加到副表
            if ($this->model->isSubTable()) {
                $subInput = $request->only($this->model->getSubFieldNames());
                foreach ($subInput as $key => $item) {
                    if (is_array($item)) {
                        $subInput[$key] = array_values($item);
                    }
                }
                $data->subTable()->create($subInput);
            }
            File::query()->where('mark', $mark)->update([
                'info_id' => $data->id,
                'mark' => 0
            ]);
            DB::commit();
            return $this->success('发布成功', url('admin/'.$this->getController()));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            DB::rollBack();
            return $this->error('发布失败');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->model->findOrFail($id);
        // 如果有副表，将副表字段追加到data中去
        if ($this->model->isSubTable()) {
            // 通过关联获取当前模型的副表
            $sub_data = $data->subTable;
            // 获取副表字段名称
            $sub_fields = $this->model->getSubFieldNames();
            // 将副表的字段追加到data中去
            foreach ($sub_fields as $field) {
                $data->$field = $sub_data->$field;
            }
        }
        // 获取表单需要输入的字段(包含主表与副表)
        $fields = $this->model->getFormDetailFields();
        // 如果有以下两种字段, 则查询files表的数据，追加到data中
        $fields->each(function ($item) use ($data) {
            if ($item->element === '多文件上传' || $item->element === '多图上传') {
                $data[$item->name] = File::query()->whereIn('id', $data[$item->name])->get();
            }
        });

        // 获取当前表信息
        $table = (new Table())->getTableInfo($this->getModel());
        // 如果开启了分类，则获取分类树
        $classify = [];
        $classify_path = [];
        if ($table->is_classify) {
            $classify = $table->classify_table->toHierarchy()->values();
            if ($data->classify_id > 0) {
                // 获取当前分类id的父级节点，包括当前节点
                $classify_path = Classify::query()->findOrFail($data->classify_id)->getPathAndSelf();
            }
        }
        return $this->baseInfoView([
            'data' => $data,
            'fields' => $fields,
            'classify' => $classify,
            'classify_path' => $classify_path
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
        $data = $this->model->findOrFail($id);
        $input = $request->only($this->model->getMainFieldNames());

        DB::beginTransaction();

        try {
            $data->update($input);
            // 如果存在副表则更新副表
            if ($this->model->isSubTable()) {
                $subInput = $request->only($this->model->getSubFieldNames());
                $data->subTable()->update($subInput);
            }

            DB::commit();
            return $this->success('修改成功', url('admin/'.$this->getController()));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
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
        $data = $this->model->findOrFail($id);

        DB::beginTransaction();

        try {
            // 如果存在副表则删除副表
            if ($this->model->isSubTable()) {
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
            return $this->success('删除成功', url('admin/'.$this->getController()));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            DB::rollBack();
            return $this->error('删除失败');
        }
    }
}
