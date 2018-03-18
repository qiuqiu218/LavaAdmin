@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/'.$controller.'/'.$data->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <input type="hidden" name="model" value="{{$controller}}">
  <input type="hidden" name="id" value="{{$data->id}}">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认修改</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    @foreach ($fields as $item)
      @include('admin.base_info.edit_input')
    @endforeach
  </div>
</form>
@endsection

@section('script')
  @parent
  @include('admin.base_info.input_js')
@endsection