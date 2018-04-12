@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/product/'.$data->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <input type="hidden" name="id" value="{{$data->id}}">
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
            <input type="text" name="product_classify_name" class="layui-input" value="{{implode(' > ', $classifyName)}}" readonly>
            <input type="hidden" name="product_classify_id" value="{{$data->product_classify_id}}">
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
        @include('component.form.edit.text', ['name' => 'title', 'display_name' => '产品名称'])
        @include('component.form.edit.img', ['name' => 'cover_img', 'display_name' => '封面图', 'url' => 'admin/product_image'])
        <div class="layui-row layui-col-space10">
          <div class="layui-col-xs6">
            @include('component.form.edit.text', ['name' => 'original_price', 'display_name' => '原价'])
          </div>
          <div class="layui-col-xs6">
            @include('component.form.edit.text', ['name' => 'current_price', 'display_name' => '现价'])
          </div>
        </div>
        @include('component.form.edit.editor', ['name' => 'description', 'display_name' => '产品描述', 'url' => 'admin/product_image'])
      </div>
      <div class="layui-col-xs6">
        @include('component.form.edit.imgs', ['name' => 'images', 'display_name' => '图集', 'url' => 'admin/product_image'])
        <fieldset class="layui-elem-field">
          <legend>规格设置</legend>
          <div class="layui-field-box">
            <div id="specAttribute">
              @foreach ($spec as $item)
              <div class="layui-form-item" pane>
                <label class="layui-form-label">{{$item->title}}</label>
                <div class="layui-input-block">
                  @foreach ($item->values as $value)
                    <input type="checkbox" value="{{$value}}" title="{{$value}}" lay-skin="primary">
                  @endforeach
                </div>
              </div>
              @endforeach
              <input type="hidden" name="spec" value="">
            </div>
            <div>
              <button type="button" class="layui-btn" id="createSku">设置库存</button>
            </div>
            <div id="specCollect">
              <table class="layui-table">
                <colgroup>
                  <col>
                  <col width="80">
                  <col width="120">
                </colgroup>
                <thead>
                  <tr>
                    <th>规格</th>
                    <th class="d-text-center">库存</th>
                    <th class="d-text-center">操作</th>
                  </tr> 
                </thead>
                <tbody>
                  @foreach ($product_spec_item as $item)
                    <tr>
                      <td>{{$item->title}}</td>
                      <td align="center" class="store_count">
                        {{$item->store_count}}
                      </td>
                      <td align="center">
                        <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/product_spec_item/'.$item->id.'/edit') }}" callback="editProductSpecItem">编辑</button>
                        <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/product_spec_item/'.$item->id) }}" callback="deleteProductSpecItem">删除</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
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
@endsection

@section('script')
  @parent
  <script src="{{ asset('js/admin/base_info/linkage_select.js?'.time()) }}"></script>
  <script src="{{ asset('js/admin/base_info/editor.js?'.time()) }}"></script>
  <script src="{{ asset('js/admin/base_info/image.js?'.time()) }}"></script>
  <script src="{{ asset('js/admin/base_info/images.js?'.time()) }}"></script>
@endsection