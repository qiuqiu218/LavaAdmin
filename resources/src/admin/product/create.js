import cartesian from 'cartesian'

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
      spec_collect: JSON.parse($(this).find('input[type="hidden"]').val())
    })
  })
  $("input[name='product_spec_items']").val(JSON.stringify(specCollect))
})