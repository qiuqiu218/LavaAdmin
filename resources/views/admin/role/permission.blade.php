@extends('layouts.default')

@section('content')

<div class="d-padding-10">
  <form action="{{ url('admin/role/'.$id.'/permission') }}" method="post" class="layui-form layui-form-pane">
    {{ csrf_field() }}
    <div class="layui-footer d-text-center">
      <button class="layui-btn" lay-submit>确认设置</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
    <div class="layui-tab layui-tab-brief">
      <ul class="layui-tab-title">
        <li class="layui-this">功能权限</li>
        <li>菜单权限</li>
      </ul>
      <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
          @foreach ($data as $role)
          <div class="layui-form-item" pane>
            <label class="layui-form-label">{{$role->name}}</label>
            <div class="layui-input-block">
              @foreach ($role->permission as $item)
              <input type="checkbox" name="permission[]" title="{{$item->display_name}}" value="{{$item->name}}"{{ $item->checked ? ' checked' : '' }}>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
        <div class="layui-tab-item">
          @each('admin.role.menu', $menu, 'item')
        </div>
      </div>
    </div>
  </form>
</div>

@endsection