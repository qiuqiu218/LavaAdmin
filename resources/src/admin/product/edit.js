import cartesian from 'cartesian'

// 清空缓存
$.store.remove('product_image')

$("#confirmSelect").click(function () {
  let product_classify_id = $("input[name='product_classify_id']").val()
  window.parent.location.href="/admin/product/create?product_classify_id=" + product_classify_id
})

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
  let spec_collect = cartesian(data)
  $("#specCollect").html(`
        <table class="layui-table">
          <colgroup>
            <col>
            <col width="100">
          </colgroup>
          <thead>
            <tr>
              <th>规格</th>
              <th>库存</th>
            </tr> 
          </thead>
          <tbody>
            ${createSpec(spec_collect).join('')}
          </tbody>
        </table>`)
})

function createSpec (collect) {
  return collect.map(res => {
    let name = res.map(item => item.text)
    let obj = res.map(item => {
      return {
        [item.name]: item.text
      }
    }).reduce((accumulator, item) => {
      return Object.assign(accumulator, item)
    })
    return `<tr>
              <td>${name.join('+')}</td>
              <td>
                <input type="text" class="layui-input">
                <input type="hidden" value='${JSON.stringify(obj)}'>
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
  $("#specCollect tbody tr").each(function () {
    specCollect.push({
      store_count: $(this).find('input[type="text"]').val(),
      title: $(this).find('td[title]').text(),
      spec_collect: JSON.parse($(this).find('input[type="hidden"]').val())
    })
  })
  $("input[name='product_spec_items']").val(JSON.stringify(specCollect))

  // 设置图片上传
  $("input[name='product_image']").val(JSON.stringify($.store.array.get('product_image')))
})

// spec_item 删除完成事件
window.deleteProductSpecItem = function (res, elem) {
  $(elem).parents('tr').remove()
}

window.editProductSpecItem = function (res, elem) {
  $(elem).parents('tr').find("td.store_count").text(res.store_count)
}