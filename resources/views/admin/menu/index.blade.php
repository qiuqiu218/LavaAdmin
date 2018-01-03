@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <div>
    <div>
      <button class="layui-btn layui-btn-normal" route="{{ url('admin/menu/create') }}">添加菜单</button>
    </div>
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col>
      <col width="250">
      <col width="100">
      <col width="150">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>菜单标题</th>
        <th>菜单描述</th>
        <th>菜单路由</th>
        <th>菜单类型</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @each('admin.menu.table', $data, 'item')
    </tbody>
  </table>
</div>
@endsection