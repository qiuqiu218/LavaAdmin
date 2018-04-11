@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/product_spec_attribute/'.$data->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认修改</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    @include('component.form.edit.linkage_select', ['name' => 'product_classify_id', 'display_name' => '所属分类', 'classify' => $classify, 'value' => $data->product_classify_id])
    @include('component.form.edit.text', ['name' => 'name', 'display_name' => '标识', 'value' => $data->name])
    @include('component.form.edit.text', ['name' => 'title', 'display_name' => '属性名', 'value' => $data->title])
    <fieldset class="layui-elem-field">
      <legend>属性值</legend>
      <div class="layui-field-box">
        @foreach ($data->values as $value)
        <div class="d-border d-padding-5 layui-inline d-margin-b-5 d-margin-r-5">
          <input type="hidden" name="values[]" value="{{$value}}">
          {{$value}}
          <a href="javascript:;" class="deleteItem"><i class="layui-icon">&#x1006;</i></a>
        </div>
        @endforeach
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