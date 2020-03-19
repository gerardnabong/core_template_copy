<template>
    <div>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="routing_number"
                placeholder="Bank Account Routing Number"
                class="client-portal-form-input"
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="account_number"
                placeholder="Bank Account Number"
                class="client-portal-form-input"
            />
        </b-form-group>
        <b-button
            class="client-portal-btn-primary border-0 w-100"
            :style="{ 'background-color': portfolio.button_color }"
            @click="verifyInput"
        >
            Send Request
        </b-button>
        <div class="my-3">
            Please check your email. You will be directed to our bank verification page.
        </div>
        <div class="mt-3">
            <b-button
                class="client-portal-btn-secondary w-100"
                @click="goBack"
            >
                Back
            </b-button>
        </div>
    </div>
</template>

<script>
'use strict';

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

    methods: {
        goBack () {
            this.$store.commit('setProgressBar', 80);
        },
        verifyInput () {
            // TODO will add function to verify after api is created
            if (true) {
                this.$store.commit('setProgressBar', 100);
            }
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
