<div class="layui-footer d-text-center">
  <button class="layui-btn" id="confirmSelect">确认</button>
  <button type="reset" class="layui-btn layui-btn-primary">重置</button>
</div>
<div class="d-padding-10">
  <blockquote class="layui-elem-quote">请先选择产品分类</blockquote>
  @include('component.form.create.linkage_select', ['name' => 'product_classify_id', 'display_name' => '产品分类', 'classify' => $classify])
</div>