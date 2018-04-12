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
/******/ 	return __webpack_require__(__webpack_require__.s = 159);
/******/ })
/************************************************************************/
/******/ ({

/***/ 159:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(49);

/***/ }),

/***/ 49:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


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

/***/ })

/******/ });