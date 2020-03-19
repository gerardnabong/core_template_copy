<template>
    <div class="container">
        <div class="row justify-content-center loan-action-container mb-2">
            <div class="col-md-6 text-center">
                <h2 class="client-portal-heading-text loan-action-heading">Loan Actions</h2>
            </div>
        </div>
        <div class="row justify-content-center align-items-center mb-0">
            <router-link
                to="/payment-schedule"
                class="loan-action-button"
                @mouseover.native="triggerPaymentHover"
                @mouseleave.native="triggerPaymentHoverLeave"
                :style="payment_hover"
            >
                <span
                    class="icon-credit-card-icon client-portal-icon mb-3"
                    :style="changePaymentIconStyle"
                />
                View Payment Schedule
            </router-link>
            <!-- TODO to="#" because no files were given for attachement -->
            <router-link
                to="#"
                class="loan-action-button"
                @mouseover.native="triggerLoanHover"
                @mouseleave.native="triggerLoanHoverLeave"
                :style="loan_hover"
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
            payment_icon_trigger: false,
            loan_icon_trigger: false,
        };
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.payment_hover = {
            color: '#2C2C2E',
            'background-color': 'white',
        };
        this.loan_hover = {
            color: '#2C2C2E',
            'background-color': 'white',
        };
    },

    methods: {
        triggerPaymentHover () {
            this.payment_hover = {
                color: 'white',
                'background-color': this.portfolio.button_color
            };
            this.payment_icon_trigger = true;
        },
        triggerPaymentHoverLeave () {
            this.payment_hover = {
                color: '#2C2C2E',
                'background-color': 'white'
            };
            this.payment_icon_trigger = false;
        },
        triggerLoanHover () {
            this.loan_hover = {
                color: 'white',
                'background-color': this.portfolio.button_color,
            };
            this.loan_icon_trigger = true;
        },
        triggerLoanHoverLeave () {
            this.loan_hover = {
                color: '#2C2C2E',
                'background-color': 'white',
            };
            this.loan_icon_trigger = false;
        },
    },

    computed: {
        changePaymentIconStyle () {
            return { color: this.payment_icon_trigger ? 'white' : this.portfolio.button_color }
        },
        changeLoanIconStyle () {
            return { color: this.loan_icon_trigger ? 'white' : this.portfolio.button_color }
        },
    }
};
</script>
