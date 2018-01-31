import wangEditor from 'wangeditor'

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

function Images (id, index) {
  let elem = $('<div class="w-e-menu"><i class="w-e-icon-image"><i/></div>')
  elem.on('click', function () {
    layui.layer.open({
      type: 2,
      title: '图片上传',
      shadeClose: true,
      shade: 0.8,
      area: ['60%', '90%'],
      content: `/admin/image?field=${id}&type=3`
    })
  })
  if (_menus.length - 1 === index) {
    $(`#${id} .w-e-toolbar`).append(elem)
  } else {
    $(`#${id} .w-e-toolbar .w-e-menu`).eq(index).before(elem)
  }
}
let MenuConstructors = {}
MenuConstructors.images = Images


let editor = {}
$("[editor]").each(function () {
  let id = $(this).attr('id')
  editor[id]  = new wangEditor('#' + id)
  editor[id].customConfig.menus = _menus
  editor[id].create()
  let customMenus = _menus.filter(res => !defaultMenus.includes(res))
  customMenus.forEach(menu => {
    if (MenuConstructors[menu] && typeof MenuConstructors[menu] === 'function') {
      MenuConstructors[menu](id, _menus.findIndex(res => res === menu))
    }
  })
})


// w-e-icon-image