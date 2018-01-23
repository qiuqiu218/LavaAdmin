@extends('layouts.default')

@section('content')
<div class="layui-upload d-padding-10">
  <button type="button" class="layui-btn layui-btn-normal image">选择多文件</button> 
  <div class="layui-upload-list">
    <table class="layui-table">
      <thead>
        <tr><th>文件名</th>
        <th>大小</th>
        <th>状态</th>
        <th>操作</th>
      </tr></thead>
      <tbody id="listView"></tbody>
    </table>
  </div>
  <button type="button" class="layui-btn" id="submit">开始上传</button>
</div>
<div class="d-padding-10">
  <div class="layui-row layui-col-space25">
    @foreach ($data as $item)
      <div class="layui-col-xs3">
        <div class="square">
          <img src="{{$item->path}}">
          <div class="mask">
            <div class="layui-row">
              <div class="layui-col-xs6">
                <a href="javascript:;"><i class="layui-icon">&#xe605;</i>选择</a>
              </div>
              <div class="layui-col-xs6 d-text-right">
                <a href="javascript:;"><i class="layui-icon">&#xe640;</i>删除</a>
              </div>
            </div>
          </div>
        </div>
        <div class="d-text-center">{{$item->name}}</div>
      </div>
    @endforeach
  </div>
</div>
@endsection