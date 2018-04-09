<div class="layui-form-item">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    <div class="upload">
      <button type="button" class="layui-btn" route="{{ url('admin/file?model='.$controller.'&mark='.$mark.'&field='.$name.'&type=File') }}">
        <i class="layui-icon">&#xe67c;</i>添加文件
      </button>
    </div>
    <input type="text" name="{{$name}}" placeholder="请上传{{$display_name}}" class="layui-input" value="{{old($name)}}">
  </div>
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
</div>