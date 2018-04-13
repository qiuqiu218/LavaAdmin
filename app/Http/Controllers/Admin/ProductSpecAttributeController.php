<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\ProductClassify;
use App\Models\ProductSpecAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSpecAttributeController extends BaseController
{
    protected $model = null;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        $this->model = new ProductSpecAttribute();
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
        return $this->view([
            'classify' => (new ProductClassify())->getTree(0, 1)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {

        // 执行事务
        DB::beginTransaction();

        try {
            $input = $request->only($this->model->getFillable());
            $data = $this->model->create($input);
            // 批量添加属性值
            $values = $request->input('values', []);
            $values = collect($values)->map(function ($item) {
                return ['title' => $item];
            })->toArray();
            $data->product_spec_attribute_value_table()->createMany($values);
            // 提交事务
            DB::commit();
            return $this->success('创建成功', url('admin/product_spec_attribute'));
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            return $this->error('创建失败');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->model->with('product_spec_attribute_value_table')->findOrFail($id);
        return $this->view([
            'classify' => (new ProductClassify())->getTree($data->product_classify_id, 1),
            'data' => $data
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
        // 执行事务
        DB::beginTransaction();

        try {
            $input = $request->only($this->model->getFillable());
            $data = $this->model->findOrFail($id);
            $data->update($input);
            // 批量添加属性值
            $values = $request->input('values', []);
            $values = collect($values)->map(function ($item) {
                return ['title' => $item];
            })->toArray();
            $data->product_spec_attribute_value_table()->createMany($values);
            // 提交事务
            DB::commit();
            return $this->success('修改成功', url('admin/product_spec_attribute'));
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
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
        $res = $this->model->findOrFail($id)->delete();
        return $res ? $this->success('删除成功') : $this->error('删除失败');
    }
}
