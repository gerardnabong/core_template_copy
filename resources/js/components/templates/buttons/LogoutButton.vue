<template>
    <b-button
        @click="logout"
        class="client-btn-none color-darkgray font-weight-semibold"
    >Logout</b-button>
</template>

<script>
'use strict';

export default {
    name: 'LogoutButton',

    methods: {
        logout () {
            this.$store.commit('setClient', null);
            this.$router.push('/');
        },
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
