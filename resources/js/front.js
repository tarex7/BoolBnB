require("./bootstrap");

window.Vue = require("vue");

// IMPORTO BOOTSTRAP
import "bootstrap/dist/css/bootstrap.css";
//IMPORTO ROUTER JS
import router from "./router.js";

// IMPORTO COMPONENTI VUE
import App from "./components/App.vue";
import AppLoader from "./components/AppLoader";
import AppAlert from "./components/AppAlert.vue";
import AppFooter from "./components/AppFooter.vue";
import AppHeader from "./components/AppHeader.vue";
import AppJumbotron from "./components/AppJumbotron.vue";
import FlatCard from "./components/flats/FlatCard.vue";
import FlatCard from "./components/flats/FlatCard.vue";

Vue.component("AppLoader", AppLoader);
Vue.component("AppAlert", AppAlert);
Vue.component("AppFooter", AppFooter);
Vue.component("AppHeader", AppHeader);
Vue.component("AppAlert", AppAlert);
Vue.component("AppJumbotron", AppJumbotron);
Vue.component("FlatCard", FlatCard);

//CREO NEW VEU
const root = new Vue({
    router,
    el: "#root",
    render: (h) => h(App),
});
