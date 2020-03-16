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
                to="/payment-schedule"
                class="loan-action-button"
                @mouseover.native="paymentHover = {
                    color: 'white',
                    'background-color': portfolio.button_color
                };
                PaymentIconTrigger = true;"
                @mouseleave.native="paymentHover = {
                    color: portfolio.button_color,
                    'background-color': 'white'
                };
                PaymentIconTrigger = false;"
                :style="paymentHover"
            >
                <span
                    class="icon-credit-card-icon client-portal-icon"
                    :style="{color : PaymentIconTrigger ? 'white' : portfolio.button_color}"
                />
                View Payment Schedule
            </router-link>
            <router-link
                to="#"
                class="loan-action-button"
                @mouseover.native="loanHover = {
                    color: 'white',
                    'background-color': portfolio.button_color,
                };
                LoanIconHover = true;"
                @mouseleave.native="loanHover = {
                    color: portfolio.button_color,
                    'background-color': 'white',
                };
                LoanIconHover = false;"
                :style="loanHover"
            >
                <span
                    class="icon-piggy-bank-icon client-portal-icon"
                    :style="{color : LoanIconHover ? 'white' : portfolio.button_color}"
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

    data () {
        return {
            paymentHover: null,
            loanHover: null,
            PaymentIconTrigger: false,
            LoanIconHover: false,
        };
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.paymentHover = {
            color: this.portfolio.button_color,
            'background-color': 'white',
        };
        this.loanHover = {
            color: this.portfolio.button_color,
            'background-color': 'white',
        };
    },
};
</script>
