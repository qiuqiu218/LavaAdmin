@extends('layouts.default')

@section('head')
  @parent
  <style>
    html, 
    body, 
    .layui-row, 
    .layui-row > div{
      height: 100%
    }
  </style>
@endsection

@section('content')
  <div class="layui-row">
    <div class="layui-col-sm4 layui-col-sm-offset4 layui-col-xs6 layui-col-xs-offset3">
      <div class="d-panel d-vertical-center d-text-center">
        <header>系统提示</header>
        <section><i class="layui-icon d-font-success layui-inline">&#xe616;</i> {{ session('message') }}</section>
        <footer><span id="sec">3</span>秒后自动{{ session('autoClose') ? '关闭' : '跳转' }},您也可以点击 <a href="{{ url(session('jumpUrl')) }}" id="jump">这里</a></footer>
      </div>
    </div>
  </div>
  <script>
    var _data = @json(session('data'));
    var _autoClose = @json(session('autoClose'));
  </script>
@endsection

