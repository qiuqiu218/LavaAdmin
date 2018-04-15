@extends('layouts.default')

@section('content')

<form class="layui-form layui-form-pane" action="{{url('admin/product_refund/'.$data->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <input type="hidden" name="status" id="status" value="">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>申请中</button>
    <button class="layui-btn" lay-submit>退款成功</button>
    <button class="layui-btn layui-btn-danger" lay-submit>退款关闭</button>
  </div>
  <div class="d-padding-10">
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
          <th>退货金额</th>
          <th>退货数量</th>
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
          <td rowspan="2">{{$data->total_fee}}</td>
          <td rowspan="2" align="center">{{$data->total_quantity}}</td>
        </tr>
        <tr>
          <td>{{$data->product_order_detail->spec}}</td>
        </tr>
      </tbody>
    </table>
    @include('component.form.edit.text', ['name' => 'status', 'display_name' => '状态', 'disabled' => true])
    @include('component.form.edit.textarea', ['name' => 'content', 'display_name' => '退货理由', 'disabled' => true])
    <div class="layui-form-item d-table d-border">
      <label class="layui-form-label" style="border-width: 0">退货截图</label>
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
</form>
@endsection