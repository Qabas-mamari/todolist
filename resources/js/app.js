require('./bootstrap');

// import Vue from 'vue'
// import App from './vue/app'


// const app = new Vue({
//     el: '#app',
//     component: {App}
// });

// app.js
require('./bootstrap');

import { createApp } from 'vue';
import App from './vue/app';

// icon
import {library} from '@fortawesome/fontawesome-svg-core';
import {faPlusSquare, faTrash, faPen} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faPlusSquare, faTrash, faPen);

// Vue.component('font-awesome-icon', FontAwesomeIcon);

// createApp({
//     components: { App, FontAwesomeIcon }
// }).mount('#app')

createApp(App)
    .component("font-awesome-icon", FontAwesomeIcon)
    .mount('#app')
