@extends('layouts.default')

@section('content')
<div class="d-padding-10">
<div class="layui-row">
    <div class="layui-col-xs6">
      <button class="layui-btn layui-btn-normal" route="{{ url('admin/'.$controller.'/create') }}">添加信息</button>
    </div>
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col>
      <col>
      <col>
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        @foreach ($tableCol as $item)
        <th>{{$item->display_name}}</th>
        @endforeach
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($tableData as $item)
    <tr>
      <td>{{$item->id}}</td>
      @foreach ($tableField as $field)
      <td>{{$item->$field}}</td>
      @endforeach
      <td align="center">
        <button class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/field/'.$item->id.'/edit') }}">编辑</button>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/field/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection