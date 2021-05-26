require('./bootstrap');
import Vue from 'vue'
// window.Vue = require('vue');

import App from './App.vue';
import Offer from "./components/Offer";
import Itinerary from "./components/Itinerary";
// import AirportTemplate from "./components/AirportTemplate";
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import VueSuggestion from "vue-suggestion";

// import 'vue-suggestion/dist/vue-suggestion.css';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.component('offer', Offer);
Vue.component('itinerary', Itinerary);
Vue.component('vue-suggestion', VueSuggestion);
// Vue.component('airport-suggestion', AirportTemplate);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
