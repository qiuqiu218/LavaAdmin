import './login.styl'
import ajax from '_assets/script/tools/ajax'

if (window.self.location.toString() !== window.top.location.toString()) { // 如果当前页面是在框架内打开的
  window.parent.location.reload()
}

$("button").click(function () {
  let username = $('input[name="username"]').val()
  let password  = $('input[name="password"]').val()

  ajax.ajax({
    url: '/api/login',
    type: 'post',
    data: {
      username: username,
      password: password,
      // grant_type: 'password',
      // client_id: 2,
      // client_secret: 'IK64G83Gpha5a5CD9gHK1LPypnWKwgbCFSJwhfrK'
    },
    success (res) {
      console.log(res)
    }
  })
})