<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductClassify;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Models\ProductSpecAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    protected $model = null;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new Product();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keywords = $request->input('keywords', '');

        $query = $this->model->query();
        if ($keywords) {
            $query = $query->where('title', 'like', '%'.$keywords.'%');
        }
        $data = $query->orderByDesc('id')->paginate(10);
        return $this->view([
            'data' => $data,
            'search' => [
                'keywords' => $keywords
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $product_classify_id = $request->input('product_classify_id', 0);
        return $this->view([
            'classify' => (new ProductClassify())->getTree($product_classify_id),
            'product_classify_id' => $product_classify_id,
            'spec' => (new ProductSpecAttribute())->getSpecAttribute($product_classify_id)
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
            // 存储主表
            $product_input = $request->only($this->model->getFillable());
            $product = $this->model->create($product_input);

            // 存储副表
            $product_detail_input = $request->only((new ProductDetail())->getFillable());
            $product_detail_input['spec'] = json_decode($product_detail_input['spec']);
            $product->product_detail_table()->create($product_detail_input);

            // 存储规格表
            $product_spec_item_input = $request->input('product_spec_items');
            $product_spec_item_input = json_decode($product_spec_item_input, true);
            $product_spec_item_input = data_set($product_spec_item_input, '*.price', $product->current_price);
            $product_spec_item_input = data_set($product_spec_item_input, '*.product_classify_id', $product_input['product_classify_id']);
            foreach ($product_spec_item_input as $key => $value) {
                $product->product_spec_item_table()->create($value);
            }

            // 更新产品图片表
            $product_image = $request->input('product_image');
            $product_image = json_decode($product_image);
            ProductImage::query()->whereIn('id', $product_image)->update(['product_id' => $product->id]);

            // 提交事务
            DB::commit();
            return $this->success('提交成功', url('admin/product'));
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            return $this->error('提交失败');
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->model->findOrFail($id);
        foreach ($data->product_detail_table->toArray() as $key => $value) {
            $data->$key = $value;
        }
        return $this->view([
            'data' => $data,
            'classifyName' => (new ProductClassify())->getPathNameAndSelf($data->product_classify_id),
            'spec' => (new ProductSpecAttribute())->getSpecAttribute($data->product_classify_id),
            'product_spec_item' => $data->product_spec_item_table
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
