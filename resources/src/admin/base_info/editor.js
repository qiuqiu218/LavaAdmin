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
MenuConstructors.images = function (field, index, url) {
  let elem = $('<div class="w-e-menu"><i class="w-e-icon-image"><i/></div>')
  elem.on('click', function () {
    layui.layer.open({
      type: 2,
      title: '图片上传',
      shadeClose: true,
      shade: 0.8,
      area: ['60%', '90%'],
      content: url
    })
  })
  if (_menus.length - 1 === index) {
    $(`#${field} .w-e-toolbar`).append(elem)
  } else {
    $(`#${field} .w-e-toolbar .w-e-menu`).eq(index).before(elem)
  }
}



let editor = {}
$("[editor]").each(function () {
  let field = $(this).attr('id')

  let url = $(this).attr('url')
  
  // 实例化编辑器
  editor[field]  = new wangEditor('#' + field)
  // 自定义栏目
  editor[field].customConfig.menus = _menus
  // 监控变化，同步更新到 textarea
  editor[field].customConfig.onchange = function (html) {
    $(`#${field}_textarea`).val(html)
  }
  // 创建编辑器
  editor[field].create()
  // 初始化内容
  editor[field].txt.html($(`#${field}_textarea`).val())
  
  // 获得自定义的栏目
  let customMenus = _menus.filter(res => !defaultMenus.includes(res))
  // 生产自定义栏目并绑定点击事件
  customMenus.forEach(menu => {
    if (MenuConstructors[menu] && typeof MenuConstructors[menu] === 'function') {
      MenuConstructors[menu](field, _menus.findIndex(res => res === menu), url)
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

// 图片修改功能
$('.w-e-text-container').on('click', function (e) {
  let parent = $(e.target).parents('.w-e-text-container')
  if (e.target.tagName === 'IMG' && !$(e.target).attr('data-w-e')) {
    $(e.target).editorImage().onEdit()
  } else {
    $(e.target).editorImage().offEdit()
  }
})
$('.w-e-text-container').on('click', '#imageAttr', function (e) {
  e.stopPropagation()
})