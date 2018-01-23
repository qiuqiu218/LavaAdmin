import {getUrlParam} from '_assets/script/tools/other'

let field = getUrlParam('field')
window.selected = function (index) {
  let path = _data[index].path
  $('input[name="'+field+'"]', window.parent.document).val(path)
  let frameIndex = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(frameIndex); //再执行关闭
}