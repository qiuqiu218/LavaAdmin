@switch($item->type)
  @case('单行文本框')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <input type="text" name="{{$item->name}}" placeholder="请输入{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('密码框')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <input type="password" name="{{$item->name}}" placeholder="请输入{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break
  
  @case('下拉框')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <select name="{{$item->name}}">
          <option value=""></option>
          @foreach ($item->default_value as $option)
          <option value="{{$option['value']}}"{{$option['active'] ? ' selected' : ''}}>{{$option['text']}}</option>
          @endforeach
        </select>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('单选框')
    <div class="layui-form-item" pane>
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        @foreach ($item->default_value as $option)
          <input type="radio" name="{{$item->name}}" value="{{$option['value']}}" title="{{$option['text']}}"{{$option['active'] ? ' checked' : ''}}>
        @endforeach
      </div>
    </div>
    @break

  @case('复选框')
    <div class="layui-form-item" pane>
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        @foreach ($item->default_value as $option)
          <input type="checkbox" name="{{$item->name}}[]" value="{{$option['value']}}" title="{{$option['text']}}" lay-skin="primary"{{$option['active'] ? ' checked' : ''}}>
        @endforeach
      </div>
    </div>
    @break

  @case('文本框')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <textarea name="{{$item->name}}" placeholder="请输入{{$item->display_name}}" class="layui-textarea">{{old($item->name)}}</textarea>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('单图上传')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        <div class="upload">
          <button type="button" class="layui-btn" route="{{ url('admin/file/create') }}">
            <i class="layui-icon">&#xe67c;</i>上传图片
          </button>
        </div>
        <input type="text" name="{{$item->name}}" placeholder="请输入{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @default
        {{$item->type}}
@endswitch