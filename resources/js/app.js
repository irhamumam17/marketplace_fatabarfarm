/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('lightbox2/dist/js/lightbox');

// import Vue from "vue";
// import Vuetify from "vuetify/lib";
window.Vue = require('vue/dist/vue.common');
window.moment = require('moment');
window.Swal = require('sweetalert2');

import {
    Form
} from "vform";
import objectToFormData from "./objectToFormData";

// import vueFilePond from "vue-filepond";
// import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
// import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

// // Create component
// window.FilePond = vueFilePond(
//     FilePondPluginFileValidateType,
//     FilePondPluginImagePreview
// );
window.objectToFormData = objectToFormData;
window.Form = Form;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
