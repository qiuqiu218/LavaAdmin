import {getUrlParam} from '_assets/script/tools/other'
import ajax from '_assets/script/tools/ajax'

// 获取url上面的参数
let field = getUrlParam('field')
/**
 * 获取图片上传类型
 * Image 单图上传
 * Images 多图上传
 * Editor 编辑器
 */
let uploadType = getUrlParam('type')
// 初始化图片选中状态
// renderSelected()

// 每次打开清空缓存
$.store.remove(`baseInfo_input_${field}`)

// 选中/取消事件
window.selected = function (index) {
  let v = _data.data[index]
  if ($.isFunction(parent[`selected${uploadType}`])) {
    parent[`selected${uploadType}`](field, v)
  }
  if (uploadType === 'Images' || uploadType === 'Editor') {
    renderSelected()
  }
}

// 删除事件
window.deleted = function (index) {
  ajax.deleteInfo(`/admin/image/${_data.data[index].id}`, res => {
    if (res.status === 'success') {
      $("#img"+_data.data[index].id).remove()
    }
  })
}

// 确认选择
$("#submit").click(function () {
  if ($.isFunction(parent[`render${uploadType}`])) {
    parent[`render${uploadType}`](field)
  }
})

// 关闭当前窗口
function closeFrame () {
  let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(index); //再执行关闭
}

// 渲染选中/未选中的状态
function renderSelected () {
  let collect = $.store.array.get(`baseInfo_input_${field}`)
  $("#list").find('.selected').removeClass('active').children('span').text('选择')
  collect.forEach(res => {
    $("#img" + res.id).find('.selected').addClass('active').children('span').text('取消选择')
  })
}