//TODO to="#" because no files were given for attachement
<template>
    <div class="container">
        <div class="row justify-content-center loan-action-container mb-2">
            <div class="col-md-6 text-center">
                <h2 class="client-portal-heading-text loan-action-heading">Loan Actions</h2>
            </div>
        </div>
        <div class="row justify-content-center align-items-center loan-action-button-container">
            <router-link
                to="/payment-schedule"
                class="loan-action-button"
                @mouseover.native="triggerPaymentHover"
                @mouseleave.native="triggerPaymentHoverLeave"
                :style="paymentHover"
            >
                <span
                    class="icon-credit-card-icon client-portal-icon mb-3"
                    :style="changePaymentIconStyle"
                />
                View Payment Schedule
            </router-link>
            <router-link
                to="#"
                class="loan-action-button"
                @mouseover.native="triggerLoanHover"
                @mouseleave.native="triggerLoanHoverLeave"
                :style="loanHover"
            >
                <span
                    class="icon-piggy-bank-icon client-portal-icon mb-3"
                    :style="changeLoanIconStyle"
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
            color: '#2C2C2E',
            'background-color': 'white',
        };
        this.loanHover = {
            color: '#2C2C2E',
            'background-color': 'white',
        };
    },

    methods: {
        triggerPaymentHover () {
            this.paymentHover = {
                color: 'white',
                'background-color': this.portfolio.button_color
            };
            this.PaymentIconTrigger = true;
        },
        triggerPaymentHoverLeave () {
            this.paymentHover = {
                color: '#2C2C2E',
                'background-color': 'white'
            };
            this.PaymentIconTrigger = false;
        },
        triggerLoanHover () {
            this.loanHover = {
                color: 'white',
                'background-color': this.portfolio.button_color,
            };
            this.LoanIconHover = true;
        },
        triggerLoanHoverLeave () {
            this.loanHover = {
                color: '#2C2C2E',
                'background-color': 'white',
            };
            this.LoanIconHover = false;
        },
    },

    computed: {
        changePaymentIconStyle () {
            return { color: this.PaymentIconTrigger ? 'white' : this.portfolio.button_color }
        },
        changeLoanIconStyle () {
            return { color: this.LoanIconHover ? 'white' : this.portfolio.button_color }
        },
    }
};
</script>
