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
                    :style="change_payment_icon_style"
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
                    :style="change_loan_icon_style"
                />
                Download Loan Agreement
            </router-link>
        </div>
    </div>
</template>

<script>
'use strict';

const COLOR_WHITE = 'white';
const COLOR_DARK_GRAY = '#2C2C2E';

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
            color: COLOR_DARK_GRAY,
            'background-color': COLOR_WHITE,
        };
        this.loan_hover = {
            color: COLOR_DARK_GRAY,
            'background-color': COLOR_WHITE,
        };
    },

    methods: {
        triggerPaymentHover () {
            this.payment_hover = {
                color: COLOR_WHITE,
                'background-color': this.portfolio.secondary_color
            };
            this.payment_icon_trigger = true;
        },
        triggerPaymentHoverLeave () {
            this.payment_hover = {
                color: COLOR_DARK_GRAY,
                'background-color': COLOR_WHITE
            };
            this.payment_icon_trigger = false;
        },
        triggerLoanHover () {
            this.loan_hover = {
                color: COLOR_WHITE,
                'background-color': this.portfolio.secondary_color,
            };
            this.loan_icon_trigger = true;
        },
        triggerLoanHoverLeave () {
            this.loan_hover = {
                color: COLOR_DARK_GRAY,
                'background-color': COLOR_WHITE,
            };
            this.loan_icon_trigger = false;
        },
    },

    computed: {
        change_payment_icon_style () {
            return { color: this.payment_icon_trigger ? COLOR_WHITE : this.portfolio.secondary_color }
        },
        change_loan_icon_style () {
            return { color: this.loan_icon_trigger ? COLOR_WHITE : this.portfolio.secondary_color }
        },
    }
};
</script>
