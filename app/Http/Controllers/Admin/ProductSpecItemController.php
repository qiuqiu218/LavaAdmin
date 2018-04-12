<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\ProductSpecItem;
use Illuminate\Http\Request;

class ProductSpecItemController extends BaseController
{
    protected $model = null;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductSpecItem();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $this->model->findOrFail($id);
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
        $type = (int)$request->input('type', 1);
        $number = (int)$request->input('number', 0);
        $data = $this->model->findOrFail($id);
        if ($type === 1) {
            $data->store_count += $number;
        } else {
            $data->store_count -= $number;
        }
        $res = $data->save();
        return $res ? $this->setParams($data)->setAutoClose(false)->success('修改成功') : $this->error('修改失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
//        $data = $this->model->findOrFail($id);
//        $res = $data->delete();
//        return $res ? $this->success('删除成功') : $this->error('删除失败');
        return $this->success();
    }
}
