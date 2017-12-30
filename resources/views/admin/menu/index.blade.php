@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col width="200">
      <col>
      <col width="200">
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