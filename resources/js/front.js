/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


//IMPORTO ROUTER JS
import router from './router.js'

//IMPORTO I COMPONENTI A LIVELLO GENERICO
import App from './components/App.vue'
import AppLoader from './components/AppLoader'
import AppAlert from './components/AppAlert.vue'

Vue.component('AppLoader', AppLoader)
Vue.component('AppAlert', AppAlert)
const root = new Vue({
  router,
    el: '#root',
    render: h => h(App)
})




