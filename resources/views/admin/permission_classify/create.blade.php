@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/permission_classify')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="guard_name" value="{{$guard_name}}">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    <div class="layui-form-item">
      <label class="layui-form-label">名称</label>
      <div class="layui-input-inline">
        <input type="text" name="name" required lay-verify="required" placeholder="请输入分类标识" class="layui-input" value="{{old('name')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('name')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">排序</label>
      <div class="layui-input-inline">
        <input type="text" name="sort" placeholder="数字越小越在前" class="layui-input" value="{{old('sort')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('sort')}}</div>
    </div>
  </div>
</form>
@endsection