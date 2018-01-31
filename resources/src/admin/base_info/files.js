$("#files").on('click', '.deleted', function () {
  let field = $("#files").attr('name')
  let parent = $(this).parents('tr')
  $.store.array.remove(`baseInfo_input_${field}`, parent.data('id'))
  parent.remove()
})