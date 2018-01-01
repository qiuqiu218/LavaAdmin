<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>lavaAdmin</title>
  @include('layouts.head')
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <ul class="layui-nav layui-layout-left">
      @foreach ($data as $item)
      <li class="layui-nav-item"><a href="{{url('admin/sidebar')}}?parent_id={{$item->id}}" target="sidebar">{{$item['title']}}</a></li>
      @endforeach
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
          {{ auth('admin')->user()->username }}
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="{{ route('logout') }}" id="logout">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <iframe src="{{url('admin/sidebar')}}" frameborder="0" width="100%" height="100%" name="sidebar"></iframe>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <iframe src="{{url('admin/main')}}" frameborder="0" width="100%" height="100%" name="content"></iframe>
  </div>
</div>
@include('layouts.script')
</body>
</html>