<template>
    <b-button
        @click="logout"
        class="client-btn-none color-darkgray font-weight-bold"
    >Logout</b-button>
</template>

<script>
'use strict';

export default {
    name: 'LogoutButton',

    computed: {
        phone_number () {
            var phone_number = this.portfolio.phone_number;
            return 'tel: +' + phone_number.replace(/-/g, '');
        },
    },

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
