<div class="layui-form-item d-table d-border" id="images">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    <div class="d-padding-10">
      <div class="d-margin-b-10">
        <button type="button" class="layui-btn" route="{{ url('admin/image?model='.$controller.'&field='.$name.'&type=Images') }}">
          <i class="layui-icon">&#xe67c;</i>添加图片
        </button>
      </div>
      <div class="layui-row layui-col-space20" id="{{$name}}List">
        @foreach ($value as $img)
        <div class="layui-col-xs2">
          <div class="square">
            <div class="square-img">
              <img src="{{$img['path']}}">
              <div class="mask">
                <div class="d-text-right">
                  <a href="javascript:;" deleted><i class="layui-icon">&#xe640;</i>删除</a>
                </div>
              </div>
            </div>
            <h5 class="d-margin-t-5 d-text-center layui-elip">{{$img['name']}}</h5>
            <input type="hidden" name="{{$name}}[]" value="{{$img['id']}}">
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>