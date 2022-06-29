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
import router from './router';
// icon
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPlusSquare, faTrash, faPen } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
// import { vue } from 'laravel-mix';

library.add(faPlusSquare, faTrash, faPen);

// Vue.component('font-awesome-icon', FontAwesomeIcon);

// createApp({
//     components: { App, FontAwesomeIcon }
// }).mount('#app')

const app = createApp(App);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(router)
app.mount('#app')
