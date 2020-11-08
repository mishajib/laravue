/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import VueRouter from "vue-router";
import VueProgressBar from "vue-progressbar";
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

const VueProgressBarOptions = {
    color: "#0277bd",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300
    },
    autoRevert: true,
    location: "top",
    inverse: false
};

Vue.use(VueRouter);
Vue.use(VueProgressBar, VueProgressBarOptions);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import App from "./views/App";
import Home from "./views/Home";
import About from "./views/About";
import UserIndex from "./views/UserIndex";
import NotFound from "./components/NotFound";

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/about",
        name: "about",
        component: About
    },
    {
        path: "/users",
        name: "users.index",
        component: UserIndex
    },
    {
        path: '*',
        component: NotFound
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

const app = new Vue({
    el: "#app",
    components: {App},
    router,
    created() {
        Echo.channel('testChannel')
            .listen('TaskEvent', (e) => {
                console.log(e);
            });
    },
});
