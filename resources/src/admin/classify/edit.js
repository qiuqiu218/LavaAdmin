import selectTree from '_assets/script/tools/selectTree'

layui.use(['form'])

$.fn.extend({
  selectTree
})

let table_id = $("input[name='table_id']").val()
let id = $("input[name='id']").val()

$("[selectTree]").selectTree({
  url: `/admin/classify/getTree?table_id=${table_id}&id=${id}`
})