@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/table')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="model" value="{{$controller}}">
  <input type="hidden" name="mark" value="{{time()}}">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    @foreach ($data as $item)
      @include('common.base_info.input')
    @endforeach
  </div>
</form>
@endsection

@section('script')
  @parent
  @include('common.base_info.input_js')
@endsection