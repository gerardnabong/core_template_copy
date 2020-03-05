import Router from "vue-router";
import Vue from "vue";
import Login from "~/components/Pages/Login";

Vue.use(Router);

const ROUTES = [{ path: "/", component: Login }];

export default new Router({
    base: "/",
    mode: "history",
    routes: ROUTES
});
