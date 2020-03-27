<template>
    <div>
        <div class="mb-4">
            You have completed the online verification.
            A customer representative will contact you soon.
        </div>
        <b-button
            class="client-portal-btn-primary border-0"
            :style="{ 'background-color': portfolio.primary_color }"
            @click="logout"
        >
            Logout
        </b-button>
        <div class="px-3">
            <div class="d-flex justify-content-center my-5">
                <call-us-button />
            </div>
        </div>
    </div>
</template>

<script>
'use strict';

import CallUsButton from '~/components/templates/buttons/CallUsButton';

export default {
    name: 'VerificationComplete',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            // TODO create constant id
            page_id: 8,
        }
    },

    components: {
        CallUsButton,
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
