@extends('layouts.default')

@section('content')
<div class="layui-footer d-text-center">
  <a class="layui-btn layui-btn-normal" href="{{ url('admin/file/create') }}">添加图片</a> 
</div>
<div class="d-padding-10">
  <div class="layui-row layui-col-space25">
    @foreach ($data as $item)
      <div class="layui-col-xs3">
        <div class="square">
          <img src="{{$item->path}}">
          <div class="mask">
            <div class="layui-row">
              <div class="layui-col-xs6">
                <a href="javascript:;" onclick="selected({{$loop->index}})"><i class="layui-icon">&#xe605;</i>选择</a>
              </div>
              <div class="layui-col-xs6 d-text-right">
                <a href="javascript:;"><i class="layui-icon">&#xe640;</i>删除</a>
              </div>
            </div>
          </div>
        </div>
        <div class="d-text-center">{{$item->name}}</div>
      </div>
    @endforeach
  </div>
</div>
<script>
  _data = @json($data)
</script>
@endsection