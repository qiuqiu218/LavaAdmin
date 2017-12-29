layui.use(['layer'], function () {

  $("button").click(function () {
    layer.open({
      type: 2,
      title: '创建系统菜单',
      shadeClose: true,
      shade: 0.8,
      area: ['60%', '80%'],
      content: '/admin/menu/create'
    })
  })
})

