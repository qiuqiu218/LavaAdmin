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
/******/ 	return __webpack_require__(__webpack_require__.s = 130);
/******/ })
/************************************************************************/
/******/ ({

/***/ 129:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
var _this = null,
    // 当前dom
_temp = null,
    // 模板
_tree = [],
    // 数据
_url = '',
    // 数据来源
_name = '',
    // 字段名称
_form = null,
    _path = [0],
    _input = '',
    _value = 0;

layui.use(['form'], function () {
  _form = layui.form;
});

function init(arg) {
  _url = arg.url;
  _this = $(this);
  _temp = _this.html();
  _name = _this.attr('selectTree');
  _value = _this.attr('value') ? _this.attr('value') : _value;
  _input = $('<input type="hidden" name="' + _name + '" value="' + _value + '"/>');
  _this.after(_input);
  getData().then(function (res) {
    initNode();
    initBind();
  });
}

function initNode() {
  _this.html('');
  _path.forEach(function (value, index) {
    var collect = getCollect(0, index); // 获取当前select集合
    if (collect.length > 0 || index === 0) {
      var dom = $(_temp);
      dom.find('select').attr({
        'lay-filter': _name + '-item',
        index: index
      }).append(getOption(value, collect));
      _this.append(dom);
    } else {
      _path.splice(index);
    }
  });
  _form.render('select');
  _input.val(_path[_path.length - 2]);
}

function getData() {
  return new Promise(function (resolve, reject) {
    var id = getInputId();
    $.get(_url + '?id=' + id, function (res) {
      _tree = res.data.tree;
      if (res.data.path && Array.isArray(res.data.path)) {
        _path = res.data.path;
        _path.push(0);
      }
      resolve();
    });
  });
}

function getInputId() {
  var dom = $("input[name='id']");
  var id = 0;
  if (dom.length > 0) {
    id = dom.val() || id;
  }
  return id;
}

function getCollect(index, depth, collect) {
  if (index === 0) {
    collect = _tree;
  }
  if (index === depth) {
    return collect;
  } else {
    collect = collect.find(function (res) {
      return res.id === _path[index];
    }).children;
    return getCollect(index + 1, depth, collect);
  }
}

function getOption(value, collect) {
  if (!collect) {
    return '<option></option>';
  }
  var option = collect.map(function (res) {
    return '<option value="' + res.id + '"' + (value === res.id ? ' selected' : '') + '>' + res.title + '</option>';
  });
  option.unshift('<option></option>');
  return option;
}

function initBind() {
  _form.on('select(' + _name + '-item)', function (res) {
    res.value = Number(res.value);
    var index = Number($(res.elem).attr('index'));
    _path[index] = res.value;
    _path.splice(index + 1);
    if (res.value > 0) {
      _path.push(0);
    }
    initNode();
  });
}

exports.default = init;

/***/ }),

/***/ 130:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _selectTree = __webpack_require__(129);

var _selectTree2 = _interopRequireDefault(_selectTree);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

layui.use(['form']);

$.fn.extend({
  selectTree: _selectTree2.default
});

$("[selectTree]").selectTree({
  url: '/admin/getTree'
});

/***/ })

/******/ });