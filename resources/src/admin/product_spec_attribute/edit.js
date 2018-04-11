$("#addItem").click(function () {
  let _this = this
  layui.layer.prompt({
    title: '属性值'
  }, function (value, index) {
    $(_this).before(`<div class="d-border d-padding-5 layui-inline d-margin-b-5 d-margin-r-5">
                      <input type="hidden" name="values[]" value="${value}">
                      ${value}
                      <a href="javascript:;" class="deleteItem"><i class="layui-icon">&#x1006;</i></a>
                    </div>`)
    layer.close(index)
  })
})

$("body").on('click', '.deleteItem', function () {
  let _this = this
  layui.layer.confirm('您真的要删除吗?', function (index) {
    $(_this).parent().remove()
    layer.close(index)
  })
})