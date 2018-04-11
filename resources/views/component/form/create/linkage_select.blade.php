<div class="layui-form-item">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-form" selectTree="{{$name}}" value="{{old($name)}}">
    <div class="layui-input-inline">
      <select></select>
    </div>
  </div>
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
  <script>
  var _tree = @json($classify['tree']);
  var _path = @json(isset($classify['path']) ? $classify['path'] : []);
  </script>
</div>