@extends('layouts.default')

@section('content')
<form class="layui-form layui-form-pane" action="{{url('admin/product')}}" method="post">
  {{ csrf_field() }}
  <div class="layui-footer d-text-center">
    <button class="layui-btn" lay-submit>确认添加</button>
    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
  </div>
  <div class="d-padding-10">
    <div class="layui-row layui-col-space20">
      <div class="layui-col-xs6">
        @include('component.form.create.linkage_select', ['name' => 'product_classify_id', 'display_name' => '产品分类', 'classify' => []])
        @include('component.form.create.text', ['name' => 'title', 'display_name' => '产品名称'])
        @include('component.form.create.img', ['name' => 'cover_img', 'display_name' => '封面图', 'controller' => 'product'])
        <div class="layui-row layui-col-space10">
          <div class="layui-col-xs6">
            @include('component.form.create.text', ['name' => 'original_price', 'display_name' => '原价'])
          </div>
          <div class="layui-col-xs6">
            @include('component.form.create.text', ['name' => 'current_price', 'display_name' => '现价'])
          </div>
        </div>
        <fieldset class="layui-elem-field">
          <legend>规格设置</legend>
          <div class="layui-field-box">
            内容区域
          </div>
        </fieldset>
      </div>
      <div class="layui-col-xs6">
        @include('component.form.create.imgs', ['name' => 'images', 'display_name' => '图集', 'controller' => 'product'])
        @include('component.form.create.editor', ['name' => 'description', 'display_name' => '产品描述'])
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