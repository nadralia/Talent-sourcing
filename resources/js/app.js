/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.prototype.$EventBus = new Vue(); // Global event bus for all components


const dayjs = require('dayjs');
Vue.prototype.$dayjs = dayjs

Vue.prototype.$app = Vue.observable({
    BASE_URL: process.env.MIX_BASE_URL,
    flash: {
        type: String,
        title: String,
        message: String
    }
} ) 

window.Flash = ({type, title, message}) => {
    Vue.prototype.$app.flash = {
        type: type ? type : 'success',
        title,
        message
    }
}

import routes from './routes.js'
const router = new VueRouter({
    routes,
    mode: 'history',
})

// Vue.use(VueRouter)

import VueTailwind from 'vue-tailwind'
import components from '../../vue-tailwind-components'
Vue.use(VueTailwind, components)



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// usage documentation here: https://www.npmjs.com/package/vue-spinner
// Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue'));


Vue.component('bhr-main-app', require('./Pages/Recruiters/Index.vue').default);
Vue.component('bhr-icon', require('./Shared/Icons.vue').default);
Vue.component('bhr-button', require('./Shared/Button.vue').default);
Vue.component('bhr-card', require('./Shared/Card.vue').default);
Vue.component('bhr-text-input', require('./Shared/TextInput.vue').default);
Vue.component('bhr-checkbox', require('./Shared/Checkbox.vue').default);
Vue.component('b-section', require('./Shared/SectionForm.vue').default);
Vue.component('progress-bar', require('./Shared/ProgressBar.vue').default);
Vue.component('profile-completeness', require('./Shared/ProfileCompleteness'));

Vue.component('pulse-loader', require('vue-spinner/dist/vue-spinner.min').PulseLoader);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    el: '#app',
});
