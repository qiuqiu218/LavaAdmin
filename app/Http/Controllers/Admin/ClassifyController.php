<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Admin\Classify;
use Illuminate\Http\Request;

class ClassifyController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $table_id = $request->get('table_id');
        $data = Classify::query()
                    ->where('table_id', $table_id)
                    ->get()
                    ->toHierarchy();
        return $this->view([
            'data' => $data,
            'table_id' => $table_id
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return $this->view([
            'table_id' => $request->get('table_id')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = array_filter($request->only(['parent_id', 'title', 'sort', 'table_id']));
        $res = Classify::query()->create($input);
        return $res ? $this->setAutoClose()->success('创建成功') : $this->error('创建失败');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        return $this->view([
            'data' => Classify::query()->findOrFail($id),
            'table_id' => $request->get('table_id')
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTree(Request $request)
    {
        $data = [];
        $table_id = $request->get('table_id');
        $id = $request->get('id');

        $data['tree'] = Classify::query()
                        ->where('table_id', $table_id)
                        ->get()
                        ->toHierarchy()
                        ->values();
        if ($id) {
            $item = Classify::query()->findOrFail($id);
            $data['path'] = $item->getPath();
        }
        return $this->setParams($data)->success('获取成功');
    }
}
