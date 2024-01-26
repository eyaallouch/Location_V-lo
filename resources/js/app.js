import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from "vue-router";
import { routes } from "./routes";
import "@fortawesome/fontawesome-free/css/all.css";
import 'bootstrap/dist/css/bootstrap.min.css';
import PrimeVue from 'primevue/config';
import Toast from 'primevue/toast';

import ToastService from 'primevue/toastservice';
import 'primeicons/primeicons.css'
import 'primevue/resources/themes/lara-light-green/theme.css';
import store from "./store"
//import 'jquery/dist/jquery.min.js'

import App from './App.vue'

let app = createApp(App)
const router = createRouter({
history: createWebHistory(),
routes: routes,
})
app.use(router).use(PrimeVue);
app.use(ToastService);
app.use(store);
app.mount("#app")



// router.beforeEach(async (to, from, next) => {
//     if (to.matched.some(record => record.meta.isAuth)) {
//     let token = localStorage.getItem('token');
//     if (!token) {
//     next("/login");
//     } else {
//     console.log(token);
//     next(); // Mettre next() ici après avoir vérifié l'authentification
//     }
//     } else {
//     next(); // Mettre next() ici si la route n'a pas besoind'authentification
//     }
//     });
