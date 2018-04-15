@extends('layouts.default')

@section('content')

<div class="d-padding-10 layui-form layui-form-pane">
  <table class="layui-table">
    <colgroup>
      <col width="120">
      <col>
      <col width="90">
      <col width="90">
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
      <tr>
        <td rowspan="2">
          <div class="layui-row">
            <div class="square">
              <div class="square-img">
                <img src="https://pic.feizl.com/upload/allimg/170913/1332zwxixoratuj.jpg">
              </div>
            </div>
          </div>
        </td>
        <td>{{$data->product_order_detail->title}}</td>
        <td>{{$data->product_order_detail->original_price}}</td>
        <td rowspan="2" align="center">{{$data->product_order_detail->quantity}}</td>
      </tr>
      <tr>
        <td>{{$data->product_order_detail->spec}}</td>
        <td>{{$data->product_order_detail->current_price}}</td>
      </tr>
    </tbody>
  </table>
  @include('component.form.edit.text', ['name' => 'nickname', 'display_name' => '评论人', 'value' =>$data->user->nickname, 'disabled' => true])
  @include('component.form.edit.text', ['name' => 'grade', 'display_name' => '评分', 'disabled' => true])
  @include('component.form.edit.textarea', ['name' => 'content', 'display_name' => '评价内容', 'disabled' => true])
  <div class="layui-form-item d-table d-border">
    <label class="layui-form-label" style="border-width: 0">评价截图</label>
    <div class="layui-input-block">
      <div class="d-padding-10">
        <div class="layui-row layui-col-space20">
          <div class="layui-col-xs3">
            <div class="square">
              <div class="square-img">
                <img src="https://pic.feizl.com/upload/allimg/170913/1332zwxixoratuj.jpg">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection