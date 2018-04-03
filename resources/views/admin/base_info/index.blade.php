@extends('layouts.default')

@section('content')
<div class="d-padding-10">
<div class="layui-row">
    <div class="layui-col-xs6">
      <a class="layui-btn layui-btn-normal" href="{{ url('admin/'.$controller.'/create') }}">添加信息</a>
    </div>
    <div class="layui-col-xs6">
      <form class="layui-form layui-form-pane" method="get" action="{{ url('admin/'.$controller) }}">
        <div class="d-input-group d-float-right">
          <div class="layui-form-item">
            <select name="field">
              <option value="">选择字段</option>
              @foreach ($search['option'] as $item)
                <option value="{{$item->name}}"{{$item->name === $search['field'] ? ' selected' : ''}}>{{$item->display_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="layui-form-item">
            <div class="d-input-group">
              <input type="text" name="keywords" placeholder="请输入关键词" class="layui-input" value="{{$search['keywords']}}">
              <div class="addbtn">
                <button class="layui-btn">搜索</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <table class="layui-table">
    <colgroup>
      <col width="80">
      @foreach ($tableCol as $item)
      <col>
      @endforeach
      <col width="140">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        @foreach ($tableCol as $item)
        <th>{{$item->display_name}}</th>
        @endforeach
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($tableData as $item)
    <tr>
      <td>{{$item->id}}</td>
      @foreach ($tableField as $field)
      <td>
      {{$item->$field}}
      </td>
      @endforeach
      <td align="center">
        <a class="layui-btn layui-btn-xs layui-btn-normal" href="{{ url('admin/'.$controller.'/'.$item->id.'/edit') }}">编辑</a>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/'.$controller.'/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
  <div class="d-text-center">{{$tableData->links()}}</div>
</div>
@endsection