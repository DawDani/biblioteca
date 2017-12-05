try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default;

    require('bootstrap');
} catch (e) {}

window.Vue = require('vue');

import bookingModal from './components/booking-modal.vue';

const app = new Vue({
    el: '#app',
    components: {
        bookingModal
    }
});