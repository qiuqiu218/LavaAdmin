import './index.styl'

layui.use(['layer'], function () {
  $("#logout").click(function (event) {
    event.preventDefault()
    let href = $(this).attr('href')
    layer.confirm('您真的要退出吗?', index => {
      layer.close(index)
      window.location.href = href
    })
  })
})
