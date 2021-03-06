@extends('layouts.default')

@section('content')
@if ($url_params['type'] === 'Images' || $url_params['type'] === 'Editor')
<div class="layui-footer d-text-center">
  <button class="layui-btn layui-btn-normal" id="submit">确认选择</button> 
</div>
@endif
<div class="d-padding-10">
  <div class="d-margin-b-10">
    <a class="layui-btn layui-btn-normal" href="{{ url('admin/product_image/create?'.$url_address) }}">添加图片</a>
  </div>
  <div class="layui-row layui-col-space25" id="list">
    @foreach ($data as $item)
      <div class="layui-col-xs3" id="img{{$item->id}}">
        <div class="square">
          <div class="square-img">
            <img src="{{url($item->path)}}">
            <div class="mask">
              <div class="layui-row">
                <div class="layui-col-xs6">
                  <a href="javascript:;" onclick="selected({{$loop->index}})" class="selected">
                    <i class="layui-icon">&#xe605;</i>
                    <span>选择</span>
                  </a>
                </div>
                <div class="layui-col-xs6 d-text-right">
                  <a href="javascript:;" onclick="deleted({{$loop->index}})"><i class="layui-icon">&#xe640;</i>删除</a>
                </div>
              </div>
            </div>
          </div>
          <div class="name d-text-center">
            {{$item->name}}
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="d-text-center">
    {{$data->links()}}
  </div>
</div>
<script>
  _data = @json($data)
</script>
@endsection