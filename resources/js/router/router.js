"use strict";

import Router from "vue-router";
import Vue from "vue";

import LoanTransfer from "~/components/pages/LoanTransfer";
import Login from "~/components/pages/Login";
import NewLoan from "~/components/pages/NewLoan";

Vue.use(Router);

const ROUTES = [
    { path: "/", component: Login },
    { path: "/loan-transfer", component: LoanTransfer },
    { path: "/new-loan", component: NewLoan },
];

export default new Router({
    base: "/",
    mode: "history",
    routes: ROUTES,
});
