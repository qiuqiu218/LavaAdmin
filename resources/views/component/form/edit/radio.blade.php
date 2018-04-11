<div class="layui-form-item" pane>
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    @foreach ($option as $item)
      <input type="radio" name="{{$name}}" value="{{$item['value']}}" title="{{$item['text']}}"{{$value === $item['value'] ? ' selected' : $item['active'] ? ' checked' : ''}}>
    @endforeach
  </div>
</div>