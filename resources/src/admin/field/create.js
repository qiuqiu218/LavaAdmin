let optionItem = $("#optionList").html()

$("#addOption").click(function () {
  $("#optionList").append(optionItem)
  layui.form.render('checkbox')
  $("body").css("overflow", "hidden")
  setTimeout(() => {
    $("body").css("overflow", "auto")
  }, 300)
})

layui.form.on('submit', function (data) {
  let option = []
  $("#optionList .layui-form-item").each(function () {
    option.push({
      value: $(this).find('input.value').val(),
      text: $(this).find('input.text').val(),
      active: Number($(this).find('input.active:checked').val()) || 0
    })
  })
  option = option.filter(item => item.value && item.text)
  $("input[name='option']").val(JSON.stringify(option))
})

let is_checkbox = false
layui.form.on('select(element)', function (data) {
  let field = ['下拉框', '联动下拉框', '单选框', '复选框']
  if (field.includes(data.value)) {
    if (data.value === '复选框') {
      is_checkbox = true
    } else {
      $("#optionList .active").prop('checked', false)
      layui.form.render('checkbox')
      is_checkbox = false
    }
    $("#default_value").hide()
    $("#option").show()
  } else {
    $("#default_value").show()
    $("#option").hide()
  }
})

// 勾选默认
layui.form.on('checkbox(active)', function(data){
  if (!is_checkbox) {
    $("#optionList .active").prop('checked', false)
    $(data.elem).prop('checked', true)
    layui.form.render('checkbox')
  }
})