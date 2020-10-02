import {Datepicker} from 'vanillajs-datepicker';
import ru from '../../node_modules/vanillajs-datepicker/js/i18n/locales/ru.js';
import {tns} from "../../node_modules/tiny-slider/src/tiny-slider";
window.tns = tns;
Object.assign(Datepicker.locales, ru);

window.Datepicker = Datepicker;
window.Axios = require('axios');

import xmlHttpRequest from './xmlHttpRequest/xmlHttpRequest';
import refreshCart from './components/cart/refreshCart';
import getPreload from './components/card/functions/getPreload';
import getQuantity from './components/card/functions/qty';
import loadUnderOrder from './components/cart/loadUnderOrder';
import cartRemove from './components/cart/remove';
import flash from './components/alerts/flash';
import validator from './components/validate-errors/validator';
import countIcons from './components/card/countIcons';
import LazyLoad from 'vanilla-lazyload';
//import close from './components/alerts/close';

require('./components/sticky-header/sticky');
//require('./components/homepage-slider/slider');
require('./components/accordion/accordion');
require('./components/tabs/tabs');
require('./components/leaders-sales/leaders-sales');
require('./components/product/moreGoods');
require('./components/card/cardIcons');
require('./components/form/mask/phone-mask');
require('./components/form/label/label-input-focus');
require('./components/form/radio/order-radio-input');
require('./components/mode-tile/tile');
require('./components/catalog-filter/attributes');
//require('./components/alerts/close');
require('./components/alerts/flash');
require('./components/login/login');
//require('./components/modals/webDevModal');
require('./components/verify-phone/phone');
require('./components/register/register');
require('./components/order-register/orderRegister');
require('./components/sticky-bar/sticky-bar');
require('./components/search/search');
require('./components/search/ajax-search');
require('./components/search/ajax-search');
require('./components/lazy-load')(LazyLoad);


import btnAdd from './components/card/btnAdd';
import btnQty from './components/card/btnQty';
import addCardTitleHeight from './components/card/card-title';
import underOrder from './components/cart/underOrder';

// (function () {
//     function logElementEvent(eventName, element) {
//         const dataSrc = element.getAttribute("data-src");
//         if(dataSrc){
//             element.src = "https://www.heritage.org/index/htmp/ims/load0.gif";
//         }
//         return element;
//     }
//
//     var callback_enter = function (element) {
//         logElementEvent("🔑 ENTERED", element);
//     };
//     var callback_exit = function (element) {
//         logElementEvent("🚪 EXITED", element);
//     };
//     var callback_loading = function (element) {
//         logElementEvent("⌚ LOADING", element);
//     };
//     var callback_loaded = function (element) {
//         logElementEvent("👍 LOADED", element);
//     };
//     var callback_error = function (element) {
//         logElementEvent("💀 ERROR", element);
//         element.src =
//             "https://via.placeholder.com/440x560/?text=Error+Placeholder";
//     };
//     var callback_finish = function () {
//         logElementEvent("✔️ FINISHED", document.documentElement);
//     };
//     var callback_cancel = function (element) {
//         logElementEvent("🔥 CANCEL", element);
//     };
//
//     var ll = new LazyLoad({
//         threshold: 0,
//         elements_selector: '.lazy-load',
//         callback_loading: callback_loading,
//         callback_loaded: callback_loaded,
//         callback_error: callback_error,
//         callback_finish: callback_finish
//     });
// })();


require('./events/_load');


