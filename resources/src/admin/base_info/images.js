$("#images").on('click', '.deleted', function () {
  let field = $("#images").attr('name')
  let parent = $(this).parents('.layui-col-xs2')
  $.store.array.remove(`baseInfo_input_${field}`, parent.data('id'))
  parent.remove()
})

window.selectedImages = function (field, data) {
  $.store.array.toggle(`baseInfo_input_${field}`, data)
}