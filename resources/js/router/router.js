"use strict";

import Router from "vue-router";
import Vue from "vue";

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

const PRE_LOADER_WHITE_BACKGROUND_TIMER_MS = 300;

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
    routes: ROUTES
});

router.afterEach(() => {
    const preLoader = document.querySelector('.client-portal-pre-loader');
    if (preLoader) {
        setTimeout(() => {
            preLoader.parentNode.removeChild(preLoader);
        }, PRE_LOADER_WHITE_BACKGROUND_TIMER_MS);
    }
});

export default router;
