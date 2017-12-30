import selectTree from '_assets/script/tools/selectTree'

layui.use(['form'])

$.fn.extend({
  selectTree
})

$("[selectTree]").selectTree({
  url: '/admin/getTree'
})