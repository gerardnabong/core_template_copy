<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span
                    class="icon-piggy-bank-icon client-portal-icon"
                    :style="{color: portfolio.secondary_color}"
                />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <h2 class="client-portal-heading-text">Congratulations! You're qualified for additional fund!</h2>
                <div class="mt-5">
                    <b-form-group>
                        <b-form-input
                            v-model="loan_amount"
                            placeholder="Loan Amount"
                            class="client-portal-form-input"
                            required
                            type="number"
                        />
                    </b-form-group>
                    <p>Click the button to apply</p>
                    <b-button
                        class="client-portal-button client-portal-btn-primary client-portal-btn-submit mt-3"
                        :style="{ 'background-color': clientPortalButton }"
                        @mouseover.native="clientPortalButton = portfolio.primary_color_hover"
                        @mouseleave.native="clientPortalButton = portfolio.primary_color"
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

const INITIAL_LOAN_AMOUNT = 200;

import CallUsButton from '~/components/templates/buttons/CallUsButton';

export default {
    name: 'NewLoan',

    components: {
        CallUsButton,
    },

    data () {
        return {
            loan_amount: INITIAL_LOAN_AMOUNT,
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.clientPortalButton = this.portfolio.primary_color;
    },
};
</script>
