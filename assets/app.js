/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/css/app.css';
import './styles/scss/config/default/app.scss';
// import '@vueform/slider/themes/default.css';
// import '/styles/scss/mermaid.min.css';

// start the Stimulus application
// import './bootstrap';


/**
 * Initial scss file
 */
import "./styles/scss/config/default/app.scss";

AOS.init({
    easing: 'ease-out-back',
    duration: 1000
});

/**
 * Init vue3
 */
import { createApp } from "vue";
import MyApp from './MyApp.vue';
import router from "./router";
import store from "./state/store";

import AOS from 'aos';

import BootstrapVue3 from 'bootstrap-vue-3';
import vClickOutside from "click-outside-vue3";
import Maska from 'maska';
import Notifications from '@kyvg/vue3-notification'

import VueFeather from 'vue-feather';


createApp(MyApp)
    .use(store)
    .use(router)
    .use(BootstrapVue3)
    .component(VueFeather.type, VueFeather)
    .use(Maska)
    .use(Notifications)
    .use(vClickOutside).mount('#app');