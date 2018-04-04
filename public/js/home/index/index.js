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
/******/ 	return __webpack_require__(__webpack_require__.s = 157);
/******/ })
/************************************************************************/
/******/ ({

/***/ 157:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _ajax = __webpack_require__(48);

var _ajax2 = _interopRequireDefault(_ajax);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

$('button').click(function () {
  var username = $('input[name="username"]').val();
  var password = $('input[name="password"]').val();

  _ajax2.default.ajax({
    url: '/login',
    type: 'post',
    data: {
      username: username,
      password: password
    },
    success: function success(res) {
      console.log(res);
    }
  });
});

/***/ }),

/***/ 48:
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