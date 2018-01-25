import {getUrlParam} from '_assets/script/tools/other'
import ajax from '_assets/script/tools/ajax'

// 获取url上面的参数
let field = getUrlParam('field')
// 获取上传类型 1=单文件2=多文件
let uploadType = Number(getUrlParam('type'))
// 初始化图片选中状态
renderSelected()

// 选中/取消事件
window.selected = function (index) {
  let v = _data.data[index]
  if (uploadType === 1) {
    $('input[name="'+field+'"]', window.parent.document).val(v.path)
    closeFrame()
  } else {
    $.store.array.toggle(`baseInfo_input_${field}`, v)
    renderSelected()
  }
}

// 删除事件
window.deleted = function (index) {
  ajax.deleteInfo(`/admin/file/${_data.data[index].id}`, res => {
    if (res.status === 'success') {
      $("#file"+_data.data[index].id).remove()
    }
  })
}

// 确认选择
$("#submit").click(function () {
  renderImages()
  closeFrame()
})

// 关闭当前窗口
function closeFrame () {
  let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(index); //再执行关闭
}

// 渲染选中/未选中的状态
function renderSelected () {
  let collect = $.store.array.get(`baseInfo_input_${field}`)
  $("table").find('.selected').removeClass('d-font-main').text('选择')
  collect.forEach(res => {
    $("#file" + res.id).find('.selected').addClass('d-font-main').text('取消选择')
  })
}

// 渲染选中的图片到表单中
function renderImages () {
  let collect = $.store.array.get(`baseInfo_input_${field}`)
  let data = collect.map(res => {
    return `<tr data-id="${res.id}">
              <td>${res.name}</td>
              <td>${res.mime}</td>
              <td>${(res.size / 1000).toFixed(1)}KB</td>
              <td>
                <a href="javascript:;" class="deleted"><i class="layui-icon">&#xe640;</i>删除</a>
                <input type="hidden" name="${field}[]" value="${res.path}">
              </td>
            </tr>`
  })
  $(`#${field}List`, window.parent.document).html(data)
}