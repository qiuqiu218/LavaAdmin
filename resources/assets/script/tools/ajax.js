$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})

let _param = {
  url: '',
  type: 'get',
  contentType: 'application/json',
  dataType: 'json',
  data: {}
}

function isConfirm (msg) {
  return new Promise((resolve, reject) => {
    if (msg) {
      layer.confirm(msg, index => {
        layer.close(index)
        resolve()
      })
    } else {
      resolve()
    }
  })
}

function deleteInfo (route, callback, confirm = true) {
  isConfirm(confirm === true ? '您真的要删除吗?' : confirm)
    .then(res => ajax({
      url: route,
      success: callback,
      type: 'delete'
    }))
}

function ajax (param) {
  $.ajax(Object.assign(_param, param))
}

export default {
  deleteInfo
}