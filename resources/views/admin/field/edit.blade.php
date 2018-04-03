@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/field/'.$data->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <input type="hidden" name="option" value="">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认修改</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    <div class="layui-row">
      <div class="layui-col-xs6">
        <div class="layui-form-item">
          <label class="layui-form-label">标识</label>
          <div class="layui-input-inline">
            <input type="text" name="name" required lay-verify="required" placeholder="请输入字段标识" class="layui-input" value="{{old('name') ? old('name') : $data->name}}"{{$data->is_system ? ' readonly' : ''}}>
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('name')}}</div>
          <div class="layui-form-mid layui-word-aux">{{$data->is_system ? '系统字段不可修改' : ''}}</div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">名称</label>
          <div class="layui-input-inline">
            <input type="text" name="display_name" required lay-verify="required" placeholder="请输入字段名称" class="layui-input" value="{{old('display_name') ? old('display_name') : $data->display_name}}">
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('display_name')}}</div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">类型</label>
          <div class="layui-input-inline">
            <select name="element" lay-filter="element"{{$data->is_system ? ' disabled' : ''}}>
              <option value="">默认{{config('enum.Field.element.default')}}</option>
              @foreach (config('enum.Field.element.data') as $name)
              <option value="{{$name}}"{{ $data->element === $name ? ' selected' : '' }}>{{$name}}</option>
              @endforeach
            </select>
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('element')}}</div>
          <div class="layui-form-mid layui-word-aux">{{$data->is_system ? '系统字段不可修改' : ''}}</div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">字段类型</label>
          <div class="layui-input-inline">
            <select name="type" lay-filter="type">
              <option value="">默认{{config('enum.Field.type.default')}}</option>
              @foreach (config('enum.Field.type.data') as $name)
              <option value="{{$name}}"{{ $data->type === $name ? ' selected' : '' }}>{{$name}}</option>
              @endforeach
            </select>
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('type')}}</div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">字段长度</label>
          <div class="layui-input-inline">
            <input type="text" name="type_length" placeholder="请输入默认值" class="layui-input" value="{{old('type_length')}}">
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('type_length')}}</div>
        </div>
        @if (!in_array($data->element, ['下拉框', '联动下拉框', '单选框', '复选框'])) 
        <div class="layui-form-item" id="default_value">
          <label class="layui-form-label">默认值</label>
          <div class="layui-input-inline">
            <input type="text" name="default_value" placeholder="请输入默认值" class="layui-input" value="{{old('default_value') ? old('default_value') : $data->default_value}}">
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('default_value')}}</div>
        </div>
        @endif
        <div class="layui-form-item">
          <label class="layui-form-label">字段所属</label>
          <div class="layui-input-inline">
            <div class="layui-input">
              <input type="radio" name="belong" value="1" title="主表"{{$data->belong === 1 ? ' checked' : ''}}>
              <input type="radio" name="belong" value="2" title="副表"{{$data->belong === 2 ? ' checked' : ''}}{{$data->table->is_sub_table ? '' : ' disabled'}}>
            </div>
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('belong')}}</div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">后台列表</label>
          <div class="layui-input-inline">
            <div class="layui-input">
              <input type="radio" name="is_show" value="1" title="显示"{{$data->is_show ? ' checked' : ''}}>
              <input type="radio" name="is_show" value="0" title="隐藏"{{$data->is_show ? '' : ' checked'}}>
            </div>
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('is_show')}}</div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">是否输入</label>
          <div class="layui-input-inline">
            <div class="layui-input">
              <input type="radio" name="is_import" value="1" title="开启"{{$data->is_import ? ' checked' : ''}}>
              <input type="radio" name="is_import" value="0" title="关闭"{{$data->is_import ? '' : ' checked'}}>
            </div>
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('is_import')}}</div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">排序</label>
          <div class="layui-input-inline">
            <input type="text" name="sort" placeholder="请输入字段排序" class="layui-input" value="{{old('sort') ? old('sort') : $data->sort}}">
          </div>
          <div class="layui-form-mid layui-word-aux">{{$errors->first('sort')}}</div>
        </div>
      </div>
      <div class="layui-col-xs6" id="option" style="display:{{in_array($data->element, ['下拉框', '联动下拉框', '单选框', '复选框']) ? 'block' : 'none'}}">
        <div id="optionList">
          @if (in_array($data->element, ['下拉框', '联动下拉框', '单选框', '复选框']))
            @foreach ($data->option as $item)
            <div class="layui-form-item">
              <div class="layui-input-inline" style="width: 50px">
                <input type="text" placeholder="值" value="{{$item['value']}}" class="layui-input value">
              </div>
              <div class="layui-input-inline" style="width: 100px">
                <input type="text" placeholder="文本" value="{{$item['text']}}" class="layui-input text">
              </div>
              <div class="layui-input-inline" style="width: 100px">
                <input type="checkbox" title="默认" value="1" lay-skin="primary" class="active"{{$item['active'] ? ' checked' : ''}} lay-filter="active">
              </div>
            </div>
            @endforeach
          @endif
        </div>
        <div class="layui-form-item">
          <button type="button" class="layui-btn layui-btn-normal" id="addOption">添加一行</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection