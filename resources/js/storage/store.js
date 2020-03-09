"use strict";

import Vuex from "vuex";
import Vue from "vue";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        portfolio: []
    },
    mutations: {
        setPortfolio: (state, portfolio) => {
            state.portfolio = portfolio;
        }
    },
    getters: {
        getPortfolio: state => {
            return state.portfolio;
        }
    },
    actions: {
        getPortfolio: function() {
            $.ajax({
                url: "getPortfolio",
                type: "get",
                async: false
            }).done(response => {
                this.commit("setPortfolio", response);
            });
        }
    }
});
