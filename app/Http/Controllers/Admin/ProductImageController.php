<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends BaseController
{
    protected $model = null;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductImage();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $product_id = $request->input('product_id', 0);
        $data = $this->model->where('product_id', $product_id)->paginate(8);
        $url_params = $request->all();
        $url_address = collect($url_params)->map(function ($value, $key) {
            return $key.'='.$value;
        })->implode('&');
        return $this->view([
            'data' => $data,
            'url_params' => $url_params,
            'url_address' => $url_address
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $url_params = $request->all();
        $url_address = collect($url_params)->map(function ($value, $key) {
            return $key.'='.$value;
        })->implode('&');
        return $this->view([
            'url_params' => $url_params,
            'url_address' => $url_address
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $img = $request->file('img');
        $img->isValid();
        $res = [
            'product_id' => $request->input('product_id', 0),
            'name' => $img->getClientOriginalName(),
            'mime' => $img->getMimeType(),
            'size' => $img->getSize()
        ];
        // 执行事务
        DB::beginTransaction();

        try {
            $res['path'] = Storage::disk('images')->putFile('product_image', $img);
            $data = $this->model->create($res);
            DB::commit();
            return $this->setParams($data)->success('上传成功');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            return $this->error('上传失败');
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
        // 执行事务
        DB::beginTransaction();
        try {
            Storage::disk('images')->delete($data->getOriginal('path'));
            $data->delete();
            DB::commit();
            return $this->success('删除成功');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('删除失败');
        }
    }
}
