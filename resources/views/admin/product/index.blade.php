@extends('layouts.default')

@section('content')
<div class="d-padding-10">
  <div class="layui-row">
    <div class="layui-col-xs6">
      <button class="layui-btn layui-btn-normal" route="{{ url('admin/product/create') }}">添加产品</button>
    </div>
    <div class="layui-col-xs6">
      <form class="layui-form layui-form-pane" method="get" action="{{ url('admin/product') }}">
        <div class="d-input-group d-float-right">
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
      <col>
      <col>
      <col>
      <col width="120">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>产品标题</th>
        <th>价格</th>
        <th>添加时间</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->title}}</td>
      <td>{{$item->current_price}}</td>
      <td>{{$item->created_at}}</td>
      <td align="center">
        <a class="layui-btn layui-btn-xs layui-btn-normal" href="{{ url('admin/'.$controller.'/'.$item->id.'/edit') }}">编辑</a>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/'.$controller.'/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection