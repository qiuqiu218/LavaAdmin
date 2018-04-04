import ajax from '_assets/script/tools/ajax'

$('button').click(function () {
  var username = $('input[name="username"]').val()
  var password  = $('input[name="password"]').val()


  ajax.ajax({
    url: '/login',
    type: 'post',
    data: {
      username: username,
      password: password
    },
    success (res) {
      console.log(res)
    }
  })
})