@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/product_spec_item/'.$data->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认修改</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    @include('component.form.edit.text', ['name' => 'title', 'display_name' => '规格'])
    @include('component.form.edit.text', ['name' => 'store_count', 'display_name' => '当前库存', 'disabled' => true])
    @include('component.form.create.radio', ['name' => 'type', 'display_name' => '操作', 'option' => [['value' => 1, 'text' => '增加', 'active' => true], ['value' => 2, 'text' => '减少', 'active' => false]]])
    @include('component.form.create.text', ['name' => 'number', 'display_name' => '数量'])
  </div>
</form>
@endsection