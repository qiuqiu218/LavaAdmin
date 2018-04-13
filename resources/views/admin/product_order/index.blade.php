@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <div class="layui-row">
    <form class="layui-form layui-form-pane" method="get" action="">
      <div class="d-input-group d-float-right">
        <div class="layui-form-item">
          <div class="d-input-group">
            <input type="text" name="keywords" placeholder="请输入关键词" class="layui-input" value="">
            <div class="addbtn">
              <button class="layui-btn">搜索</button>
            </div>
          </div>
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
      <col width="120">
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
      <td>{{$item->quantity}}</td>
      <td>{{$item->status}}</td>
      <td align="center">
        <button class="layui-btn layui-btn-xs layui-btn-normal" route="">查看</button>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/product_order/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection