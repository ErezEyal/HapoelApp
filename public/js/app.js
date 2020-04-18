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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#article',
  data: {
    articles: [],
    i: 0
  },
  methods: {
    sortArticles: function sortArticles(objects) {
      var sorted = Object.values(objects).sort(function (a, b) {
        return new Date(b.date) - new Date(a.date);
      });
      var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      sorted.forEach(formatDate);

      function formatDate(item, index, arr) {
        var d = new Date(arr[index].date);
        arr[index].date = months[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear() + " - " + addZero(d.getHours()) + ":" + addZero(d.getMinutes());
        arr[index].description = arr[index].description.substring(0, 300);
      }

      function addZero(i) {
        if (i < 10) {
          i = "0" + i;
        }

        return i;
      }

      this.articles = sorted;
      this.article = this.articles[this.i];
    },
    indexUp: function indexUp() {
      if (this.i < this.articles.length - 1) {
        this.i++;
        gsap.from(".article-animation", {
          duration: 0.7,
          opacity: 0.3
        });
      } else {
        this.i = 0;
        gsap.from(".article-animation", {
          duration: 0.7,
          opacity: 0.3
        });
      }
    },
    indexDown: function indexDown() {
      if (this.i > 0) {
        this.i--;
        gsap.from(".article-animation", {
          duration: 0.7,
          opacity: 0.3
        });
      } else {
        this.i = this.articles.length - 1;
        gsap.from(".article-animation", {
          duration: 0.7,
          opacity: 0.3
        });
      }
    }
  },
  computed: {
    article: function article() {
      if (this.articles.length < 0) return undefined;
      return this.articles[this.i];
    }
  },
  mounted: function mounted() {
    var _this = this;

    axios.get('/all-articles').then(function (response) {
      return _this.sortArticles(response.data);
    });
  }
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/vagrant/code/HTA/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /home/vagrant/code/HTA/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });