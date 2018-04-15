layui.form.on('submit', function (data) {
  if (data.elem.tagName === 'BUTTON') {
    $("#status").val($(data.elem).text())
  }
})