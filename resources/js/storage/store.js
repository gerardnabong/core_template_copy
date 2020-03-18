"use strict";

import Vuex from "vuex";
import Vue from "vue";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        progressBar: null,
    },

    getters: {
        getProgressBar: state => {
            return state.progressBar;
        }
    },

    mutations: {
        setProgressBar (state,value) {
            state.progressBar = value;
        }
    }
});
