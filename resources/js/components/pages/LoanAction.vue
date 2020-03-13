//TODO to="#" because no files were given for attachement
<template>
    <div class="container">
        <div class="row justify-content-center mt-5 mb-2">
            <div class="col-md-6 text-center pt-4">
                <h2 class="client-portal-heading-text loan-action-heading">Loan Actions</h2>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <router-link
                to="#"
                class="loan-action-button"
                @mouseover.native="paymentHover = {
                    color: 'white',
                    'background-color': portfolio.button_color
                }"
                @mouseleave.native="paymentHover = {
                    color: portfolio.button_color,
                    'background-color': 'white'
                }"
                :style="{paymentHover}"
            >
                <span
                    class="icon-credit-card-icon client-portal-icon"
                    :style="{color: portfolio.button_color}"
                />
                View Payment Schedule
            </router-link>
            <router-link to="#" class="loan-action-button">
                <span
                    class="icon-piggy-bank-icon client-portal-icon"
                    :style="{color: portfolio.button_color}"
                />
                Download Loan Agreement
            </router-link>
        </div>
    </div>
</template>

<script>
'use strict';

export default {
    name: 'LoanAction',
    watch: {
        paymentHover: function(newPayment) {
            console.log(newPayment);
        },
    },

    created() {
        this.portfolio = this.$jsVars.portfolio;
        this.paymentHover = {
            color: this.portfolio.button_color,
            'background-color': 'white',
        };
    },
};
</script>
