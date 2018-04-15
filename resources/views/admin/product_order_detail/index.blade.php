@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <table class="layui-table">
    <colgroup>
      <col width="120">
      <col>
      <col width="130">
      <col width="60">
    </colgroup>
    <thead>
      <tr>
        <th>封面图</th>
        <th>标题/规格</th>
        <th>价格</th>
        <th>数量</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
      <tr>
        <td rowspan="2">
          <img src="https://pic.feizl.com/upload/allimg/170913/1332zwxixoratuj.jpg" style="height: 10vw">
        </td>
        <td>{{$item->title}}</td>
        <td>原价：{{$item->original_price}}</td>
        <td rowspan="2" align="center">{{$item->quantity}}</td>
      </tr>
      <tr>
        <td>{{$item['spec']}}</td>
        <td>现价：{{$item->current_price}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection