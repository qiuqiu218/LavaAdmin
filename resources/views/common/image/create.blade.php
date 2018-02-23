@extends('layouts.default')

@section('content')
<div class="layui-footer d-text-center">
  <button class="layui-btn" id="submit">确认上传</button>
  <a class="layui-btn layui-btn-primary" href="{{ url('admin/image?model='.$model.'&info_id='.$info_id.'&field='.$field.'&type='.$type) }}">返回列表</a>
</div>
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
</div>
@endsection