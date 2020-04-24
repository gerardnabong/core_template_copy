"use strict";

export default {
    state: {
        client: null,
    },

    getters: {
        getClient: state => {
            return state.client;
        },
    },

    mutations: {
        setClient (state, value) {
            state.client = value;
        },
    },
}
