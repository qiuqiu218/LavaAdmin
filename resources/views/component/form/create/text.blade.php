<div class="layui-form-item">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    <input type="text" name="{{$name}}" placeholder="请输入{{$display_name}}" class="layui-input" value="{{old($name)}}">
  </div>
  @if ($errors->first($name))
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
  @endif
</div>