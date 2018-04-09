<div class="layui-form-item d-table d-border" id="files" name="{{$name}}">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    <div class="d-padding-10">
      <div class="d-margin-b-10">
        <button type="button" class="layui-btn" route="{{ url('admin/file?model='.$controller.'&mark='.$mark.'&field='.$name.'&type=Files') }}">
          <i class="layui-icon">&#xe67c;</i>添加文件
        </button>
      </div>
      <table class="layui-table">
        <colgroup>
          <col>
          <col width="100">
          <col width="100">
          <col width="100">
        </colgroup>
        <thead>
          <tr>
            <th>标题</th>
            <th>格式</th>
            <th>大小</th>
            <th>操作</th>
          </tr> 
        </thead>
        <tbody id="{{$name}}List"></tbody>
      </table>
    </div>
  </div>
</div>