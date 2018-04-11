@extends('layouts.default')

@section('content')
  <form class="layui-form layui-form-pane" action="{{url('admin/product_classify/'.$data->id)}}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="layui-footer d-text-center">
      <button class="layui-btn" lay-submit>确认修改</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
    <div class="d-padding-10">
      <div class="layui-form-item">
        <label class="layui-form-label">父级</label>
        <div class="layui-form" selectTree="parent_id" value="{{old('parent_id') ? old('parent_id') : $data->parent_id}}">
          <div class="layui-input-inline">
            <select></select>
          </div>
        </div>
        <div class="layui-form-mid layui-word-aux">{{$errors->first('parent_id')}}</div>
        <script>
        var _tree = @json($classify['tree']);
        var _path = @json($classify['path']);
        </script>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
          <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" class="layui-input" value="{{old('title') ? old('title') : $data->title}}">
        </div>
        <div class="layui-form-mid layui-word-aux">{{$errors->first('title')}}</div>
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