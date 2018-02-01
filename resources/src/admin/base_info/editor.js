import wangEditor from 'wangeditor'
import '_assets/script/project/editor/image'

let defaultMenus = [
  'head',  // 标题
  'bold',  // 粗体
  'italic',  // 斜体
  'underline',  // 下划线
  'strikeThrough',  // 删除线
  'foreColor',  // 文字颜色
  'backColor',  // 背景颜色
  'link',  // 插入链接
  'list',  // 列表
  'justify',  // 对齐方式
  'quote',  // 引用
  'emoticon',  // 表情
  'image',  // 插入图片
  'table',  // 表格
  'video',  // 插入视频
  'code',  // 插入代码
  'undo',  // 撤销
  'redo'  // 重复
]

let MenuConstructors = {}
// 生成图片按钮并绑定事件
MenuConstructors.images = function (id, index) {
  let elem = $('<div class="w-e-menu"><i class="w-e-icon-image"><i/></div>')
  elem.on('click', function () {
    layui.layer.open({
      type: 2,
      title: '图片上传',
      shadeClose: true,
      shade: 0.8,
      area: ['60%', '90%'],
      content: `/admin/image?field=${id}&type=Editor`
    })
  })
  if (_menus.length - 1 === index) {
    $(`#${id} .w-e-toolbar`).append(elem)
  } else {
    $(`#${id} .w-e-toolbar .w-e-menu`).eq(index).before(elem)
  }
}



let editor = {}
$("[editor]").each(function () {
  let id = $(this).attr('id')
  editor[id]  = new wangEditor('#' + id)
  editor[id].customConfig.menus = _menus
  editor[id].create()
  
  // 获得自定义的栏目
  let customMenus = _menus.filter(res => !defaultMenus.includes(res))
  // 生产自定义栏目并绑定点击事件
  customMenus.forEach(menu => {
    if (MenuConstructors[menu] && typeof MenuConstructors[menu] === 'function') {
      MenuConstructors[menu](id, _menus.findIndex(res => res === menu))
    }
  })
})

// 选择图片后执行的事件
window.selectedEditor = function (field, data) {
  $.store.array.toggle(`baseInfo_input_${field}`, data)
}

// 渲染选中的图片到编辑器中
window.renderEditor = function (field) {
  let collect = $.store.array.get(`baseInfo_input_${field}`)
  let data = collect.map(res => {
    return `<p><img src="${res.path}" alt="${res.name}" width="100%"/></p>`
  })
  editor[field].cmd.do('insertHtml', data.join(''))
  layer.close(layer.index)
}