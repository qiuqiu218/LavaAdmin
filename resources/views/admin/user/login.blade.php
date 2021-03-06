@extends('layouts.default')

@section('head')
  @parent
  <link rel="stylesheet" href="{{ asset('css/admin/user/login.css') }}">
@endsection

@section('content')
<div class="layui-container d-bg-white d-padding-30 d-vertical-center">
  <form class="layui-form layui-form-pane" action="{{route('login')}}" method="post">
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
      <div class="layui-input-inline">
        <button class="layui-btn" lay-submit>登陆</button>
        <a href="javascript:;" class="d-padding-l-20">忘记密码</a>
      </div>
    </div>
  </form>
</div>
@endsection

@section('script')
  @parent
  <script src="{{ asset('js/admin/user/login.js') }}?{{ time() }}"></script>
@endsection