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

  @default
        {{$item->type}}
@endswitch