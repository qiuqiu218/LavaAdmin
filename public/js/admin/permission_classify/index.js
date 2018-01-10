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
/******/ 	return __webpack_require__(__webpack_require__.s = 142);
/******/ })
/************************************************************************/
/******/ ({

/***/ 142:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(18);

/***/ }),

/***/ 18:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _ajax = __webpack_require__(19);

var _ajax2 = _interopRequireDefault(_ajax);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

layui.use(['layer'], function () {

  $("button[route]").click(function () {
    var route = $(this).attr('route');
    layer.open({
      type: 2,
      title: $(this).text(),
      shadeClose: true,
      shade: 0.8,
      area: ['60%', '80%'],
      content: route
    });
  });

  $("button[url]").click(function () {
    var url = $(this).attr('url');
    var confirm = $(this).attr('confirm');
    _ajax2.default.deleteInfo(url, function (res) {
      location.reload();
    }, confirm);
  });
});

// 点击菜单进行折叠或展开
$("table a").click(function () {
  var tr = $(this).parents('tr');
  var id = tr.data('id');
  var status = tr.data('status');
  if (status === 'fold') {
    tr.data('status', 'unfold');
    $(this).find('i').html('&#xe625;');
    unfoldMenu(id);
  } else {
    tr.data('status', 'fold');
    $(this).find('i').html('&#xe623;');
    foldMenu(id);
  }
});

// 折叠菜单
function foldMenu(parentId) {
  var dom = $("tr[data-parentId='" + parentId + "']");
  if (dom.length) {
    dom.addClass('layui-hide');
    dom.each(function () {
      foldMenu($(this).data('id'));
    });
  }
}

// 展开菜单
function unfoldMenu(parentId) {
  var parent = $("tr[data-id='" + parentId + "']");
  var dom = $("tr[data-parentId='" + parentId + "']");
  if (dom.length) {
    dom.each(function () {
      var status = parent.data('status');
      if (status === 'fold') {
        $(this).addClass('layui-hide');
      } else {
        $(this).removeClass('layui-hide');
      }
      unfoldMenu($(this).data('id'));
    });
  }
}

/***/ }),

/***/ 19:
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
  contentType: 'application/json',
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
    return ajax({
      url: route,
      success: callback,
      type: 'delete'
    });
  });
}

function ajax(param) {
  $.ajax(Object.assign(_param, param));
}

exports.default = {
  deleteInfo: deleteInfo
};

/***/ })

/******/ });