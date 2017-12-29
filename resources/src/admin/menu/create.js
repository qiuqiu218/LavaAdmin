import selectTree from '_assets/script/tools/selectTree'

layui.use(['form'])

// $.get('/admin/getTree', res => {
//   selectTree($("[selectTree='parent_id']"), res.data)
// })
// selectTree()

$.fn.extend({
  selectTree
})

$("[selectTree]").selectTree({
  url: '/admin/getTree'
})