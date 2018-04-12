import ajax from '_assets/script/tools/ajax'

window.iframeData = null

$("button[route]").click(function () {
  let route = $(this).attr('route')
  let callback = $(this).attr('callback')
  let _this = this
  layui.layer.open({
    type: 2,
    title: $(this).text(),
    shadeClose: true,
    shade: 0.8,
    area: ['60%', '90%'],
    content: route,
    end () {
      if (callback) {
        if ($.isFunction(window[callback])) {
          window[callback](window.iframeData, _this)
        }
      }
    }
  })
})

$("button[url]").click(function () {
  let url = $(this).attr('url')
  let confirm = $(this).attr('confirm')
  let callback = $(this).attr('callback')
  ajax.deleteInfo(url, res => {
    if (callback) {
      if ($.isFunction(window[callback])) {
        window[callback](res, this)
      }
    } else {
      location.reload()
    }
  }, confirm)
})