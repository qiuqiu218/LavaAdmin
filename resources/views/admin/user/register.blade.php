@extends('layouts.default')

@section('content')
<div class="layui-container d-bg-white d-padding-30">
  <form class="layui-form layui-form-pane" action="{{route('register')}}" method="post">
    {{ csrf_field() }}
    <div class="layui-form-item">
      <label class="layui-form-label">账户</label>
      <div class="layui-input-inline">
        <input type="text" name="username" required lay-verify="required" placeholder="请输入账户/email/手机号" class="layui-input" value="{{old('username')}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('username')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">密码</label>
      <div class="layui-input-inline">
        <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('password')}}</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">重复密码</label>
      <div class="layui-input-inline">
        <input type="password" name="password_confirmation" required lay-verify="required" placeholder="请再次输入密码" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first('password_confirmation')}}</div>
    </div>
    <div class="layui-form-item">
      <div class="layui-input-inline">
        <button class="layui-btn" lay-submit>注册</button>
        <a href="{{ route('login') }}" class="d-padding-l-20">去登陆</a>
      </div>
    </div>
  </form>
</div>
@endsection