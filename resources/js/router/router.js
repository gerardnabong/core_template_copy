"use strict";

import Router from "vue-router";
import Vue from "vue";
import ErrorPage from "~/components/pages/ErrorPage";
import LoanTransfer from "~/components/pages/LoanTransfer";
import Login from "~/components/pages/Login";
import NewLoan from "~/components/pages/NewLoan";
import SuccessPage from "~/components/pages/SuccessPage";
import OnProcess from "~/components/pages/OnProcess";
import LoanAction from "~/components/pages/LoanAction";

Vue.use(Router);

const ROUTES = [
    { path: "/", component: Login },
    { path: "/error", component: ErrorPage },
    { path: "/loan-action", component: LoanAction },
    { path: "/loan-transfer", component: LoanTransfer },
    { path: "/new-loan", component: NewLoan },
    { path: "/on-process", component: OnProcess },
    { path: "/success", component: SuccessPage },
];

export default new Router({
    base: "/",
    mode: "history",
    routes: ROUTES,
});
