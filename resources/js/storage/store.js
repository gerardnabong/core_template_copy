"use strict";

import Vuex from "vuex";
import Vue from "vue";
import createPersistedState from "vuex-persistedstate";

import Client from "./modules/Client";
import ProgressBar from "./modules/ProgressBar";
import Error from "./modules/Error";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        ProgressBar,
        Client,
        Error,
    },
    plugins: [createPersistedState()],
});
