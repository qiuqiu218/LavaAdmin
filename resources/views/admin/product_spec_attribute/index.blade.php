@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <div class="layui-row">
    <div class="layui-col-xs6">
      <a class="layui-btn layui-btn-normal" href="{{ url('admin/product_spec_attribute/create') }}">添加属性</a>
    </div>
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col>
      <col>
      <col width="120">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>标识</th>
        <th>属性名</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->title}}</td>
      <td align="center">
        <a class="layui-btn layui-btn-xs layui-btn-normal" href="{{ url('admin/product_spec_attribute/'.$item->id.'/edit') }}">编辑</a>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/product_spec_attribute/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection