require('./bootstrap');
import Vue from 'vue'

import App from './App.vue';
import Offer from "./components/Offer";
import Itinerary from "./components/Itinerary";
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.component('offer', Offer);
Vue.component('itinerary', Itinerary);
Vue.component('offer-modal', require('./components/OfferModal.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
