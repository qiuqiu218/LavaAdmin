import './create.styl'

$("#openCollect").click(function () {
  $("#form,#formBtn").addClass('layui-hide')
  $("#collect,#collectBtn").removeClass('layui-hide')
})

$("#closeCollect").click(function () {
  $("#form,#formBtn").removeClass('layui-hide')
  $("#collect,#collectBtn").addClass('layui-hide')
})

$("#openItem").click(addItem)

$("#deleteItem").click(function () {
  $("#collect").find('.checked:checked').each(function () {
    $(this).parents('.layui-form-item').remove()
  })
})

function addItem () {
  $("#collect").append($("#collectTemplate").html())
  layui.form.render('checkbox')
}
addItem()
