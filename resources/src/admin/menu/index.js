layui.use(['layer'], function () {

  $("button[edit]").click(function () {
    let route = $(this).attr('route')
    layer.open({
      type: 2,
      title: '编辑',
      shadeClose: true,
      shade: 0.8,
      area: ['60%', '80%'],
      content: route
    })
  })
})

