<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Classify;
use Illuminate\Http\Request;

class ClassifyController extends BaseController
{
    protected $model = null;

    /**
     * ClassifyController constructor.
     */
    public function __construct()
    {
        $this->model = new Classify();
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $table_id = $request->get('table_id');
        $data = $this->model
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
        $res = $this->model->create($input);
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
            'data' => $this->model->findOrFail($id),
            'table_id' => $request->get('table_id')
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $input = array_filter($request->only($this->model->getFillable()));
        $res = $this->model->findOrFail($id)->update($input);
        return $res ? $this->setAutoClose()->success('创建成功') : $this->error('创建失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
        return $this->success('删除成功');
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

        $query = Classify::query()
                        ->where('table_id', $table_id);
        if ($id) {
            $item = Classify::query()->findOrFail($id);
            $data['path'] = $item->getPath();
            $query = $query->whereNotIn('id', $item->getChildrenAndSelf());
        }
        $data['tree'] = $query->get()
                              ->toHierarchy()
                              ->values();
        return $this->setParams($data)->success('获取成功');
    }
}
