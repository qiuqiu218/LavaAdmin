<div class="layui-form-item" pane>
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    @foreach ($option as $item)
      <input type="checkbox" name="{{$name}}[]" value="{{$item['value']}}" title="{{$item['text']}}" lay-skin="primary"{{$item['active'] ? ' checked' : ''}}>
    @endforeach
  </div>
</div>