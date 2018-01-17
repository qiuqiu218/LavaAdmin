$(".layui-form").on('keyup', 'textarea', function () {
  let wordCount = $(this).siblings('.word-count')
  if (wordCount.length > 0) {
    wordCount.children('span').text($(this).val().length)
  }
})