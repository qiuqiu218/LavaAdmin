<div class="layui-form-item">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-inline">
    <select name="{{$name}}">
      <option value=""></option>
      @foreach ($option as $item)
      <option value="{{$item['value']}}"{{$item['active'] ? ' selected' : ''}}>{{$item['text']}}</option>
      @endforeach
    </select>
  </div>
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
</div>