window.Axios = require('axios');
// window.Axios.defaults.headers.common = {
//     'X-Requested-With': 'XMLHttpRequest',
//     'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
// }
import getPreloadCard from './components/card/functions/getPreloadCard';
import getQuantity from './components/card/functions/qty';
import addActiveIconColor from './components/card/functions/addActiveIconColor';

require('./components/sticky-header/sticky');
require('./components/homepage-slider/slider');
require('./components/accordion/accordion');
require('./components/tabs/tabs');
require('./components/leaders-sales/leaders-sales');
require('./components/card/cardIcons');

import addCart from './components/card/addCart';
import btnAdd from './components/card/btnAdd';
import btnQty from './components/card/btnQty';
