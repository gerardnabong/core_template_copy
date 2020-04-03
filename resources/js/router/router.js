"use strict";

import Router from "vue-router";
import Vue from "vue";
import store from "~/storage/store";
import * as constants from '~/fixed_variables/lead_status_id';

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
import LeadRegistration from "~/components/pages/LeadRegistration";

const PRE_LOADER_WHITE_BACKGROUND_TIMER_MS = 300;

Vue.use(Router);

const ROUTES = [
    {
        path: "/",
        component: Login,
    },
    {
        path: "/register",
        component: LeadRegistration,
    },
    {
        path: "/error",
        component: ErrorPage,
    },
    {
        path: "/loan-action",
        component: LoanAction,
        meta: { requiredLeadStatus: constants.LEAD_STATUS_LOAN_ON_GOING_CLIENT_ID },
    },
    {
        path: "/loan-transfer",
        component: LoanTransfer,
        meta: { requiredLeadStatus: constants.LEAD_STATUS_LOAN_TRANSFER_CLIENT_ID },
    },
    {
        path: "/new-loan",
        component: NewLoan,
        meta: { requiredLeadStatus: constants.LEAD_STATUS_RETURNING_CLIENT_ID },
    },
    {
        path: "/on-process",
        component: OnProcess,
        meta: { requiredLeadStatus: constants.LEAD_STATUS_NEW_CLIENT_ID },
    },
    {
        path: "/online-verification",
        component: OnlineVerification,
        meta: { requiredLeadStatus: constants.LEAD_STATUS_NEW_CLIENT_ID },
     },
    {
        path: "/payment-schedule",
        component: PaymentSchedule,
        meta: { requiredLeadStatus: constants.LEAD_STATUS_LOAN_ON_GOING_CLIENT_ID },
     },
    {
        path: "/success",
        component: SuccessPage,
    },
    // 404 Route should it should be on last to not overwrite the routing above
    { path: "*", component: PageNotFound },
];

let router = new Router({
    base: "/",
    mode: "history",
    routes: ROUTES
});

const public_links = [
    '/',
    '/register',
]

router.beforeResolve((to, from, next) => {
    if (!public_links.includes(to.fullPath) && store.getters.getClient === null) {
        next('/');
    }
    else if (to.fullPath === '/' && store.getters.getClient !== null) {
        switch (store.getters.getClient.lead_status_id) {
            case constants.LEAD_STATUS_NEW_CLIENT_ID:
                next('/online-verification');
                break;
            case constants.LEAD_STATUS_RETURNING_CLIENT_ID:
                next('/new-loan');
                break;
            case constants.LEAD_STATUS_LOAN_TRANSFER_CLIENT_ID:
                next('/loan-transfer');
                break;
            case constants.LEAD_STATUS_LOAN_ON_GOING_CLIENT_ID:
                next('/loan-action');
                break;
            default:
                store.commit('setClient', null);
                next('/');
                break;
        }
    }
    else if (to.matched.some(record => record.meta.requiredLeadStatus)) {
        if (to.meta.requiredLeadStatus === store.getters.getClient.lead_status_id) {
            next();
        }
        else {
            next('/');
        }

    }
    else {
        next();
    }
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
