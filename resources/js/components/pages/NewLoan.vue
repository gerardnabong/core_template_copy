<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span class="icon-like-icon client-portal-icon" :style="iconStyle"></span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center pt-4">
                <h2
                    class="client-portal-heading-text"
                >Congratulations! You're qualified for a new loan!</h2>
                <div class="mt-5">
                    <p>Click the button to apply</p>
                    <b-button
                        class="client-portal-button client-portal-btn-primary client-portal-btn-submit mt-3"
                        :style="buttonStyle"
                    >Request for New Loan</b-button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-9 client-portal-custom-col-call-us col-sm-6 col-md-5 col-lg-4 col-xl-3 text-center mt-5 mb-5">
                <call-us-button />
            </div>
        </div>
    </div>
</template>

<script>
"use strict";

import CallUsButton from "~/components/templates/buttons/CallUsButton";

export default {
    name: 'NewLoan',

    components: {
        CallUsButton,
    },

    data() {
        return {
            portfolio: null,
        };
    },

    computed: {
        iconStyle() {
            return {
                '--color': this.portfolio.button_color,
            };
        },
        buttonStyle() {
            return {
                '--background-color': this.portfolio.button_color,
                '--background-hover-color': this.portfolio.button_hover_color,
            };
        },
    },

    created() {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
