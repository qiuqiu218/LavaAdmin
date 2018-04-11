<div class="layui-form-item" pane>
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    @foreach ($option as $item)
      <input type="checkbox" name="{{$name}}[]" value="{{$item['value']}}" title="{{$item['text']}}" lay-skin="primary"{{in_array($item['value'], $value) ? ' checked' : ''}}>
    @endforeach
  </div>
</div>