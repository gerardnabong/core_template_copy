"use strict";

import Router from "vue-router";
import Vue from "vue";
import store from "~/storage/store";

import ErrorPage from "~/components/pages/ErrorPage";
import LoanAction from "~/components/pages/LoanAction";
import LoanTransfer from "~/components/pages/LoanTransfer";
import Login from "~/components/pages/Login";
import NewLoan from "~/components/pages/NewLoan";
import OnlineVerification from "~/components/pages/OnlineVerification";
import OnProcess from "~/components/pages/OnProcess";
import PageNotFound from "~/components/templates/errors/PageNotFound";
import PaymentSchedule from "~/components/pages/PaymentSchedule";
import SuccessPage from "~/components/pages/SuccessPage";

Vue.use(Router);

const ROUTES = [
    { path: "/", component: Login },
    { path: "/error", component: ErrorPage },
    { path: "/loan-action", component: LoanAction },
    { path: "/loan-transfer", component: LoanTransfer },
    { path: "/new-loan", component: NewLoan },
    { path: "/on-process", component: OnProcess },
    { path: "/online-verification", component: OnlineVerification },
    { path: "/payment-schedule", component: PaymentSchedule },
    { path: "/success", component: SuccessPage },
    // 404 Route should it should be on last to not overwrite the routing above
    { path: "*", component: PageNotFound },
];

let router = new Router({
    base: "/",
    mode: "history",
    routes: ROUTES,
});

router.beforeResolve((to, from, next) => {
    if (to.fullPath !== '/' && store.getters.getClient === null) next({ path: '/' });
    else{ next(); }
});

router.afterEach(() => {
    const preLoader = document.querySelector('.client-portal-pre-loader');
    if(preLoader) {
       setTimeout(() => {
           preLoader.parentNode.removeChild(preLoader);
       },300);
    }
});

export default router;
