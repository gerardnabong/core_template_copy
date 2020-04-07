<template>
    <div>
        <div class="mb-2">
            We are reviewing your application now!
            One of our team members will be calling you shortly.
        </div>
        <b-button
            class="client-portal-btn-primary border-0 mt-2"
            :style="{ 'background-color': portfolio.primary_color }"
            @click="logout"
        >
            Logout
        </b-button>
        <div class="mt-5">
            <p class="client-portal-paragraph">
                If you would like to speak with us now,
                please click the call button below.
                Thank you!
            </p>
        </div>
        <div>
            <div class="d-flex justify-content-center mb-5">
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
