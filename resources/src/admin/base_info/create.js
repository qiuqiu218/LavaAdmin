// 多图上传 - 图片删除
$("#images").on('click', '.deleted', function () {
  let field = $("#images").attr('name')
  let parent = $(this).parents('.layui-col-xs2')
  $.store.array.remove(`baseInfo_input_${field}`, parent.data('id'))
  parent.remove()
})

// 多文件上传 - 文件删除
$("#files").on('click', '.deleted', function () {
  let field = $("#files").attr('name')
  let parent = $(this).parents('tr')
  $.store.array.remove(`baseInfo_input_${field}`, parent.data('id'))
  parent.remove()
})

layui.laydate.render({
  elem: 'input[date]'
})