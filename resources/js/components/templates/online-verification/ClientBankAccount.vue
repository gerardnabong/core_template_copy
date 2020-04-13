<template>
    <div>
        <div class="client-portal-paragraph">
            <p>
                We need to verify your bank account information in order to proceed.
                Please enter your information below:
            </p>
            <p class="mb-4 font-italic">
                (Note, a new window or tab will open)
            </p>
        </div>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="routing_number"
                placeholder="Bank Routing Number"
                class="client-portal-form-input"
                v-mask="'999999999'"
                required
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="account_number"
                placeholder="Bank Account Number"
                class="client-portal-form-input"
                maxlength="15"
                required
            />
        </b-form-group>
        <b-button
            class="client-portal-btn-primary border-0 mt-3 mb-3"
            :style="{ 'background-color': portfolio.primary_color }"
            @click="verifyInput"
        >
            Send Request
        </b-button>
        <div class="my-4 client-portal-paragraph">
            If you would like to complete your bank verification over the phone.
            Please click the call us button below:
        </div>
        <div>
            <div class="d-flex justify-content-center my-4">
                <call-us-button />
            </div>
        </div>
    </div>
</template>

<script>
'use strict';

import CallUsButton from '~/components/templates/buttons/CallUsButton';
import * as constants from '~/fixed_variables/constants';

export default {
    name: 'ClientBankAccount',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            // TODO create constant id
            page_id: 7,
            routing_number: null,
            account_number: null,
        }
    },

    components: {
        CallUsButton,
    },

    methods: {
        goBack () {
            this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_FOUR);
        },
        verifyInput () {
            // TODO will add function to verify after api is created
            if (true) {
                this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_SIX);
            }
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
