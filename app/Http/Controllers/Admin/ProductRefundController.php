<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\ProductRefund;
use Illuminate\Http\Request;

class ProductRefundController extends BaseController
{
    protected $model = null;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductRefund();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 查询数据
        $status = (int)$request->input('status', 0);
        $query = $this->model->query()->with('product_order_detail');
        if ($status > 0) {
            $query = $query->where('status', $status);
        }
        $data = $query->orderByDesc('id')->paginate(10);
        return $this->view([
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->model->with('product_order_detail')->findOrFail($id);

        return $this->view([
            'data' => $data
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $status = $request->input('status');
        $data = $this->model->findOrFail($id);
        $data->status = $status;
        return $data->save() ? $this->setAutoClose()->success() : $this->error();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $data = $this->model->findOrFail($id);
        return $data->delete() ? $this->success('删除成功') : $this->error('删除失败');
    }
}
