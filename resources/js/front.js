/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import App from "./App.vue";
import VueRouter from "vue-router";

window.Vue = require("vue");

window.Vue.use(VueRouter);
const routes = [
    {
        path: "/",
        component: require("./App.vue").default,
    },
];

const router = new VueRouter({
    routes: routes,
    mode: "history",
});

const root = new Vue({
    el: "#root",
    router,
    render: (h) => h(App),
});
