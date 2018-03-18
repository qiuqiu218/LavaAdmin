@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/table')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="type" value="1">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    <div class="layui-form-item">
      <label class="layui-form-label">标识</label>
      <div class="layui-input-inline">
        <input type="text" name="name" required lay-verify="required" placeholder="请输入数据表标识" class="layui-input" value="{{old('name')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('name')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">名称</label>
      <div class="layui-input-inline">
        <input type="text" name="display_name" required lay-verify="required" placeholder="请输入数据表名称" class="layui-input" value="{{old('display_name')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('display_name')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">开启副表</label>
      <div class="layui-input-inline">
        <div class="layui-input">
          <input type="radio" name="is_sub_table" value="1" title="开启">
          <input type="radio" name="is_sub_table" value="0" title="关闭" checked>
        </div>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('is_sub_table')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">开启分类</label>
      <div class="layui-input-inline">
        <div class="layui-input">
          <input type="radio" name="is_classify" value="1" title="开启">
          <input type="radio" name="is_classify" value="0" title="关闭" checked>
        </div>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('is_classify')}}</div>
    </div>
  </div>
</form>
@endsection