@extends('layouts.default')

@section('content')
@if (intval($type) === 2)
<div class="layui-footer d-text-center">
  <button class="layui-btn layui-btn-normal" id="submit">确认选择</button> 
</div>
@endif
<div class="d-padding-10">
  <div class="d-margin-b-10"><a class="layui-btn layui-btn-normal" href="{{ url('admin/file/create?field='.$field.'&type='.$type) }}">添加文件</a></div>
  <table class="layui-table">
    <colgroup>
      <col>
      <col width="100">
      <col width="100">
      <col width="140">
    </colgroup>
    <thead>
      <tr>
        <th>标题</th>
        <th>格式</th>
        <th>大小</th>
        <th>操作</th>
      </tr> 
    </thead>
    <tbody>
      @foreach ($data as $item)
      <tr id="file{{$item->id}}">
        <td>{{$item->name}}</td>
        <td>{{$item->mime}}</td>
        <td>{{ round($item->size / 1000, 1) }}KB</td>
        <td>
          <a href="javascript:;" onclick="selected({{$loop->index}})" class="selected">选择</a> | <a href="javascript:;" onclick="deleted({{$loop->index}})">删除</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="d-text-center">
    {{$data->appends(['field' => $field, 'type' => $type])->links()}}
  </div>
</div>
<script>
  _data = @json($data)
</script>
@endsection