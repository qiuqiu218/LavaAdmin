@extends('layouts.default')

@section('content')

<div class="d-padding-10">
  <div>
    <div>
      <button class="layui-btn layui-btn-normal" route="{{ url('admin/admin/create') }}">添加管理员</button>
    </div>
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col>
      <col width="200">
      <col width="100">
      <col width="150">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>账户</th>
        <th>昵称</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

@endsection