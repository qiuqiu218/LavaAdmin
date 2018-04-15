@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <div class="layui-row">
    
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col>
      <col>
      <col>
      <col width="180">
      <col width="120">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>商品名称</th>
        <th>评论人</th>
        <th>评价内容</th>
        <th>评分</th>
        <th>评价时间</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->product_order_detail->title}}</td>
      <td>{{$item->user->nickname}}</td>
      <td>{{$item->content}}</td>
      <td>{{$item->grade}}</td>
      <td>{{$item->created_at}}</td>
      <td align="center">
        <button class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/product_comment/'.$item->id) }}">查看</button>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/product_comment/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection