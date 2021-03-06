<template>
    <div ref="loading_container">
        <div class="client-portal-paragraph">
            <p>
                We need to verify your bank account information in order to proceed.
                Please enter your information below:
            </p>
            <p class="mb-4 font-italic">
                (Note, a new window or tab will open)
            </p>
        </div>
        <error-alert />
        <b-form-group class="mb-3">
            <vue-mask
                v-model="form_data.routing_number"
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
                v-model="form_data.account_number"
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
        <decision-logic-verify-modal ref="decisionModal" />
    </div>
</template>

<script>
'use strict';

import * as constants from '~/fixed_variables/constants';
import CallUsButton from '~/components/templates/buttons/CallUsButton';
import DecisionLogicVerifyModal from '~/components/templates/modal/DecisionLogicVerifyModal';
import ErrorAlert from '~/components/templates/errors/ErrorAlert';
import Loading from '~/mixin/loading';
import vueMask from 'vue-jquery-mask';

const DECISION_LOGIC_TIMEOUT_LIMIT_MS = 60000;

export default {
    name: 'ClientBankAccount',

    mixins: [Loading],

    data () {
        return {
            // TODO will change when created Database Entry for Page
            // TODO create constant id
            page_id: 7,
            form_data: {
                routing_number: null,
                account_number: null,
            },
            number_and_dashes: {
                translation: {
                    'D': { pattern: /[\d -]+/ },
                },
            },
        }
    },

    components: {
        CallUsButton,
        vueMask,
        DecisionLogicVerifyModal,
        ErrorAlert,
    },

    methods: {
        verifyInput () {
            let form_data = Object.assign({}, this.form_data, { token: this.token });
            this.$store.commit('setError', null);
            $.post({
                data: form_data,
                url: '/api/verify-bank-details',
                beforeSend: () => {
                    this.showLoader();
                },
                success: (response) => {
                    let url = response.decision_logic_url + response.request_code
                    window.open(url, '_blank');
                    let decisionModal = this.$refs['decisionModal'];
                    decisionModal.updateData(response);
                    decisionModal.showOkButton();
                    decisionModal.show();
                },
                error: (response) => {
                    this.$store.commit('setError', response.responseJSON);
                    // TODO set code to global constants
                    if (response.status === 401) {
                        setTimeout(() => {
                            this.$store.commit('setClient', null);
                            this.$router.push('/');
                        }, 3000);
                    }
                },
                complete: () => {
                    this.hideLoader();
                },
            });
        }
    },

    computed: {
        token () {
            return this.$store.getters.getClient.hash;
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
