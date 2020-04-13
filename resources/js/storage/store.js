"use strict";

import Vuex from "vuex";
import Vue from "vue";
import createPersistedState from "vuex-persistedstate";

import Client from "./modules/Client";
import ProgressBar from "./modules/ProgressBar";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        ProgressBar,
        Client,
    },
    plugins: [createPersistedState()],
});
