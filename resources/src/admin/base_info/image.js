/**
 * 渲染图片字段
 * @param {字段名} field 
 * @param {选择的数据} data 
 */
window.selectedImage = function (field, data) {
  $('input[name="'+field+'"]').val(data.path)
  layer.close(layer.index)
  $.store.array.set('product_image', data.id)
}