@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <form class="layui-form layui-form-pane" action="{{url('admin/menu')}}" method="post">
    {{ csrf_field() }}
    <div class="layui-form-item">
      <label class="layui-form-label">父级</label>
      <div class="layui-form" selectTree="parent_id">
        <div class="layui-input-inline">
          <select></select>
        </div>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('parent_id')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">标题</label>
      <div class="layui-input-inline">
        <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" class="layui-input" value="{{old('title')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('title')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">描述</label>
      <div class="layui-input-inline">
        <input type="text" name="description" placeholder="请输入描述" class="layui-input" value="{{old('description')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('description')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">路由</label>
      <div class="layui-input-inline">
        <input type="text" name="route" placeholder="请输入路由" class="layui-input" value="{{old('route')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('route')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">类型</label>
      <div class="layui-input-inline">
        <select name="type">
          <option value=""></option>
          <option value="0">北京</option>
          <option value="1">上海</option>
          <option value="2">广州</option>
          <option value="3">深圳</option>
          <option value="4">杭州</option>
        </select>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('type')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">排序</label>
      <div class="layui-input-inline">
        <input type="text" name="sort" placeholder="请输入整数" class="layui-input" value="{{old('sort')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('sort')}}</div>
    </div>
    
    <div class="layui-form-item">
      <div class="layui-input-block">
        <button class="layui-btn" lay-submit>立即提交</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
      </div>
    </div>
  </form>
</div>
@endsection