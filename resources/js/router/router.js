import Router from "vue-router";
import Vue from "vue";

Vue.use(Router);

const ROUTES = [];

export default new Router({
    base: "/",
    mode: "history",
    routes: ROUTES
});
