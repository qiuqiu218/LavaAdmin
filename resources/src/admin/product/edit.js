import cartesian from 'cartesian'

// 清空缓存
$.store.remove('product_image')

$("#createSku").click(function () {
  let data = []
  window._spec.forEach((res, index) => {
    let arr = $("#specAttribute .layui-form-item").eq(index).find('input:checked').map(function (index, item) {
      return {
        name: res.name,
        text: $(item).val()
      }
    }).get()
    data.push(arr)
  })
  // 去除数组长度为0的数据
  data = data.filter(res => res.length > 0)
  let spec_collect = cartesian(data)
  $("#specCollect").append(createSpec(spec_collect).join(''))
})

function createSpec (collect) {
  return collect.filter(res => {
    let name = res.map(item => item.text)
    return !$("#specCollect").text().includes(name.join('+'))
  }).map(res => {
    let name = res.map(item => item.text)
    let obj = res.map(item => {
      return {
        [item.name]: item.text
      }
    }).reduce((accumulator, item) => {
      return Object.assign(accumulator, item)
    })
    
    return `<tr create>
              <td title>${name.join('+')}</td>
              <td>
                <input type="text" class="layui-input">
                <input type="hidden" value='${JSON.stringify(obj)}'>
              </td>
              <td>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" onclick="deleteProductSpecItem(null, this)">删除</button>
              </td>
            </tr>`
  })
}

layui.form.on('submit', function () {
  // 设置spec属性
  let data = []
  window._spec.forEach((res, index) => {
    let arr = $("#specAttribute .layui-form-item").eq(index).find('input:checked').map(function (index, item) {
      return $(item).val()
    }).get()
    data.push({
      name: res.name,
      title: res.title,
      collect: arr
    })
  })
  $("input[name='spec']").val(JSON.stringify(data))

  // 设置spec集合
  let specCollect = []
  $("#specCollect tr[create]").each(function () {
    specCollect.push({
      store_count: $(this).find('input[type="text"]').val(),
      title: $(this).find('td[title]').text(),
      spec_collect: JSON.parse($(this).find('input[type="hidden"]').val())
    })
  })
  $("input[name='product_spec_items']").val(JSON.stringify(specCollect))
})

// spec_item 删除完成事件
window.deleteProductSpecItem = function (res, elem) {
  $(elem).parents('tr').remove()
}

window.editProductSpecItem = function (res, elem) {
  $(elem).parents('tr').find("td.store_count").text(res.store_count)
}