@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/field')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="table_id" value="{{$table_id}}">
  <input type="hidden" name="option" value="">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10" style="height: 100%">
    <div class="layui-row">
      <div class="layui-col-xs6">
        @include('component.form.create.text', ['name' => 'name', 'display_name' => '字段标识'])
        @include('component.form.create.text', ['name' => 'display_name', 'display_name' => '字段名称'])
        @include('component.form.create.select', ['name' => 'element', 'display_name' => '显示元素', 'option' => config('enum.Field.element')])
        @include('component.form.create.select', ['name' => 'type', 'display_name' => '字段类型', 'option' => config('enum.Field.type')])
        @include('component.form.create.text', ['name' => 'type_length', 'display_name' => '字段长度'])
        @include('component.form.create.text', ['name' => 'default_value', 'display_name' => '默认值'])
        @include('component.form.create.radio', ['name' => 'belong', 'display_name' => '字段所属', 'option' => config('enum.Field.belong')])
        @include('component.form.create.radio', ['name' => 'is_show', 'display_name' => '后台列表', 'option' => config('enum.Field.is_show')])
        @include('component.form.create.radio', ['name' => 'is_import', 'display_name' => '后台列表', 'option' => config('enum.Field.is_import')])
        @include('component.form.create.text', ['name' => 'sort', 'display_name' => '排序'])
      </div>
      <div class="layui-col-xs6" id="option" style="display: none">
        <div id="optionList">
          <div class="layui-form-item">
            <div class="layui-input-inline" style="width: 50px">
              <input type="text" placeholder="值" class="layui-input value">
            </div>
            <div class="layui-input-inline" style="width: 100px">
              <input type="text" placeholder="文本" class="layui-input text">
            </div>
            <div class="layui-input-inline" style="width: 100px">
              <input type="checkbox" title="默认" value="1" lay-skin="primary" lay-filter="active" class="active">
            </div>
          </div>
        </div>
        <div class="layui-form-item">
          <button type="button" class="layui-btn layui-btn-normal" id="addOption">添加一行</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection