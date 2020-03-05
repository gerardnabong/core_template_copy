import Vuex from "vuex";
import axios from "axios";
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
            axios.get("/getPortfolio").then(response => {
                this.commit("setPortfolio", response.data);
            });
        }
    }
}).dispatch("getPortfolio");
