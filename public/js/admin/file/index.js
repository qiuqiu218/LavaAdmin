/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 147);
/******/ })
/************************************************************************/
/******/ ({

/***/ 147:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _other = __webpack_require__(19);

var _ajax = __webpack_require__(20);

var _ajax2 = _interopRequireDefault(_ajax);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// 获取url上面的参数
var field = (0, _other.getUrlParam)('field');
/**
 * 获取图片上传类型
 * File 单文件上传
 * Files 多文件上传
 * Editor 编辑器
 */
var uploadType = (0, _other.getUrlParam)('type');
// 初始化图片选中状态
// renderSelected()

// 每次打开清空缓存
$.store.remove('baseInfo_input_' + field);

// 选中/取消事件
window.selected = function (index) {
  var v = _data.data[index];
  if ($.isFunction(parent['selected' + uploadType])) {
    parent['selected' + uploadType](field, v);
  }
  if (uploadType === 'Files') {
    renderSelected();
  }
};

// 删除事件
window.deleted = function (index) {
  _ajax2.default.deleteInfo('/admin/file/' + _data.data[index].id, function (res) {
    if (res.status === 'success') {
      $("#file" + _data.data[index].id).remove();
    }
  });
};

// 确认选择
$("#submit").click(function () {
  if ($.isFunction(parent['render' + uploadType])) {
    parent['render' + uploadType](field);
  }
});

// 关闭当前窗口
function closeFrame() {
  var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(index); //再执行关闭
}

// 渲染选中/未选中的状态
function renderSelected() {
  var collect = $.store.array.get('baseInfo_input_' + field);
  $("table").find('.selected').removeClass('d-font-main').text('选择');
  collect.forEach(function (res) {
    $("#file" + res.id).find('.selected').addClass('d-font-main').text('取消选择');
  });
}

// 渲染选中的图片到表单中
function renderImages() {
  var collect = $.store.array.get('baseInfo_input_' + field);
  var data = collect.map(function (res) {
    return '<tr data-id="' + res.id + '">\n              <td>' + res.name + '</td>\n              <td>' + res.mime + '</td>\n              <td>' + (res.size / 1000).toFixed(1) + 'KB</td>\n              <td>\n                <a href="javascript:;" class="deleted"><i class="layui-icon">&#xe640;</i>\u5220\u9664</a>\n                <input type="hidden" name="' + field + '[]" value="' + res.path + '">\n              </td>\n            </tr>';
  });
  $('#' + field + 'List', window.parent.document).html(data);
}

/***/ }),

/***/ 19:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.getUrlParam = getUrlParam;
function getUrlParam(name) {
  var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
  var r = window.location.search.substr(1).match(reg);
  if (r != null) {
    return unescape(r[2]);
  }
  return null;
}

/***/ }),

/***/ 20:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

var _param = {
  url: '',
  type: 'get',
  dataType: 'json',
  data: {}
};

function isConfirm(msg) {
  return new Promise(function (resolve, reject) {
    if (msg) {
      layer.confirm(msg, function (index) {
        layer.close(index);
        resolve();
      });
    } else {
      resolve();
    }
  });
}

function deleteInfo(route, callback) {
  var confirm = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;

  isConfirm(confirm === true ? '您真的要删除吗?' : confirm).then(function (res) {
    return layer.load();
  }).then(function (index) {
    return ajax({
      url: route,
      success: function success(res) {
        layer.close(index);
        callback(res);
      },
      type: 'delete'
    });
  });
}

function ajax(param) {
  $.ajax(Object.assign(_param, param));
}

exports.default = {
  deleteInfo: deleteInfo,
  ajax: ajax
};

/***/ })

/******/ });