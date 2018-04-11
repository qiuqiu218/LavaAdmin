@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/product_spec_attribute')}}" method="post">
  {{ csrf_field() }}
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    @include('component.form.create.linkage_select', ['name' => 'product_classify_id', 'display_name' => '所属分类', 'classify' => $classify])
    @include('component.form.create.text', ['name' => 'name', 'display_name' => '标识'])
    @include('component.form.create.text', ['name' => 'title', 'display_name' => '属性名'])
    <fieldset class="layui-elem-field">
      <legend>属性值</legend>
      <div class="layui-field-box">
        <button type="button" class="layui-btn layui-btn-normal d-margin-b-5 layui-btn-sm" id="addItem">添加</button>
      </div>
    </fieldset>
  </div>
</form>
@endsection

@section('script')
  @parent
  <script src="{{ asset('js/admin/base_info/linkage_select.js?'.time()) }}"></script>
@endsection