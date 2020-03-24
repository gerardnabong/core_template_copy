"use strict";

export default {
    state: {
        progressBar: null,
    },

    getters: {
        getProgressBar: state => {
            return state.progressBar;
        },
    },

    mutations: {
        setProgressBar (state, value) {
            state.progressBar = value;
        },
    },
}
