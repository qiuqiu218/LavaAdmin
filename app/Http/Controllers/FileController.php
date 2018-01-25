<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = File::query()
                    ->whereNull('info_id')
                    ->where('type', 3)
                    ->paginate();
        return view('common.file.index', [
            'data' => $data,
            'field' => $request->get('field'),
            'type' => $request->get('type')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('common.file.create', [
            'field' => $request->get('field'),
            'type' => $request->get('type')
        ]);
    }

    /**
     * @param FileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FileRequest $request)
    {
        $res = $request->only('model', 'mark', 'info_id');
        $file = $request->file('file');
        $file->isValid();
        $res['user_id'] = Auth::id();
        $res['type'] = 3;
        $res['is_admin'] = 1;
        $res['name'] = $file->getClientOriginalName();
        $res['mime'] = $file->getMimeType();
        $res['size'] = $file->getSize();
        $res['path'] = Storage::disk('files')->putFile(snake_case($res['model']), $file);
        File::query()->create($res);

        return $this->setParams([
            'url' => Storage::disk('files')->url($res['path'])
        ])->success('上传成功');
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $data = File::query()->findOrFail($id);
        Storage::disk('files')->delete($data->path);
        $res = $data->delete();
        return $res ? $this->success('删除成功') : $this->error('删除失败');
    }
}
