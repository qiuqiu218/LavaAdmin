let _sec = 3,
    _jumpUrl = '',
    _autoClose = false,
    _this = null

function init (arg) {
  _this = $(this)
  _sec = arg.sec
  _jumpUrl = arg.jumpUrl
  _autoClose = arg.autoClose
  _this.click(function (event) {
    event.preventDefault()
    gotoJumpUrl()
  })
  countDown()
}

function autoClose () {
  if (window.self.location.toString() !== window.top.location.toString()) { // 如果当前页面是在框架内打开的
    window.parent.location.reload()
    let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
    parent.layer.close(index); //再执行关闭
  }
}

function gotoJumpUrl (href) {
  if (_autoClose) { // 如果需要自动关闭
    autoClose()
  } else if (_jumpUrl) {
    window.location.href = _jumpUrl
  } else {
    history.back()
  }
}

function countDown () {
  if (_sec !== 0) {
    setTimeout(function () {
      $("#sec").text(--_sec)
      countDown()
    }, 1000)
  } else {
    gotoJumpUrl()
  }
}

export default init