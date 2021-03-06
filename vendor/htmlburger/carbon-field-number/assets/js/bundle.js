/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

eval("(function() { module.exports = this[\"carbon.core\"]; }());\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9leHRlcm5hbCBcImNhcmJvbi5jb3JlXCI/ODMzMCJdLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKSB7IG1vZHVsZS5leHBvcnRzID0gdGhpc1tcImNhcmJvbi5jb3JlXCJdOyB9KCkpO1xuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIGV4dGVybmFsIFwiY2FyYm9uLmNvcmVcIlxuLy8gbW9kdWxlIGlkID0gMFxuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }),
/* 1 */
/***/ (function(module, exports) {

eval("(function() { module.exports = this[\"carbon.vendor\"]; }());\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9leHRlcm5hbCBcImNhcmJvbi52ZW5kb3JcIj9kZTI2Il0sInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpIHsgbW9kdWxlLmV4cG9ydHMgPSB0aGlzW1wiY2FyYm9uLnZlbmRvclwiXTsgfSgpKTtcblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyBleHRlcm5hbCBcImNhcmJvbi52ZW5kb3JcIlxuLy8gbW9kdWxlIGlkID0gMVxuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nObject.defineProperty(exports, \"__esModule\", {\n\tvalue: true\n});\nexports.enhance = exports.NumberField = undefined;\n\nvar _react = __webpack_require__(6);\n\nvar _react2 = _interopRequireDefault(_react);\n\nvar _propTypes = __webpack_require__(7);\n\nvar _propTypes2 = _interopRequireDefault(_propTypes);\n\nvar _recompose = __webpack_require__(9);\n\nvar _field = __webpack_require__(8);\n\nvar _field2 = _interopRequireDefault(_field);\n\nvar _withStore = __webpack_require__(4);\n\nvar _withStore2 = _interopRequireDefault(_withStore);\n\nvar _withSetup = __webpack_require__(5);\n\nvar _withSetup2 = _interopRequireDefault(_withSetup);\n\nfunction _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }\n\n/**\r\n * Render a number input field.\r\n *\r\n * @param  {Object}        props\r\n * @param  {String}        props.name\r\n * @param  {Object}        props.field\r\n * @param  {Function}      props.handleChange\r\n * @return {React.Element}\r\n */\n/**\r\n * The external dependencies.\r\n */\nvar NumberField = exports.NumberField = function NumberField(_ref) {\n\tvar name = _ref.name,\n\t    field = _ref.field,\n\t    handleChange = _ref.handleChange;\n\n\treturn _react2.default.createElement(\n\t\t_field2.default,\n\t\t{ field: field },\n\t\t_react2.default.createElement('input', {\n\t\t\ttype: 'number',\n\t\t\tid: field.id,\n\t\t\tname: name,\n\t\t\tvalue: field.value,\n\t\t\tdisabled: !field.ui.is_visible,\n\t\t\tclassName: 'regular-text',\n\t\t\tmax: field.max,\n\t\t\tmin: field.min,\n\t\t\tstep: field.step,\n\t\t\tonChange: handleChange })\n\t);\n};\n\n/**\r\n * Validate the props.\r\n *\r\n * @type {Object}\r\n */\n\n\n/**\r\n * The internal dependencies.\r\n */\nNumberField.propTypes = {\n\tname: _propTypes2.default.string,\n\tfield: _propTypes2.default.shape({\n\t\tid: _propTypes2.default.string,\n\t\tvalue: _propTypes2.default.string,\n\t\tmin: _propTypes2.default.number,\n\t\tmax: _propTypes2.default.number,\n\t\tstep: _propTypes2.default.number\n\t}),\n\thandleChange: _propTypes2.default.func\n};\n\n/**\r\n * The enhancer.\r\n *\r\n * @type {Function}\r\n */\nvar enhance = exports.enhance = (0, _recompose.compose)(\n/**\r\n * Connect to the Redux store.\r\n */\n(0, _withStore2.default)(),\n\n/**\r\n * Attach the setup hooks.\r\n */\n(0, _withSetup2.default)(),\n\n/**\r\n * The handlers passed to the component.\r\n */\n(0, _recompose.withHandlers)({\n\thandleChange: function handleChange(_ref2) {\n\t\tvar field = _ref2.field,\n\t\t    setFieldValue = _ref2.setFieldValue;\n\t\treturn function (_ref3) {\n\t\t\tvar value = _ref3.target.value;\n\t\t\treturn setFieldValue(field.id, value);\n\t\t};\n\t}\n}));\n\nexports.default = (0, _recompose.setStatic)('type', ['number'])(enhance(NumberField));\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9hc3NldHMvanMvY29tcG9uZW50cy9maWVsZC5qcz9hYzk2Il0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxyXG4gKiBUaGUgZXh0ZXJuYWwgZGVwZW5kZW5jaWVzLlxyXG4gKi9cclxuaW1wb3J0IFJlYWN0IGZyb20gJ3JlYWN0JztcclxuaW1wb3J0IFByb3BUeXBlcyBmcm9tICdwcm9wLXR5cGVzJztcclxuaW1wb3J0IHsgY29tcG9zZSwgd2l0aEhhbmRsZXJzLCBzZXRTdGF0aWMgfSBmcm9tICdyZWNvbXBvc2UnO1xyXG5cclxuLyoqXHJcbiAqIFRoZSBpbnRlcm5hbCBkZXBlbmRlbmNpZXMuXHJcbiAqL1xyXG5pbXBvcnQgRmllbGQgZnJvbSAnZmllbGRzL2NvbXBvbmVudHMvZmllbGQnO1xyXG5pbXBvcnQgd2l0aFN0b3JlIGZyb20gJ2ZpZWxkcy9kZWNvcmF0b3JzL3dpdGgtc3RvcmUnO1xyXG5pbXBvcnQgd2l0aFNldHVwIGZyb20gJ2ZpZWxkcy9kZWNvcmF0b3JzL3dpdGgtc2V0dXAnO1xyXG5cclxuLyoqXHJcbiAqIFJlbmRlciBhIG51bWJlciBpbnB1dCBmaWVsZC5cclxuICpcclxuICogQHBhcmFtICB7T2JqZWN0fSAgICAgICAgcHJvcHNcclxuICogQHBhcmFtICB7U3RyaW5nfSAgICAgICAgcHJvcHMubmFtZVxyXG4gKiBAcGFyYW0gIHtPYmplY3R9ICAgICAgICBwcm9wcy5maWVsZFxyXG4gKiBAcGFyYW0gIHtGdW5jdGlvbn0gICAgICBwcm9wcy5oYW5kbGVDaGFuZ2VcclxuICogQHJldHVybiB7UmVhY3QuRWxlbWVudH1cclxuICovXHJcbmV4cG9ydCBjb25zdCBOdW1iZXJGaWVsZCA9ICh7XHJcblx0bmFtZSxcclxuXHRmaWVsZCxcclxuXHRoYW5kbGVDaGFuZ2VcclxufSkgPT4ge1xyXG5cdHJldHVybiA8RmllbGQgZmllbGQ9e2ZpZWxkfT5cclxuXHRcdDxpbnB1dFxyXG5cdFx0XHR0eXBlPVwibnVtYmVyXCJcclxuXHRcdFx0aWQ9e2ZpZWxkLmlkfVxyXG5cdFx0XHRuYW1lPXtuYW1lfVxyXG5cdFx0XHR2YWx1ZT17ZmllbGQudmFsdWV9XHJcblx0XHRcdGRpc2FibGVkPXshZmllbGQudWkuaXNfdmlzaWJsZX1cclxuXHRcdFx0Y2xhc3NOYW1lPVwicmVndWxhci10ZXh0XCJcclxuXHRcdFx0bWF4PXtmaWVsZC5tYXh9XHJcblx0XHRcdG1pbj17ZmllbGQubWlufVxyXG5cdFx0XHRzdGVwPXtmaWVsZC5zdGVwfVxyXG5cdFx0XHRvbkNoYW5nZT17aGFuZGxlQ2hhbmdlfSAvPlxyXG5cdDwvRmllbGQ+O1xyXG59XHJcblxyXG4vKipcclxuICogVmFsaWRhdGUgdGhlIHByb3BzLlxyXG4gKlxyXG4gKiBAdHlwZSB7T2JqZWN0fVxyXG4gKi9cclxuTnVtYmVyRmllbGQucHJvcFR5cGVzID0ge1xyXG5cdG5hbWU6IFByb3BUeXBlcy5zdHJpbmcsXHJcblx0ZmllbGQ6IFByb3BUeXBlcy5zaGFwZSh7XHJcblx0XHRpZDogUHJvcFR5cGVzLnN0cmluZyxcclxuXHRcdHZhbHVlOiBQcm9wVHlwZXMuc3RyaW5nLFxyXG5cdFx0bWluOiBQcm9wVHlwZXMubnVtYmVyLFxyXG5cdFx0bWF4OiBQcm9wVHlwZXMubnVtYmVyLFxyXG5cdFx0c3RlcDogUHJvcFR5cGVzLm51bWJlcixcclxuXHR9KSxcclxuXHRoYW5kbGVDaGFuZ2U6IFByb3BUeXBlcy5mdW5jLFxyXG59O1xyXG5cclxuLyoqXHJcbiAqIFRoZSBlbmhhbmNlci5cclxuICpcclxuICogQHR5cGUge0Z1bmN0aW9ufVxyXG4gKi9cclxuZXhwb3J0IGNvbnN0IGVuaGFuY2UgPSBjb21wb3NlKFxyXG5cdC8qKlxyXG5cdCAqIENvbm5lY3QgdG8gdGhlIFJlZHV4IHN0b3JlLlxyXG5cdCAqL1xyXG5cdHdpdGhTdG9yZSgpLFxyXG5cclxuXHQvKipcclxuXHQgKiBBdHRhY2ggdGhlIHNldHVwIGhvb2tzLlxyXG5cdCAqL1xyXG5cdHdpdGhTZXR1cCgpLFxyXG5cclxuXHQvKipcclxuXHQgKiBUaGUgaGFuZGxlcnMgcGFzc2VkIHRvIHRoZSBjb21wb25lbnQuXHJcblx0ICovXHJcblx0d2l0aEhhbmRsZXJzKHtcclxuXHRcdGhhbmRsZUNoYW5nZTogKHsgZmllbGQsIHNldEZpZWxkVmFsdWUgfSkgPT4gKHsgdGFyZ2V0OiB7IHZhbHVlIH0gfSkgPT4gc2V0RmllbGRWYWx1ZShmaWVsZC5pZCwgdmFsdWUpLFxyXG5cdH0pXHJcbik7XHJcblxyXG5leHBvcnQgZGVmYXVsdCBzZXRTdGF0aWMoJ3R5cGUnLCBbXHJcblx0J251bWJlcicsXHJcbl0pKGVuaGFuY2UoTnVtYmVyRmllbGQpKTtcclxuXHJcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyBhc3NldHMvanMvY29tcG9uZW50cy9maWVsZC5qcyJdLCJtYXBwaW5ncyI6Ijs7Ozs7OztBQUdBO0FBQ0E7OztBQUFBO0FBQ0E7OztBQUFBO0FBQ0E7QUFJQTtBQUNBOzs7QUFBQTtBQUNBOzs7QUFBQTtBQUNBOzs7OztBQUNBOzs7Ozs7Ozs7QUFkQTs7O0FBdUJBO0FBSUE7QUFBQTtBQUFBO0FBQ0E7QUFBQTtBQUFBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBWEE7QUFhQTtBQUNBO0FBQ0E7Ozs7Ozs7QUFwQ0E7OztBQXlDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBTEE7QUFPQTtBQVRBO0FBQ0E7QUFXQTs7Ozs7QUFLQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTs7O0FBR0E7QUFDQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBREE7QUFDQTtBQUlBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = (__webpack_require__(0))(\"uokr\");\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9kZWxlZ2F0ZWQgLi9hc3NldHMvanMvbGliL3JlZ2lzdHJ5LmpzIGZyb20gZGxsLXJlZmVyZW5jZSBjYXJib24uY29yZT9jNzkwIl0sInNvdXJjZXNDb250ZW50IjpbIm1vZHVsZS5leHBvcnRzID0gKF9fd2VicGFja19yZXF1aXJlX18oMCkpKFwidW9rclwiKTtcblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyBkZWxlZ2F0ZWQgLi9hc3NldHMvanMvbGliL3JlZ2lzdHJ5LmpzIGZyb20gZGxsLXJlZmVyZW5jZSBjYXJib24uY29yZVxuLy8gbW9kdWxlIGlkID0gM1xuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = (__webpack_require__(0))(\"0yqe\");\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiNC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9kZWxlZ2F0ZWQgLi9hc3NldHMvanMvZmllbGRzL2RlY29yYXRvcnMvd2l0aC1zdG9yZS5qcyBmcm9tIGRsbC1yZWZlcmVuY2UgY2FyYm9uLmNvcmU/NWYwZSJdLCJzb3VyY2VzQ29udGVudCI6WyJtb2R1bGUuZXhwb3J0cyA9IChfX3dlYnBhY2tfcmVxdWlyZV9fKDApKShcIjB5cWVcIik7XG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gZGVsZWdhdGVkIC4vYXNzZXRzL2pzL2ZpZWxkcy9kZWNvcmF0b3JzL3dpdGgtc3RvcmUuanMgZnJvbSBkbGwtcmVmZXJlbmNlIGNhcmJvbi5jb3JlXG4vLyBtb2R1bGUgaWQgPSA0XG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUEiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = (__webpack_require__(0))(\"8ctJ\");\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiNS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9kZWxlZ2F0ZWQgLi9hc3NldHMvanMvZmllbGRzL2RlY29yYXRvcnMvd2l0aC1zZXR1cC5qcyBmcm9tIGRsbC1yZWZlcmVuY2UgY2FyYm9uLmNvcmU/OGUxZSJdLCJzb3VyY2VzQ29udGVudCI6WyJtb2R1bGUuZXhwb3J0cyA9IChfX3dlYnBhY2tfcmVxdWlyZV9fKDApKShcIjhjdEpcIik7XG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gZGVsZWdhdGVkIC4vYXNzZXRzL2pzL2ZpZWxkcy9kZWNvcmF0b3JzL3dpdGgtc2V0dXAuanMgZnJvbSBkbGwtcmVmZXJlbmNlIGNhcmJvbi5jb3JlXG4vLyBtb2R1bGUgaWQgPSA1XG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUEiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = (__webpack_require__(1))(\"GiK3\");\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiNi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9kZWxlZ2F0ZWQgLi9ub2RlX21vZHVsZXMvcmVhY3QvaW5kZXguanMgZnJvbSBkbGwtcmVmZXJlbmNlIGNhcmJvbi52ZW5kb3I/OTM1MyJdLCJzb3VyY2VzQ29udGVudCI6WyJtb2R1bGUuZXhwb3J0cyA9IChfX3dlYnBhY2tfcmVxdWlyZV9fKDEpKShcIkdpSzNcIik7XG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gZGVsZWdhdGVkIC4vbm9kZV9tb2R1bGVzL3JlYWN0L2luZGV4LmpzIGZyb20gZGxsLXJlZmVyZW5jZSBjYXJib24udmVuZG9yXG4vLyBtb2R1bGUgaWQgPSA2XG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUEiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = (__webpack_require__(1))(\"KSGD\");\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiNy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9kZWxlZ2F0ZWQgLi9ub2RlX21vZHVsZXMvcHJvcC10eXBlcy9pbmRleC5qcyBmcm9tIGRsbC1yZWZlcmVuY2UgY2FyYm9uLnZlbmRvcj84ZTRhIl0sInNvdXJjZXNDb250ZW50IjpbIm1vZHVsZS5leHBvcnRzID0gKF9fd2VicGFja19yZXF1aXJlX18oMSkpKFwiS1NHRFwiKTtcblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyBkZWxlZ2F0ZWQgLi9ub2RlX21vZHVsZXMvcHJvcC10eXBlcy9pbmRleC5qcyBmcm9tIGRsbC1yZWZlcmVuY2UgY2FyYm9uLnZlbmRvclxuLy8gbW9kdWxlIGlkID0gN1xuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = (__webpack_require__(0))(\"M6Uh\");\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiOC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9kZWxlZ2F0ZWQgLi9hc3NldHMvanMvZmllbGRzL2NvbXBvbmVudHMvZmllbGQvaW5kZXguanMgZnJvbSBkbGwtcmVmZXJlbmNlIGNhcmJvbi5jb3JlPzRlYzUiXSwic291cmNlc0NvbnRlbnQiOlsibW9kdWxlLmV4cG9ydHMgPSAoX193ZWJwYWNrX3JlcXVpcmVfXygwKSkoXCJNNlVoXCIpO1xuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIGRlbGVnYXRlZCAuL2Fzc2V0cy9qcy9maWVsZHMvY29tcG9uZW50cy9maWVsZC9pbmRleC5qcyBmcm9tIGRsbC1yZWZlcmVuY2UgY2FyYm9uLmNvcmVcbi8vIG1vZHVsZSBpZCA9IDhcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sIm1hcHBpbmdzIjoiQUFBQSIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = (__webpack_require__(1))(\"zpMW\");\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiOS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9kZWxlZ2F0ZWQgLi9ub2RlX21vZHVsZXMvcmVjb21wb3NlL2VzL1JlY29tcG9zZS5qcyBmcm9tIGRsbC1yZWZlcmVuY2UgY2FyYm9uLnZlbmRvcj8yYmFiIl0sInNvdXJjZXNDb250ZW50IjpbIm1vZHVsZS5leHBvcnRzID0gKF9fd2VicGFja19yZXF1aXJlX18oMSkpKFwienBNV1wiKTtcblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyBkZWxlZ2F0ZWQgLi9ub2RlX21vZHVsZXMvcmVjb21wb3NlL2VzL1JlY29tcG9zZS5qcyBmcm9tIGRsbC1yZWZlcmVuY2UgY2FyYm9uLnZlbmRvclxuLy8gbW9kdWxlIGlkID0gOVxuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar _registry = __webpack_require__(3);\n\nvar _field = __webpack_require__(2);\n\nvar _field2 = _interopRequireDefault(_field);\n\nfunction _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }\n\n/**\r\n * The internal dependencies.\r\n */\n(0, _registry.registerFieldComponent)('number', _field2.default);\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMTAuanMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vYXNzZXRzL2pzL2Jvb3RzdHJhcC5qcz83NjNjIl0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxyXG4gKiBUaGUgaW50ZXJuYWwgZGVwZW5kZW5jaWVzLlxyXG4gKi9cclxuaW1wb3J0IHsgcmVnaXN0ZXJGaWVsZENvbXBvbmVudCB9IGZyb20gJ2xpYi9yZWdpc3RyeSc7XHJcbmltcG9ydCBOdW1iZXJGaWVsZCBmcm9tICdjb21wb25lbnRzL2ZpZWxkJztcclxuXHJcbnJlZ2lzdGVyRmllbGRDb21wb25lbnQoJ251bWJlcicsIE51bWJlckZpZWxkKTtcclxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIGFzc2V0cy9qcy9ib290c3RyYXAuanMiXSwibWFwcGluZ3MiOiI7O0FBR0E7QUFDQTtBQUFBO0FBQ0E7Ozs7O0FBTEE7OztBQU1BIiwic291cmNlUm9vdCI6IiJ9");

/***/ })
/******/ ]);