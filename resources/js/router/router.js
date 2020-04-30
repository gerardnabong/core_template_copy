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
            title: 'Login',
            metaTags: [
                {
                    name: 'Login description',
                    content: 'Login Content',
                }
            ]
        }
    },
    {
        path: "/register/:hash",
        component: LeadRegistration,
        meta: {
            title: 'Register',
            metaTags: [
                {
                    name: 'Register description',
                    content: 'Register Content',
                }
            ]
        }
    },
    {
        path: "/error",
        component: ErrorPage,
        name: 'error',
        meta: {
            title: 'Error',
            metaTags: [
                {
                    name: 'Error description',
                    content: 'Error Content',
                }
            ]
        },
    },
    {
        path: "/loan-action",
        component: LoanAction,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_ACTION_CLIENT_ID,
            title: 'LoanAction',
            metaTags: [
                {
                    name: 'LoanAction description',
                    content: 'LoanAction Content',
                }
            ]
        },
    },
    {
        path: "/loan-transfer",
        component: LoanTransfer,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_TRANSFER_CLIENT_ID,
            title: 'LoanTransfer',
            metaTags: [
                {
                    name: 'LoanTransfer description',
                    content: 'LoanTransfer Content',
                }
            ]
        },
    },
    {
        path: "/new-loan",
        component: NewLoan,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_RETURNING_CLIENT_ID,
            title: 'NewLoan',
            metaTags: [
                {
                    name: 'NewLoan description',
                    content: 'NewLoan Content',
                }
            ]
        },
    },
    {
        path: "/on-process",
        component: OnProcess,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_ON_GOING_CLIENT_ID,
            title: 'OnProcess',
            metaTags: [
                {
                    name: 'OnProcess description',
                    content: 'OnProcess Content',
                }
            ]
        },
    },
    {
        path: "/online-verification",
        component: OnlineVerification,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_NEW_CLIENT_ID,
            title: 'OnlineVerification',
            metaTags: [
                {
                    name: 'OnlineVerification description',
                    content: 'OnlineVerification Content',
                }
            ]
        },
    },
    {
        path: "/payment-schedule",
        component: PaymentSchedule,
        meta: {
            requiredClientStatus: constants.CLIENT_STATUS_LOAN_ON_GOING_CLIENT_ID,
            title: 'PaymentSchedule',
            metaTags: [
                {
                    name: 'PaymentSchedule description',
                    content: 'PaymentSchedule Content',
                }
            ]
        },
    },
    {
        path: "/success",
        component: SuccessPage,
        meta: {
            title: 'Success',
            metaTags: [
                {
                    name: 'Success description',
                    content: 'Success Content',
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

function metaSEO(direction) {
    return direction.matched.slice().reverse().find(route => route.meta);
}

router.beforeEach((to, from, next) => {
    let seo = metaSEO(to);
    if (seo) {
        document.title = `${seo.meta.title} | ${constants.APP_NAME}`;
    }
    Array
        .from(document.querySelectorAll('[data-vue-router-controlled]'))
        .forEach(el => el.parentNode.removeChild(el));
    if (!seo) {
        return next();
    }
    seo.meta.metaTags
        .map(tag_def => {
            const tag = document.createElement('meta');
            Object.keys(tag_def).forEach(key => {
                tag.setAttribute(key, tag_def[key]);
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
