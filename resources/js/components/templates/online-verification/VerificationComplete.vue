<template>
    <div>
        <div class="mb-4">
            You have completed the online verification.
            A customer representative will contact you soon.
        </div>
        <b-button
            class="client-portal-btn-primary border-0"
            :style="{ 'background-color': portfolio.button_color }"
            @click="logout"
        >
            Logout
        </b-button>
    </div>
</template>

<script>
'use strict';

export default {
    name: 'VerificationComplete',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            page_id: 8,
        }
    },

    methods: {
        logout () {
            // TODO will add function after creating auth/passport
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
