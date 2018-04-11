<div class="layui-form-item">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-inline">
    <input type="password" name="{{$name}}" placeholder="请输入{{$display_name}}" class="layui-input" value="{{old($name) ? old($name) : $value}}">
  </div>
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
</div>