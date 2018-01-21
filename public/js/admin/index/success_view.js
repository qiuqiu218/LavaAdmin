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
/******/ 	return __webpack_require__(__webpack_require__.s = 132);
/******/ })
/************************************************************************/
/******/ ({

/***/ 132:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _redirect = __webpack_require__(64);

var _redirect2 = _interopRequireDefault(_redirect);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

$.fn.extend({ redirect: _redirect2.default });

$("#jump").redirect({
  sec: $("#sec").text(),
  jumpUrl: $("#jump").attr('href'),
  autoClose: _autoClose
});

/***/ }),

/***/ 64:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
var _sec = 3,
    _jumpUrl = '',
    _autoClose = false,
    _this = null;

function init(arg) {
  _this = $(this);
  _sec = arg.sec;
  _jumpUrl = arg.jumpUrl;
  _autoClose = arg.autoClose;
  _this.click(function (event) {
    event.preventDefault();
    gotoJumpUrl();
  });
  countDown();
}

function autoClose() {
  if (window.self.location.toString() !== window.top.location.toString()) {
    // 如果当前页面是在框架内打开的
    window.parent.location.reload();
    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
    parent.layer.close(index); //再执行关闭
  }
}

function gotoJumpUrl(href) {
  if (_autoClose) {
    // 如果需要自动关闭
    autoClose();
  } else if (_jumpUrl) {
    window.location.href = _jumpUrl;
  } else {
    history.back();
  }
}

function countDown() {
  if (_sec !== 0) {
    setTimeout(function () {
      $("#sec").text(--_sec);
      countDown();
    }, 1000);
  } else {
    gotoJumpUrl();
  }
}

exports.default = init;

/***/ })

/******/ });