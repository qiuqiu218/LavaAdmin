import selectTree from '_assets/script/tools/selectTree'

layui.use(['form'])

$.fn.extend({
  selectTree
})

let id = $("input[name='id']").val()

$("[selectTree]").selectTree({
  url: `/admin/getTree?id=${id}`
})