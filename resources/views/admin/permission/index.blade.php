@extends('layouts.default')

@section('content')

<div class="d-padding-10">
  <div class="layui-row">
    <div class="layui-col-xs6">
      <button class="layui-btn layui-btn-normal" route="{{ url('admin/permission/create?guard_name='.$guard_name) }}">添加权限</button>
      <button class="layui-btn layui-btn-normal" route="{{ url('admin/permission_classify?guard_name='.$guard_name) }}">添加分类</button>
    </div>
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col>
      <col>
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>标识</th>
        <th>名称</th>
        <th>分类</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->display_name}}</td>
      <td>{{$item->permission_classify->name}}</td>
      <td align="center">
        <button class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/permission/'.$item->id.'/edit?guard_name='.$guard_name) }}">编辑</button>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/permission/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection