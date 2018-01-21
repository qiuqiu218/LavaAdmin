import ajax from '_assets/script/tools/ajax'

$("button[route]").click(function () {
  let route = $(this).attr('route')
  layui.layer.open({
    type: 2,
    title: $(this).text(),
    shadeClose: true,
    shade: 0.8,
    area: ['60%', '90%'],
    content: route
  })
})

$("button[url]").click(function () {
  let url = $(this).attr('url')
  let confirm = $(this).attr('confirm')
  ajax.deleteInfo(url, res => {
    location.reload()
  }, confirm)
})