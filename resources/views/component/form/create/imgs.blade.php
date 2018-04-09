<div class="layui-form-item d-table" id="images">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    <div class="d-padding-10 d-border">
      <div class="d-margin-b-10">
        <button type="button" class="layui-btn" route="{{ url('admin/image?model='.$controller.'&field='.$name.'&type=Images') }}">
          <i class="layui-icon">&#xe67c;</i>添加图片
        </button>
      </div>
      <div class="layui-row layui-col-space20" id="{{$name}}List"></div>
    </div>
  </div>
</div>