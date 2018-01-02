@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/admin')}}" method="post">
  {{ csrf_field() }}
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    <div class="layui-form-item">
      <label class="layui-form-label">账户</label>
      <div class="layui-input-inline">
        <input type="text" name="username" required lay-verify="required" placeholder="请输入账户" class="layui-input" value="{{old('username')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('username')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">密码</label>
      <div class="layui-input-inline">
        <input type="password" name="password" placeholder="请输入密码" class="layui-input" value="{{old('password')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('password')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">昵称</label>
      <div class="layui-input-inline">
        <input type="text" name="nickname" placeholder="请输入昵称" class="layui-input" value="{{old('nickname')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('nickname')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">email</label>
      <div class="layui-input-inline">
        <input type="text" name="email" placeholder="请输入昵称" class="layui-input" value="{{old('email')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('email')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">手机号</label>
      <div class="layui-input-inline">
        <input type="text" name="phone" placeholder="请输入昵称" class="layui-input" value="{{old('phone')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('phone')}}</div>
    </div>
  </div>
</form>
@endsection