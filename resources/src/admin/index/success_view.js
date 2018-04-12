import redirect from '_assets/script/tools/redirect'

$.fn.extend({redirect})

$("#jump").redirect({
  sec: $("#sec").text(),
  jumpUrl: $("#jump").attr('href'),
  autoClose: _autoClose,
  data: _data,
  reload: _reload
})