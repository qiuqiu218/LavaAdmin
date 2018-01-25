layui.form.on('select(type)', function(data){
  if (['下拉框', '单选框'].includes(data.value)) {
    $("textarea[name='default_value']").attr('placeholder', '格式如：\n1==文本1:default\n2==文本2\n3==文本3')
  } else if(data.value === '复选框') {
    $("textarea[name='default_value']").attr('placeholder', '格式如：\n1==文本1:default\n2==文本2:default\n3==文本3')
  }
})