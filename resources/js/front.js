require("./bootstrap");


window.Vue = require('vue');

// IMPORTO BOOTSTRAP
import 'bootstrap/dist/css/bootstrap.css';
//IMPORTO ROUTER JS
import router from './router.js'

// IMPORTO COMPONENTI VUE
import App from './components/App.vue'
import AppLoader from './components/AppLoader'
import AppAlert from './components/AppAlert.vue'

Vue.component('AppLoader', AppLoader)
Vue.component('AppAlert', AppAlert)

//CREO NEW VEU
const root = new Vue({
    router,
    el: '#root',
    render: h => h(App)
})
