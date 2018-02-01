$("#images").on('click', '.deleted', function () {
  let field = $("#images").attr('name')
  let parent = $(this).parents('.layui-col-xs2')
  $.store.array.remove(`baseInfo_input_${field}`, parent.data('id'))
  parent.remove()
})

window.selectedImages = function (field, data) {
  $.store.array.toggle(`baseInfo_input_${field}`, data)
}

// 渲染选中的图片到表单中
window.renderImages = function (field) {
  let collect = $.store.array.get(`baseInfo_input_${field}`)
  let data = collect.map(res => {
    return `<div class="layui-col-xs2" data-id="${res.id}">
              <div class="square">
                <div class="square-img">
                  <img src="${res.path}">
                  <div class="mask">
                    <div class="d-text-right">
                      <a href="javascript:;" class="deleted"><i class="layui-icon">&#xe640;</i>删除</a>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="${field}[]" value="${res.path}">
              </div>
            </div>`
  })
  $(`#${field}List`).html(data)
  layer.close(layer.index)
}