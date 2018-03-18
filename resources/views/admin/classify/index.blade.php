@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <div>
    <div>
      @can('menu_create')
      <button class="layui-btn layui-btn-normal" route="{{ url('admin/classify/create?table_id='.$table_id) }}">添加分类</button>
      @endcan
    </div>
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col width="150">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>菜单标题</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @each('admin.classify.table', $data, 'item')
    </tbody>
  </table>
</div>
@endsection