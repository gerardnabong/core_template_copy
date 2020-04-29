<template>
    <div ref="loading_container">
        <div class="client-portal-paragraph">
            <p>
                {{$store.getters.getClient.first_name}}, the next step in the process is to verify your
                banking information electronically, for this we use a system called Decision Logic.
            </p>
            <p class="mb-4 font-italic">
                (Note, a new window or tab will open)
            </p>
        </div>
        <b-button
            class="client-portal-btn-primary border-0 mt-3 mb-3"
            :style="{ 'background-color': portfolio.primary_color }"
            @click="verifyInput"
        >
            Launch Request
        </b-button>
        <div class="my-4 client-portal-paragraph">
            Decision Logic is a third party verification system that allows us to request an
            online statement directly with you bank. It only takes a few minutes and is completely secure,
            all you need is your online banking credentials to verify your identity with your bank.
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
const PAGE_ID = 7;

export default {
    name: 'ClientBankAccount',

    mixins: [Loading],

    data () {
        return {
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
            let form_data = {
                account_number: this.client.bank_account_number,
                routing_number: this.client.bank_routing_number,
                token: this.client.hash,
            };
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
        client () {
            return this.$store.getters.getClient;
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
