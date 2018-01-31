/**
 * 渲染图片字段
 * @param {字段名} field 
 * @param {选择的数据} data 
 */
window.selectedFile = function (field, data) {
  $('input[name="'+field+'"]').val(data.path)
  layer.close(layer.index)
}