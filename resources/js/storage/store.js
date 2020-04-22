"use strict";

import Vuex from "vuex";
import Vue from "vue";
import createPersistedState from "vuex-persistedstate";
import Cookies from 'js-cookie';

import Client from "./modules/Client";
import ProgressBar from "./modules/ProgressBar";
import Error from "./modules/Error";

Vue.use(Vuex);

const EXPIRE_IN_2HRS = 2/24;

export default new Vuex.Store({
    modules: {
        ProgressBar,
        Client,
        Error,
    },
    filter :{
        Client,
        ProgressBar,
    },
    // TODO Find a better solution for this part also set in the future that only the hash will be save on the client
    plugins: [createPersistedState({
        storage: {
            getItem: key => Cookies.get(key),
            setItem: (key, value) => Cookies.set(key, value, { expires: EXPIRE_IN_2HRS }),
            removeItem: key => Cookies.remove(key),
        },
    })],
});
