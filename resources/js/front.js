require("./bootstrap");

window.Vue = require("vue");

// IMPORTO BOOTSTRAP
import 'bootstrap/dist/css/bootstrap.css';

import App from "./components/App.vue";

const root = new Vue({
    //router,
    el: "#root",
    render: (h) => h(App),
});