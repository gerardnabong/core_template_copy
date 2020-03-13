<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span
                    class="icon-like-icon client-portal-icon"
                    :style="{ color: portfolio.button_color }"
                />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center pt-4">
                <h2
                    class="client-portal-heading-text"
                >Congratulations! You're qualified for a new loan!</h2>
                <div class="mt-5">
                    <p class="client-portal-paragraph">Click the button to apply</p>
                    <b-button
                        class="client-portal-button client-portal-btn-primary client-portal-btn-submit mt-3"
                        :style="{ 'background-color': clientPortalButton }"
                        @mouseover="clientPortalButton = portfolio.button_hover_color"
                        @mouseleave="clientPortalButton = 'white'"
                    >Request for New Loan</b-button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="d-flex my-5">
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

    created() {
        this.portfolio = this.$jsVars.portfolio;
        this.clientPortalButton = this.portfolio.button_color;
    },

    methods: {
        callNumber() {
            // TODO Add function to call
            alert('This is clickable');
        },
    },
};
</script>
