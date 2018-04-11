@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <div>
    <button class="layui-btn layui-btn-normal" route="{{ url('admin/product_classify/create') }}">添加分类</button>
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
        <th>分类名称</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @each('admin.product_classify.table', $data, 'item')
    </tbody>
  </table>
</div>
@endsection