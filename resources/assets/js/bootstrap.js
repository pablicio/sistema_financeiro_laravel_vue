import loadash from 'lodash';
window._ = loadash;

// import jQuery from 'jquery';
// window.$ = window.jQuery = jQuery;


import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
// import SweetAlert from 'sweetalert';

window.Vue = Vue;
Vue.use(VueRouter);
window.axios = axios;
// window.swal = SweetAlert;

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};
