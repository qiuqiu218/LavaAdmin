import ajax from '_assets/script/tools/ajax'

layui.use(['layer'], function () {

  $("button[route]").click(function () {
    let route = $(this).attr('route')
    layer.open({
      type: 2,
      title: $(this).text(),
      shadeClose: true,
      shade: 0.8,
      area: ['60%', '80%'],
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

})

// 点击菜单进行折叠或展开
$("table a").click(function () {
  let tr = $(this).parents('tr')
  let id = tr.data('id')
  let status = tr.data('status')
  if (status === 'fold') {
    tr.data('status', 'unfold')
    $(this).find('i').html('&#xe625;')
    unfoldMenu(id)
  } else {
    tr.data('status', 'fold')
    $(this).find('i').html('&#xe623;')
    foldMenu(id)
  }
})

// 折叠菜单
function foldMenu (parentId) {
  let dom = $("tr[data-parentId='" + parentId + "']")
  if (dom.length) {
    dom.addClass('layui-hide')
    dom.each(function () {
      foldMenu($(this).data('id'))
    })
  }
}

// 展开菜单
function unfoldMenu (parentId) {
  let parent = $("tr[data-id='" + parentId + "']")
  let dom = $("tr[data-parentId='" + parentId + "']")
  if (dom.length) {
    dom.each(function () {
      let status = parent.data('status')
      if (status === 'fold') {
        $(this).addClass('layui-hide')
      } else {
        $(this).removeClass('layui-hide')
      }
      unfoldMenu($(this).data('id'))
    })
  }
}