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
          <button type="button" class="layui-btn" route="{{ url('admin/image?field='.$item->name.'&type=1') }}">
            <i class="layui-icon">&#xe67c;</i>添加图片
          </button>
        </div>
        <input type="text" name="{{$item->name}}" placeholder="请上传{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('多图上传')
    <div class="layui-form-item d-table" id="images" name="{{$item->name}}">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        <div class="d-padding-10">
          <div class="d-margin-b-10">
            <button type="button" class="layui-btn" route="{{ url('admin/image?field='.$item->name.'&type=2') }}">
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
          <button type="button" class="layui-btn" route="{{ url('admin/file?field='.$item->name.'&type=1') }}">
            <i class="layui-icon">&#xe67c;</i>添加文件
          </button>
        </div>
        <input type="text" name="{{$item->name}}" placeholder="请上传{{$item->display_name}}" class="layui-input" value="{{old($item->name)}}">
      </div>
      <div class="layui-form-mid layui-word-aux">{{$errors->first($item->name)}}</div>
    </div>
    @break

  @case('多文件上传')
    <div class="layui-form-item d-table" id="files" name="{{$item->name}}">
      <label class="layui-form-label">{{$item->display_name}}</label>
      <div class="layui-input-block">
        <div class="d-padding-10">
          <div class="d-margin-b-10">
            <button type="button" class="layui-btn" route="{{ url('admin/file?field='.$item->name.'&type=2') }}">
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

  @default
        {{$item->type}}
@endswitch