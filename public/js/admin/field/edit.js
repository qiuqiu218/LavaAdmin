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
/******/ 	return __webpack_require__(__webpack_require__.s = 145);
/******/ })
/************************************************************************/
/******/ ({

/***/ 145:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$("#addOption").click(function () {
  $("#optionList").append("<div class=\"layui-form-item\">\n                            <div class=\"layui-input-inline\" style=\"width: 50px\">\n                              <input type=\"text\" placeholder=\"\u503C\" class=\"layui-input value\">\n                            </div>\n                            <div class=\"layui-input-inline\" style=\"width: 100px\">\n                              <input type=\"text\" placeholder=\"\u6587\u672C\" class=\"layui-input text\">\n                            </div>\n                            <div class=\"layui-input-inline\" style=\"width: 100px\">\n                              <input type=\"checkbox\" title=\"\u9ED8\u8BA4\" value=\"1\" lay-skin=\"primary\" class=\"active\" lay-filter=\"active\">\n                            </div>\n                          </div>");
  layui.form.render('checkbox');
  $("body").css("overflow", "hidden");
  setTimeout(function () {
    $("body").css("overflow", "auto");
  }, 300);
});

layui.form.on('submit', function (data) {
  var option = [];
  $("#optionList .layui-form-item").each(function () {
    option.push({
      value: $(this).find('input.value').val(),
      text: $(this).find('input.text').val(),
      active: Number($(this).find('input.active:checked').val()) || 0
    });
  });
  option = option.filter(function (item) {
    return item.value && item.text;
  });
  $("input[name='option']").val(JSON.stringify(option));
});

var is_checkbox = $("select[name='element']").val() === '复选框' ? true : false;
layui.form.on('select(element)', function (data) {
  var field = ['下拉框', '联动下拉框', '单选框', '复选框'];
  if (field.includes(data.value)) {
    if (data.value === '复选框') {
      is_checkbox = true;
    } else {
      $("#optionList .active").prop('checked', false);
      layui.form.render('checkbox');
      is_checkbox = false;
    }
    $("#default_value").hide();
    $("#option").show();
  } else {
    $("#default_value").show();
    $("#option").hide();
  }
});

// 勾选默认
layui.form.on('checkbox(active)', function (data) {
  if (!is_checkbox) {
    $("#optionList .active").prop('checked', false);
    $(data.elem).prop('checked', true);
    layui.form.render('checkbox');
  }
});

/***/ })

/******/ });