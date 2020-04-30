"use strict";

import Router from "vue-router";
import Vue from "vue";
import store from "~/storage/store";
import * as constants from '~/fixed_variables/constants';

import ErrorPage from "~/components/pages/ErrorPage";
import LeadRegistration from "~/components/pages/LeadRegistration";
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
    {
        path: "/",
        component: Login,
        meta: {
            title: 'Login | Customer Portal',
            metaTags: [
                {
                    name: 'Login description',
                    content: 'Login Content'
                }
            ]
        }
    },
    {
        path: "/register/:hash",
        component: LeadRegistration,
        meta: {
            title: 'Register | Customer Portal',
            metaTags: [
                {
                    name: 'Register description',
                    content: 'Register Content'
                }
            ]
        }
    },
    {
        path: "/error",
        component: ErrorPage,
        name: 'error',
        meta: {
            title: 'Error | Customer Portal',
            metaTags: [
                {
                    name: 'Error description',
                    content: 'Error Content'
                }
            ]
        },
    },
    {
        path: "/loan-action",
        component: LoanAction,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_ACTION_CLIENT_ID,
            title: 'LoanAction | Customer Portal',
            metaTags: [
                {
                    name: 'LoanAction description',
                    content: 'LoanAction Content'
                }
            ]
        },
    },
    {
        path: "/loan-transfer",
        component: LoanTransfer,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_TRANSFER_CLIENT_ID,
            title: 'LoanTransfer | Customer Portal',
            metaTags: [
                {
                    name: 'LoanTransfer description',
                    content: 'LoanTransfer Content'
                }
            ]
        },
    },
    {
        path: "/new-loan",
        component: NewLoan,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_RETURNING_CLIENT_ID,
            title: 'NewLoan | Customer Portal',
            metaTags: [
                {
                    name: 'NewLoan description',
                    content: 'NewLoan Content'
                }
            ]
        },
    },
    {
        path: "/on-process",
        component: OnProcess,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_ON_GOING_CLIENT_ID,
            title: 'OnProcess | Customer Portal',
            metaTags: [
                {
                    name: 'OnProcess description',
                    content: 'OnProcess Content'
                }
            ]
        },
    },
    {
        path: "/online-verification",
        component: OnlineVerification,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_NEW_CLIENT_ID,
            title: 'OnlineVerification | Customer Portal',
            metaTags: [
                {
                    name: 'OnlineVerification description',
                    content: 'OnlineVerification Content'
                }
            ]
        },
    },
    {
        path: "/payment-schedule",
        component: PaymentSchedule,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_ON_GOING_CLIENT_ID,
            title: 'PaymentSchedule | Customer Portal',
            metaTags: [
                {
                    name: 'PaymentSchedule description',
                    content: 'PaymentSchedule Content'
                }
            ]
        },
    },
    {
        path: "/success",
        component: SuccessPage,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_ON_GOING_CLIENT_ID,
            title: 'Success | Customer Portal',
            metaTags: [
                {
                    name: 'Success description',
                    content: 'Success Content'
                }
            ]
        },
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
    '',
    '/register/:hash',
]

router.beforeResolve((to, from, next) => {
    if (!public_links.includes(to.matched[0].path) && !store.getters.getClient) {
        next('/');
    } else if (public_links.includes(to.matched[0].path) && store.getters.getClient ) {
        switch (store.getters.getClient.client_status_id) {
            case constants.CLIENT_STATUS_NEW_CLIENT_ID:
                next('online-verification');
                break;
            case constants.CLIENT_STATUS_RETURNING_CLIENT_ID:
                next('new-loan');
                break;
            case constants.CLIENT_STATUS_LOAN_ON_GOING_CLIENT_ID:
                next('on-process');
                break;
            case constants.CLIENT_STATUS_LOAN_TRANSFER_CLIENT_ID:
                next('loan-transfer');
                break;
            case constants.CLIENT_STATUS_LOAN_ACTION_CLIENT_ID:
                next('loan-action');
                break;
            default:
                store.commit('setClient', null);
                next('/');
        }
    } else if (to.matched.some(record => record.meta.requiredClientStatus)) {
        if (to.meta.requiredClientStatus === store.getters.getClient.client_status_id) {
            next();
        } else {
            next('/');
        }
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    const nearestWithTitle = to.matched.slice().reverse().find(route => route.meta && route.meta.title);
    const nearestWithMeta = to.matched.slice().reverse().find(route => route.meta && route.meta.metaTags);
    const previousNearestWithMeta = from.matched.slice().reverse().find(route => route.meta && route.meta.metaTags);
    if (nearestWithTitle) document.title = nearestWithTitle.meta.title;
    Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));
    if (!nearestWithMeta) return next();
    nearestWithMeta.meta.metaTags.map(tagDef => {
        const tag = document.createElement('meta');
        Object.keys(tagDef).forEach(key => {
            tag.setAttribute(key, tagDef[key]);
        });
        tag.setAttribute('data-vue-router-controlled', '');

        return tag;
    })
    .forEach(tag => document.head.appendChild(tag));
    next();
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
