"use strict";

export default {
    state: {
        error: null,
    },

    getters: {
        getError: state => {
            return state.error;
        },
    },

    mutations: {
        setError (state, value) {
            state.error = value;
        },
    },
}
