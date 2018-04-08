@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <table class="layui-table">
    <colgroup>
      <col width="80">
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
        <th>订单号</th>
        <th>订购时间</th>
        <th>订购者</th>
        <th>总数量</th>
        <th>总金额</th>
        <th>状态</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->out_trade_no}}</td>
      <td>{{$item->created_at}}</td>
      <td>{{$item->user_id}}</td>
      <td>{{$item->quantity}}</td>
      <td>{{$item->total_fee}}</td>
      <td>{{$item->status}}</td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection