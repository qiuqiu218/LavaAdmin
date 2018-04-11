<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductClassify;
use App\Models\ProductSpecAttribute;
use Illuminate\Http\Request;

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
        return $this->view([
            'data' => [],
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
     */
    public function store(Request $request)
    {
        $input = $request->all();
        dd($input);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
