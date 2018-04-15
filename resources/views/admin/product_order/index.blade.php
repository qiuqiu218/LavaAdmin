@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <div class="layui-row">
    <form class="layui-form layui-form-pane" method="get" action="">
      <div class="d-input-group">
        @include('component.form.create.select', ['name' => 'status', 'display_name' => '状态', 'option' => $search['status']])
        <div class="addbtn">
          <button class="layui-btn">搜索</button>
        </div>
      </div>
    </form>
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      <col>
      <col>
      <col>
      <col>
      <col width="200">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>订单号</th>
        <th>总金额</th>
        <th>数量</th>
        <th>状态</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->out_trade_no}}</td>
      <td>{{$item->total_fee}}</td>
      <td>{{$item->total_quantity}}</td>
      <td>{{$item->status}}</td>
      <td align="center">
        <button class="layui-btn layui-btn-xs" route="{{ url('admin/product_order_detail?product_order_id='.$item->id) }}">查看商品</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection