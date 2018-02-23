<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageController extends BaseController
{
    public function index(Request $request)
    {
        $info_id = $request->get('info_id', 0);
        $model = $request->get('model');
        $sql = File::query()->where('model', $model);
        if ($info_id && $model) {
            $sql = $sql->where('info_id', $info_id);
        } else {
            $sql = $sql->whereNull('info_id');
        }
        $data = $sql->where('type', 1)->paginate(8);
        return view('common.image.index', [
            'data' => $data,
            'field' => $request->get('field'),
            'type' => $request->get('type'),
            'info_id' => $info_id,
            'model' => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('common.image.create', [
            'field' => $request->get('field'),
            'type' => $request->get('type'),
            'info_id' => $request->get('info_id', 0),
            'model' => $request->get('model')
        ]);
    }

    /**
     * @param ImageRequest $request
     * @return mixed
     */
    public function store(ImageRequest $request)
    {
        $res = array_filter($request->only('model', 'mark', 'info_id'));
        $img = $request->file('img');
        $img->isValid();
        $res['user_id'] = Auth::id();
        $res['type'] = 1;
        $res['is_admin'] = 1;
        $res['name'] = $img->getClientOriginalName();
        $res['mime'] = $img->getMimeType();
        $res['size'] = $img->getSize();

        // 执行事务
        DB::beginTransaction();

        try {
            $res['path'] = Storage::disk('images')->putFile(snake_case($res['model']), $img);
            File::query()->create($res);
            DB::commit();
            return $this->setParams([
                'url' => Storage::disk('images')->url($res['path'])
            ])->success('上传成功');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            return $this->error('上传失败');
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $data = File::query()->findOrFail($id);
        Storage::disk('images')->delete($data->path);
        $res = $data->delete();
        return $res ? $this->success('删除成功') : $this->error('删除失败');
    }
}
