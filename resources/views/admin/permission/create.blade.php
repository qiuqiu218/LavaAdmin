@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/permission')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="guard_name" value="{{$guard_name}}">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    <div class="layui-form-item">
      <label class="layui-form-label">标识</label>
      <div class="layui-input-inline">
        <input type="text" name="name" required lay-verify="required" placeholder="请输入权限标识" class="layui-input" value="{{old('name')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('name')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">名称</label>
      <div class="layui-input-inline">
        <input type="text" name="display_name" required lay-verify="required" placeholder="请输入权限名称" class="layui-input" value="{{old('display_name')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('display_name')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">分类</label>
      <div class="layui-input-inline">
        <select name="permission_classify_id">
          <option value=""></option>
          @foreach ($classify as $item)
          <option value="{{$item->id}}">{{$item->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('display_name')}}</div>
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