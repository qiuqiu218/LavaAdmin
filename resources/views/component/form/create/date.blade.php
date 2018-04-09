<div class="layui-form-item">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-inline">
    <input type="text" name="{{$name}}" placeholder="请输入{{$display_name}}" class="layui-input" value="{{old($name)}}" date>
  </div>
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
</div>