<div class="layui-form-item">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-inline">
    <textarea name="{{$name}}" placeholder="请输入{{$display_name}}" class="layui-textarea">{{old($name)}}</textarea>
  </div>
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
</div>