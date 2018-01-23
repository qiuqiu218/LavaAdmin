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
    public function index()
    {
        $data = File::query()->whereNull('info_id')->get();
        return view('common.file.index', [
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
        return view('common.file.create');
    }

    /**
     * @param FileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FileRequest $request)
    {
        $res = $request->only('model', 'mark', 'info_id');
        $img = $request->file('img');
        $img->isValid();
        $res['user_id'] = Auth::id();
        $res['type'] = 1;
        $res['is_admin'] = 1;
        $res['name'] = $img->getClientOriginalName();
        $res['mime'] = $img->getMimeType();
        $res['size'] = $img->getSize();
        $res['path'] = Storage::disk('images')->putFile(snake_case($res['model']), $img);
        File::query()->create($res);

        return $this->setParams([
            'url' => Storage::disk('images')->url($res['path'])
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
