@switch($item->type)
  @case('单行文本框')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <input type="text" name="{{$item->name}}" placeholder="请输入{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('密码框')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <input type="password" name="{{$item->name}}" placeholder="请输入{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break
  
  @case('下拉框')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <select name="{{$item->name}}">
          <option value=""></option>
          @foreach ($item->default_value as $option)
          <option value="{{$option['value']}}"{{$option['active'] ? ' selected' : ''}}>{{$option['text']}}</option>
          @endforeach
        </select>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('单选框')
    <div class="layui-form-item" pane>
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        @foreach ($item->default_value as $option)
          <input type="radio" name="{{$item->name}}" value="{{$option['value']}}" title="{{$option['text']}}"{{$option['active'] ? ' checked' : ''}}>
        @endforeach
      </div>
    </div>
    @break

  @case('复选框')
    <div class="layui-form-item" pane>
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        @foreach ($item->default_value as $option)
          <input type="checkbox" name="{{$item->name}}[]" value="{{$option['value']}}" title="{{$option['text']}}" lay-skin="primary"{{$option['active'] ? ' checked' : ''}}>
        @endforeach
      </div>
    </div>
    @break

  @case('文本框')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <textarea name="{{$item->name}}" placeholder="请输入{{$item->display_name}}" class="layui-textarea">{{old($item->name)}}</textarea>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('单图上传')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        <div class="upload">
          <button type="button" class="layui-btn" route="{{ url('admin/image?model='.$controller.'&field='.$item->name.'&type=Image') }}">
            <i class="layui-icon">&#xe67c;</i>添加图片
          </button>
        </div>
        <input type="text" name="{{$item->name}}" placeholder="请上传{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('多图上传')
    <div class="layui-form-item d-table d-border" id="images">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        <div class="d-padding-10">
          <div class="d-margin-b-10">
            <button type="button" class="layui-btn" route="{{ url('admin/image?model='.$controller.'&field='.$item->name.'&type=Images') }}">
              <i class="layui-icon">&#xe67c;</i>添加图片
            </button>
          </div>
          <div class="layui-row layui-col-space20" id="{{$item->name}}List"></div>
        </div>
      </div>
    </div>
    @break

  @case('单文件上传')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        <div class="upload">
          <button type="button" class="layui-btn" route="{{ url('admin/file?model='.$controller.'&field='.$item->name.'&type=File') }}">
            <i class="layui-icon">&#xe67c;</i>添加文件
          </button>
        </div>
        <input type="text" name="{{$item->name}}" placeholder="请上传{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('多文件上传')
    <div class="layui-form-item d-table d-border" id="files" name="{{$item->name}}">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        <div class="d-padding-10">
          <div class="d-margin-b-10">
            <button type="button" class="layui-btn" route="{{ url('admin/file?model='.$controller.'&field='.$item->name.'&type=Files') }}">
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
            <tbody id="{{$item->name}}List"></tbody>
          </table>
        </div>
      </div>
    </div>
    @break

  @case('日期')
    <div class="layui-form-item">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-inline">
        <input type="text" name="{{$item->name}}" placeholder="请输入{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}" date>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('编辑器')
    <div class="layui-form-item d-table">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        <div id="{{$item->name}}" editor></div>
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
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
    @break

  @default
        {{$item->type}}
@endswitch