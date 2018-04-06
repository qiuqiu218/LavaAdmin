@extends('layouts.default')

@section('content')

<div class="d-padding-10">
  <div class="layui-row">
    <div class="layui-col-xs6">
      <button class="layui-btn layui-btn-normal" route="{{ url('admin/user/create') }}">添加会员</button>
    </div>
    <div class="layui-col-xs6">
      <form class="layui-form layui-form-pane" method="get" action="{{ url('admin/user') }}">
        <div class="d-input-group d-float-right">
          <div class="layui-form-item">
            <select name="field">
              <option value="">选择字段</option>
              @foreach (config('enum.Admin.search.data') as $value => $name)
                <option value="{{$value}}"{{$value === $field ? ' selected' : ''}}>{{$name}}</option>
              @endforeach
              <option value="no">不存在</option>
            </select>
          </div>
          <div class="layui-form-item">
            <div class="d-input-group">
              <input type="text" name="keywords" placeholder="请输入关键词" class="layui-input" value="{{$keywords}}">
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
      <col width="200">
      <col width="100">
      <col width="150">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>账户</th>
        <th>昵称</th>
        <th class="d-text-center">操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->username}}</td>
      <td>{{$item->nickname}}</td>
      <td align="center">
        <button class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/user/'.$item->id.'/edit') }}">编辑</button>
        <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/user/'.$item->id) }}">删除</button>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
  <div>
    {{$data->links()}}
  </div>
</div>
@endsection