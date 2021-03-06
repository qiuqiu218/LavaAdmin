@extends('layouts.default')

@section('content')
  <form class="layui-form layui-form-pane" action="{{url('admin/menu/'.$data->id)}}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="hidden" name="id" value="{{$data->id}}">
    <div class="layui-footer d-text-center">
      <button class="layui-btn" lay-submit>确认修改</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
    <div class="d-padding-10">
      <div class="layui-form-item">
        <label class="layui-form-label">父级</label>
        <div class="layui-form" selectTree="parent_id" value="{{$data->parent_id}}">
          <div class="layui-input-inline">
            <select></select>
          </div>
        </div>
        <div class="layui-form-mid layui-word-aux">{{$errors->first('parent_id')}}</div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
          <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" class="layui-input" value="{{old('title') ? old('title') : $data->title}}">
        </div>
        <div class="layui-form-mid layui-word-aux">{{$errors->first('title')}}</div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-inline">
          <input type="text" name="description" placeholder="请输入描述" class="layui-input" value="{{old('description') ? old('description') : $data->description}}">
        </div>
        <div class="layui-form-mid layui-word-aux">{{$errors->first('description')}}</div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">路由</label>
        <div class="layui-input-inline">
          <input type="text" name="route" placeholder="请输入路由" class="layui-input" value="{{old('route') ? old('route') : $data->route}}">
        </div>
        <div class="layui-form-mid layui-word-aux">{{$errors->first('route')}}</div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">类型</label>
        <div class="layui-input-inline">
          <select name="type">
            <option value=""></option>
            @foreach ($type['data'] as $name)
            <option value="{{$name}}" {{$name === $data->type ? 'selected' : ''}}>{{$name}}</option>
            @endforeach
          </select>
        </div>
        <div class="layui-form-mid layui-word-aux">{{$errors->first('type')}}</div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
          <input type="text" name="sort" placeholder="请输入整数" class="layui-input" value="{{old('sort') ? old('sort') : $data->sort}}">
        </div>
        <div class="layui-form-mid layui-word-aux">{{$errors->first('sort')}}</div>
      </div>
    </div>
  </form>
@endsection