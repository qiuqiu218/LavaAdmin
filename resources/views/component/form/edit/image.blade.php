<div class="layui-form-item">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    <input type="text" name="{{$name}}" placeholder="请上传{{$display_name}}" class="layui-input" value="{{old($name) ? old($name) : $data[$name]}}">
    <div class="upload">
      <button type="button" class="layui-btn" route="{{ url($url.'?'.(isset($params) ? $params.'&' : $params).'field='.$name.'&type=Image') }}">
        <i class="layui-icon">&#xe67c;</i>添加图片
      </button>
    </div>
  </div>
  @if ($errors->first($name))
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
  @endif
</div>