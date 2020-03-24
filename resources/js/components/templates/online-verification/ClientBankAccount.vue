<template>
    <div>
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
                v-mask="'9999999999'"
                required
            />
        </b-form-group>
        <b-button
            class="client-portal-btn-primary border-0 mt-3 mb-2"
            :style="{ 'background-color': portfolio.primary_color }"
            @click="verifyInput"
        >
            Send Request
        </b-button>
        <div class="mb-4 mt-3">
            Please check your email. You will be directed to our bank verification page.
        </div>
        <div class="mt-4">
            <b-button
                class="client-portal-btn-secondary"
                @click="goBack"
            >
                Back
            </b-button>
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

const PROGRESS_BAR_PREV = 80;
const PROGRESS_BAR_NEXT = 100;

export default {
    name: 'ClientBankAccount',

    data () {
        return {
            // TODO will change when created Database Entry for Page
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
            this.$store.commit('setProgressBar', PROGRESS_BAR_PREV);
        },
        verifyInput () {
            // TODO will add function to verify after api is created
            if (true) {
                this.$store.commit('setProgressBar', PROGRESS_BAR_NEXT);
            }
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
