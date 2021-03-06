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
/******/ 	return __webpack_require__(__webpack_require__.s = 166);
/******/ })
/************************************************************************/
/******/ ({

/***/ 166:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _cartesian = __webpack_require__(69);

var _cartesian2 = _interopRequireDefault(_cartesian);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// 清空缓存
$.store.remove('product_image');

$("#createSku").click(function () {
  var data = [];
  window._spec.forEach(function (res, index) {
    var arr = $("#specAttribute .layui-form-item").eq(index).find('input:checked').map(function (index, item) {
      return {
        name: res.name,
        text: $(item).val()
      };
    }).get();
    data.push(arr);
  });
  // 去除数组长度为0的数据
  data = data.filter(function (res) {
    return res.length > 0;
  });
  var spec_collect = (0, _cartesian2.default)(data);
  $("#specCollect").append(createSpec(spec_collect).join(''));
});

function createSpec(collect) {
  return collect.filter(function (res) {
    var name = res.map(function (item) {
      return item.text;
    });
    return !$("#specCollect").text().includes(name.join('+'));
  }).map(function (res) {
    var name = res.map(function (item) {
      return item.text;
    });
    var obj = res.map(function (item) {
      return _defineProperty({}, item.name, item.text);
    }).reduce(function (accumulator, item) {
      return Object.assign(accumulator, item);
    });

    return '<tr create>\n              <td title>' + name.join('+') + '</td>\n              <td>\n                <input type="text" class="layui-input">\n                <input type="hidden" value=\'' + JSON.stringify(obj) + '\'>\n              </td>\n              <td>\n                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" onclick="deleteProductSpecItem(null, this)">\u5220\u9664</button>\n              </td>\n            </tr>';
  });
}

layui.form.on('submit', function () {
  // 设置spec属性
  var data = [];
  window._spec.forEach(function (res, index) {
    var arr = $("#specAttribute .layui-form-item").eq(index).find('input:checked').map(function (index, item) {
      return $(item).val();
    }).get();
    data.push({
      name: res.name,
      title: res.title,
      collect: arr
    });
  });
  $("input[name='spec']").val(JSON.stringify(data));

  // 设置spec集合
  var specCollect = [];
  $("#specCollect tr[create]").each(function () {
    specCollect.push({
      store_count: $(this).find('input[type="text"]').val(),
      title: $(this).find('td[title]').text(),
      spec_collect: JSON.parse($(this).find('input[type="hidden"]').val())
    });
  });
  $("input[name='product_spec_items']").val(JSON.stringify(specCollect));
});

// spec_item 删除完成事件
window.deleteProductSpecItem = function (res, elem) {
  $(elem).parents('tr').remove();
};

window.editProductSpecItem = function (res, elem) {
  $(elem).parents('tr').find("td.store_count").text(res.store_count);
};

/***/ }),

/***/ 69:
/***/ (function(module, exports, __webpack_require__) {

var extend = __webpack_require__(70);

// Public API
module.exports = cartesian;

/**
 * Creates cartesian product of the provided properties
 *
 * @param   {object|array} list - list of (array) properties or array of arrays
 * @returns {array} all the combinations of the properties
 */
function cartesian(list)
{
  var last, init, keys, product = [];

  if (Array.isArray(list))
  {
    init = [];
    last = list.length - 1;
  }
  else if (typeof list == 'object' && list !== null)
  {
    init = {};
    keys = Object.keys(list);
    last = keys.length - 1;
  }
  else
  {
    throw new TypeError('Expecting an Array or an Object, but `' + (list === null ? 'null' : typeof list) + '` provided.');
  }

  function add(row, i)
  {
    var j, k, r;

    k = keys ? keys[i] : i;

    // either array or not, not expecting objects here
    Array.isArray(list[k]) || (typeof list[k] == 'undefined' ? list[k] = [] : list[k] = [list[k]]);

    for (j=0; j < list[k].length; j++)
    {
      r = clone(row);
      store(r, list[k][j], k);

      if (i >= last)
      {
        product.push(r);
      }
      else
      {
        add(r, i + 1);
      }
    }
  }

  add(init, 0);

  return product;
}

/**
 * Clones (shallow copy) provided object or array
 *
 * @param   {object|array} obj - object or array to clone
 * @returns {object|array} - shallow copy of the provided object or array
 */
function clone(obj)
{
  return Array.isArray(obj) ? [].concat(obj) : extend(obj);
}

/**
 * Stores provided element in the provided object or array
 *
 * @param   {object|array} obj - object or array to add to
 * @param   {mixed} elem - element to add
 * @param   {string|number} key - object's property key to add to
 * @returns {void}
 */
function store(obj, elem, key)
{
  Array.isArray(obj) ? obj.push(elem) : (obj[key] = elem);
}


/***/ }),

/***/ 70:
/***/ (function(module, exports) {

module.exports = extend

var hasOwnProperty = Object.prototype.hasOwnProperty;

function extend() {
    var target = {}

    for (var i = 0; i < arguments.length; i++) {
        var source = arguments[i]

        for (var key in source) {
            if (hasOwnProperty.call(source, key)) {
                target[key] = source[key]
            }
        }
    }

    return target
}


/***/ })

/******/ });