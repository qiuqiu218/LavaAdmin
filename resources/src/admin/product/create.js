import cartesian from 'cartesian'

// 清空缓存
$.store.remove('product_image')

// 确认选择分类
$("#confirmSelect").click(function () {
  let product_classify_id = $("input[name='product_classify_id']").val()
  window.parent.location.href="/admin/product/create?product_classify_id=" + product_classify_id
})

// 设置库存
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
              <td title>${name.join('+')}</td>
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