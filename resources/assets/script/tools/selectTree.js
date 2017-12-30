let _this = null, // 当前dom
    _temp = null, // 模板
    _tree = [], // 数据
    _url = '', // 数据来源
    _name = '', // 字段名称
    _form = null,
    _path = [0],
    _input = '',
    _value = 0

layui.use(['form'], function () {
  _form = layui.form
})

function init (arg) {
  _url = arg.url
  _this = $(this)
  _temp = _this.html()
  _name = _this.attr('selectTree')
  _value = _this.attr('value') ? _this.attr('value') : _value
  _input = $(`<input type="hidden" name="${_name}" value="${_value}"/>`)
  _this.after(_input)
  getData()
    .then(res => {
      initNode()
      initBind()
    })
}

function initNode () {
  _this.html('')
  _path.forEach((value, index) => {
    let collect = getCollect(0, index) // 获取当前select集合
    if (collect.length > 0 || index === 0) {
      let dom = $(_temp)
      dom
        .find('select')
        .attr({
          'lay-filter': `${_name}-item`,
          index
        })
        .append(getOption(value, collect))
      _this.append(dom)
    } else {
      _path.splice(index)
    }
  })
  _form.render('select')
  _input.val(_path[_path.length - 2])
}

function getData () {
  return new Promise((resolve, reject) => {
    let id = getInputId()
    $.get(`${_url}?id=${id}`, res => {
      _tree = res.data.tree
      if (res.data.path && Array.isArray(res.data.path)) {
        _path = res.data.path
        _path.push(0)
      }
      resolve()
    })
  })
}

function getInputId () {
  let dom = $("input[name='id']")
  let id = 0
  if (dom.length > 0) {
    id = dom.val() || id
  }
  return id
}

function getCollect (index, depth, collect) {
  if (index === 0) {
    collect = _tree
  }
  if (index === depth) {
    return collect
  } else {
    collect = collect.find(res => res.id === _path[index]).children
    return getCollect(index + 1, depth, collect)
  }
}

function getOption (value, collect) {
  if (!collect) {
    return '<option></option>'
  }
  let option = collect.map(res => {
    return `<option value="${res.id}"${value === res.id ? ' selected' : ''}>${res.title}</option>`
  })
  option.unshift(`<option></option>`)
  return option
}

function initBind () {
  _form.on(`select(${_name}-item)`, res => {
    res.value = Number(res.value)
    let index = Number($(res.elem).attr('index'))
    _path[index] = res.value
    _path.splice(index + 1)
    if (res.value > 0) {
      _path.push(0)
    }
    initNode()
  })
}

export default init
