@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/field')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="table_id" value="{{$table_id}}">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    <div class="layui-form-item">
      <label class="layui-form-label">标识</label>
      <div class="layui-input-inline">
        <input type="text" name="name" required lay-verify="required" placeholder="请输入字段标识" class="layui-input" value="{{old('name')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('name')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">名称</label>
      <div class="layui-input-inline">
        <input type="text" name="display_name" required lay-verify="required" placeholder="请输入字段名称" class="layui-input" value="{{old('display_name')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('display_name')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">类型</label>
      <div class="layui-input-inline">
        <select name="type">
          <option value="">默认{{$type['default']}}</option>
          @foreach ($type['data'] as $name)
          <option value="{{$name}}"{{ $type['default'] === $name ? ' selected' : '' }}>{{$name}}</option>
          @endforeach
        </select>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('type')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">默认值</label>
      <div class="layui-input-inline">
        <textarea name="default_value" placeholder="请输入默认值" class="layui-textarea">{{old('default_value')}}</textarea>
        <div class="d-text-right word-count"><span>0</span>/255</div>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('default_value')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">字段所属</label>
      <div class="layui-input-inline">
        <div class="layui-input">
          <input type="radio" name="belong" value="1" title="主表" checked>
          <input type="radio" name="belong" value="2" title="副表">
        </div>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('belong')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">后台列表</label>
      <div class="layui-input-inline">
        <div class="layui-input">
          <input type="radio" name="is_show" value="1" title="显示" checked>
          <input type="radio" name="is_show" value="0" title="隐藏">
        </div>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('is_show')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">是否输入</label>
      <div class="layui-input-inline">
        <div class="layui-input">
          <input type="radio" name="is_import" value="1" title="开启" checked>
          <input type="radio" name="is_import" value="0" title="关闭">
        </div>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('is_import')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">排序</label>
      <div class="layui-input-inline">
        <input type="text" name="sort" placeholder="请输入字段排序" class="layui-input" value="{{old('sort')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('sort')}}</div>
    </div>
  </div>
</form>
@endsection