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
      <col>
      <col>
      <col width="120">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>商品名称</th>
        <th>退货原因</th>
        <th>退货金额</th>
        <th>退货数量</th>
        <th>退货时间</th>
        <th>退货状态</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->product_order_detail->title}}</td>
      <td>{{$item->content}}</td>
      <td>{{$item->total_fee}}</td>
      <td>{{$item->total_quantity}}</td>
      <td>{{$item->created_at}}</td>
      <td>{{$item->status}}</td>
      <td align="center">
        <button class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/product_refund/'.$item->id.'/edit') }}">查看</button>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/product_refund/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection