<div class="layui-form-item d-table">
  <label class="layui-form-label">{{$display_name}}</label>
  <div class="layui-input-block">
    <div id="{{$name}}" editor></div>
    <textarea name="{{$name}}" id="{{$name}}_textarea" style="display: none">{{old($name) ? old($name) : $value}}</textarea>
  </div>
  <div class="layui-form-mid layui-word-aux">{{$errors->first($name)}}</div>
</div>
<script>
  _menus = [
    'head',  // 标题
    'bold',  // 粗体
    'italic',  // 斜体
    'underline',  // 下划线
    'strikeThrough',  // 删除线
    'foreColor',  // 文字颜色
    'backColor',  // 背景颜色
    'link',  // 插入链接
    'list',  // 列表
    'justify',  // 对齐方式
    'quote',  // 引用
    'emoticon',  // 表情
    'images',  // 插入图片
    'table',  // 表格
    'video',  // 插入视频
    'code',  // 插入代码
    'undo',  // 撤销
    'redo'  // 重复
  ]
</script>