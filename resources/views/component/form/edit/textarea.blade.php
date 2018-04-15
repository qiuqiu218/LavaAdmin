<div class="layui-form-item d-table">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    <textarea name="{{$name}}" placeholder="请输入{{$display_name}}" class="layui-textarea"{{$disabled ? ' disabled' : ''}}>{{old($name) ? old($name) : $data[$name]}}</textarea>
  </div>
  @if ($errors->first($name))
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
  @endif
</div>