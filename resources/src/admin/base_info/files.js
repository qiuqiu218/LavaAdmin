$("#files").on('click', '[deleted]', function () {
  let parent = $(this).parents('tr')
  parent.remove()
})

window.selectedFiles = function (field, data) {
  $.store.array.toggle(`baseInfo_input_${field}`, data)
}

// 渲染选中的图片到表单中
window.renderFiles = function (field) {
  let collect = $.store.array.get(`baseInfo_input_${field}`)
  let data = collect.map(res => {
    return `<tr>
              <td>${res.name}</td>
              <td>${res.mime}</td>
              <td>${(res.size / 1000).toFixed(1)}KB</td>
              <td>
                <a href="javascript:;" deleted><i class="layui-icon">&#xe640;</i>删除</a>
                <input type="hidden" name="${field}[]" value="${res.id}">
              </td>
            </tr>`
  })
  if (data.length > 0) {
    $(`#${field}List`).append(data)
  }
  layer.close(layer.index)
}