try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default;

    require('bootstrap');
} catch (e) {}

window.Vue = require('vue');
window.axios = require('axios');
window.moment = require('moment');

import bookingModal from './components/booking-modal.vue';

const app = new Vue({
    el: '#app',
    components: {
        bookingModal
    }
});