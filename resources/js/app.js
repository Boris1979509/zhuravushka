import {Datepicker} from 'vanillajs-datepicker';
import ru from '../../node_modules/vanillajs-datepicker/js/i18n/locales/ru.js';

Object.assign(Datepicker.locales, ru);

window.Axios = require('axios');

import xmlHttpRequest from './xmlHttpRequest/xmlHttpRequest';
import refreshCart from './components/cart/refreshCart';
import getPreload from './components/card/functions/getPreload';
import getQuantity from './components/card/functions/qty';
import cartRemove from './components/cart/remove';
import flash from './components/alerts/flash';
import validator from './components/validate-errors/validator';
import close from './components/alerts/close';

require('./components/sticky-header/sticky');
require('./components/homepage-slider/slider');
require('./components/accordion/accordion');
require('./components/tabs/tabs');
require('./components/leaders-sales/leaders-sales');
require('./components/product/moreGoods');
require('./components/card/cardIcons');
require('./components/form/mask/phone-mask');
require('./components/form/label/label-input-focus');
require('./components/form/radio/order-radio-input');
require('./components/mode-tile/tile');
require('./components/catalog-filter/brands');
//require('./components/alerts/close');
require('./components/alerts/flash');
require('./components/login/login');
require('./components/modals/webDevModal');
require('./components/verify-phone/phone');
require('./components/register/register');


import btnAdd from './components/card/btnAdd';
import btnQty from './components/card/btnQty';

// Datepicker
((elem) => {
    if (!elem) return;
    const datepicker = new Datepicker(elem, {
        language: 'ru'
    });
})(document.querySelector('input[name="datePicker"]'));


