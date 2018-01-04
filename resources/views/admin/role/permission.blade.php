@extends('layouts.default')

@section('content')

<div class="d-padding-10">
  <form action="{{ url('admin/role/'.$id.'/permission') }}" method="post" class="layui-form layui-form-pane">
    {{ csrf_field() }}
    <div class="layui-footer d-text-center">
      <button class="layui-btn" lay-submit>确认设置</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
    <div>
      @foreach ($data as $role)
      <div class="layui-form-item" pane>
        <label class="layui-form-label">{{$role->name}}</label>
        <div class="layui-input-block">
          @foreach ($role->permission as $item)
          <input type="checkbox" name="permission[]" title="{{$item->display_name}}" value="{{$item->name}}"{{ in_array($item->name, $permission) ? ' checked' : '' }}>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
  </form>
</div>

@endsection