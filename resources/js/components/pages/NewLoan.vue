<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span
                    class="icon-like-icon client-portal-icon"
                    :style="{ color: portfolio.secondary_color }"
                />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center pt-4">
                <h2 class="client-portal-heading-text">Congratulations! You're qualified for a new loan!</h2>
                <div class="mt-5">
                    <p>Click the button to apply</p>
                    <b-button
                        class="client-portal-button client-portal-btn-primary client-portal-btn-submit mt-3"
                        :style="{ 'background-color': clientPortalButton }"
                        @mouseover="clientPortalButton = portfolio.primary_color_hover"
                        @mouseleave="clientPortalButton = portfolio.primary_color"
                        @click="requestLoan"
                    >Request for New Loan</b-button>
                </div>
            </div>
        </div>
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
    name: 'NewLoan',

    components: {
        CallUsButton,
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.clientPortalButton = this.portfolio.primary_color;
    },

    methods: {
        requestLoan () {
            let form_data = {
                'lead_id': this.$store.getters.getClient.lead_id,
                'token': this.$store.getters.getClient.hash,
            };
            $.post({
                url: 'api/request-new-loan',
                data: form_data,
                success: (response) => {
                    this.$router.push('/success');
                },
                error: (response) => {
                    this.$router.push({ path: '/error', query: { type: 'new-loan' } });
                }
            });
        }
    }
};
</script>
