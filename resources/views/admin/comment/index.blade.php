@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col>
      <col width="120">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>评论内容</th>
        <th>评分</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->content}}</td>
      <td>{{$item->grade}}</td>
      <td align="center">
        <a class="layui-btn layui-btn-xs layui-btn-normal" href="{{ url('admin/comment/'.$item->id.'/edit') }}">编辑</a>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/comment/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection