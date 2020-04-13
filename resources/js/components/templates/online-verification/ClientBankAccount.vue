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
        <b-alert
            show
            variant="danger"
            v-if="error"
            class="client-portal-alert"
        >
            <div v-html="error.message" />
            <div
                v-for="error_type in error.errors"
                :key="error_type"
            >
                <div
                    v-for="error_message in error_type"
                    :key="error_message"
                    v-html="error_message"
                />
            </div>
        </b-alert>
        <b-form-group class="mb-3">
            <vue-mask
                v-model="formData.routing_number"
                placeholder="Bank Routing Number"
                class="form-control client-portal-form-input"
                required
                maxlength="9"
                mask="000000000"
                :raw="false"
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <vue-mask
                v-model="formData.account_number"
                placeholder="Bank Account Number"
                class="form-control client-portal-form-input"
                minlength="5"
                maxlength="17"
                required
                mask="0DDDDDDDDDDDDDDDD"
                :options='number_and_dashes'
                :raw="false"
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

import * as constants from '~/fixed_variables/constants';
import CallUsButton from '~/components/templates/buttons/CallUsButton';
import vueMask from 'vue-jquery-mask';

export default {
    name: 'ClientBankAccount',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            // TODO create constant id
            page_id: 7,
            formData: {
                routing_number: null,
                account_number: null,
            },
            number_and_dashes: {
                translation: {
                    'D': { pattern: /[\d -]+/ },
                }
            },
            error: null,
        }
    },

    components: {
        CallUsButton,
        vueMask,
    },

    methods: {
        goBack () {
            this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_FOUR);
        },
        verifyInput () {
            this.formData['hash'] = this.getHash;
            this.error = null;
            $.post({
                data: this.formData,
                url: '/api/verify-bank-details',
                success: (response) => {
                    // TODO Implement after API is Available
                    console.log(response);
                    // if (true) {
                    //     this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_SIX);
                    // }
                },
                error: (response) => {
                    this.error = response;
                }
            });
        }
    },

    computed: {
        getHash () {
            return this.$store.getters.getClient.hash;
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
