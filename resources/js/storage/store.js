"use strict";

import Vuex from "vuex";
import Vue from "vue";

import ProgressBar from "./modules/ProgressBar";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        ProgressBar,
    }
});
