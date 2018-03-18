import selectTree from '_assets/script/tools/selectTree'

layui.use(['form'])

$.fn.extend({
  selectTree
})

$("[selectTree]").selectTree({
  tree: window._classify,
  path: window._classify_path
})