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
/******/ 	return __webpack_require__(__webpack_require__.s = 134);
/******/ })
/************************************************************************/
/******/ ({

/***/ 134:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$("#images").on('click', '.deleted', function () {
  var field = $("#images").attr('name');
  var parent = $(this).parents('.layui-col-xs2');
  $.store.array.remove('baseInfo_input_' + field, parent.data('id'));
  parent.remove();
});

window.selectedImages = function (field, data) {
  $.store.array.toggle('baseInfo_input_' + field, data);
};

// 渲染选中的图片到表单中
window.renderImages = function (field) {
  var collect = $.store.array.get('baseInfo_input_' + field);
  var data = collect.map(function (res) {
    return '<div class="layui-col-xs2" data-id="' + res.id + '">\n              <div class="square">\n                <div class="square-img">\n                  <img src="' + res.path + '">\n                  <div class="mask">\n                    <div class="d-text-right">\n                      <a href="javascript:;" class="deleted"><i class="layui-icon">&#xe640;</i>\u5220\u9664</a>\n                    </div>\n                  </div>\n                </div>\n                <input type="hidden" name="' + field + '[]" value="' + res.path + '">\n              </div>\n            </div>';
  });
  $('#' + field + 'List').html(data);
  layer.close(layer.index);
};

/***/ })

/******/ });