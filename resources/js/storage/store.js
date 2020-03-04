import Vuex from "vuex";

import Vue from "vue";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        count: 0
    },
    mutations: {
        incrementCount(state) {
            state.count++;
        }
    },
    getters: {
        getCount: state => {
            return state.count;
        }
    }
});
