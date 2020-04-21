"use strict";

import Vuex from "vuex";
import Vue from "vue";
import createPersistedState from "vuex-persistedstate";
import Cookies from 'js-cookie';

import Client from "./modules/Client";
import ProgressBar from "./modules/ProgressBar";

Vue.use(Vuex);

const EXPIRE_IN_2HRS = 2/24;

export default new Vuex.Store({
    modules: {
        ProgressBar,
        Client,
    },
    plugins: [createPersistedState({
        storage: {
            getItem: key => Cookies.get(key),
            setItem: (key, value) => Cookies.set(key, value, { expires: EXPIRE_IN_2HRS }),
            removeItem: key => Cookies.remove(key),
        },
    })],
});
