<form class="layui-form layui-form-pane" action="{{url('admin/product')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="id" value="0">
  <input type="hidden" name="product_image" value="">
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    <div class="layui-row layui-col-space20">
      <div class="layui-col-xs6">
        <div class="layui-form-item">
          <label class="layui-form-label">产品分类</label>
          <div class="layui-input-block">
            <input type="text" name="product_classify_name" class="layui-input" value="{{implode(' > ', $classify['pathName'])}}" readonly>
            <input type="hidden" name="product_classify_id" value="{{$product_classify_id}}">
            <div class="upload">
              <button type="button" class="layui-btn" route="{{ url('admin/product/create') }}">
                <i class="layui-icon">&#xe642;</i>修改
              </button>
            </div>
          </div>
          @if ($errors->first('product_classify_name'))
          <div class="layui-form-mid layui-word-aux">{{$errors->first('product_classify_name')}}</div>
          @endif
        </div>
        @include('component.form.create.text', ['name' => 'title', 'display_name' => '产品名称'])
        @include('component.form.create.image', ['name' => 'cover_img', 'display_name' => '封面图', 'url' => 'admin/product_image'])
        <div class="layui-row layui-col-space10">
          <div class="layui-col-xs6">
            @include('component.form.create.text', ['name' => 'original_price', 'display_name' => '原价'])
          </div>
          <div class="layui-col-xs6">
            @include('component.form.create.text', ['name' => 'current_price', 'display_name' => '现价'])
          </div>
        </div>
        @include('component.form.create.editor', ['name' => 'description', 'display_name' => '产品描述', 'url' => 'admin/product_image'])
      </div>
      <div class="layui-col-xs6">
        @include('component.form.create.images', ['name' => 'images', 'display_name' => '图集', 'url' => 'admin/product_image'])
        <fieldset class="layui-elem-field">
          <legend>规格设置</legend>
          <div class="layui-field-box">
            <div id="specAttribute">
              @foreach ($spec as $item)
              <div class="layui-form-item" pane>
                <label class="layui-form-label">{{$item->title}}</label>
                <div class="layui-input-block">
                  @foreach ($item->product_spec_attribute_value_table as $value)
                    <input type="checkbox" value="{{$value->title}}" title="{{$value->title}}" lay-skin="primary">
                  @endforeach
                </div>
              </div>
              @endforeach
              <input type="hidden" name="spec" value="">
            </div>
            <div>
              <button type="button" class="layui-btn" id="createSku">设置库存</button>
            </div>
            <div id="specCollect"></div>
            <input type="hidden" name="product_spec_items" value="">
            <script>
            var _spec = @json($spec)
            </script>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
</form>