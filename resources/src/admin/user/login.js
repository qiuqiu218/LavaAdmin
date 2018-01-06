import './login.styl'

if (window.self.location.toString() !== window.top.location.toString()) { // 如果当前页面是在框架内打开的
  window.parent.location.reload()
}