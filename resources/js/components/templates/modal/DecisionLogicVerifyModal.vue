<template>
    <b-modal
        id="decision-logic-verify"
        :hide-header="true"
        :hide-footer="true"
        centered
        no-close-on-backdrop
        modal-class="client-portal-login-modal p-0"
    >
        <div class="row no-gutters">
            <div
                class="col-12 client-portal-modal"
                :style="{'background-color': portfolio.secondary_color}"
            />
        </div>
        <div class="row mt-2 pt-4 mb-2">
            <div class="col-12 mt-2 mb-3 text-center">
                <h5 class="font-size-22 font-weight-bold mb-4">Request Successful!</h5>
                <p>To proceed, please complete the form by clicking
                    <a
                        :href="url"
                        target="_blank"
                    >here</a>.
                </p>
                <b-button
                    size="sm"
                    @click="checkVerification"
                    v-if="show_ok"
                    class="client-portal-btn-modal border-0 mt-3 pb-2 px-4"
                    :style="{ 'background-color': ok_btn_color }"
                    @mouseover="ok_btn_color = portfolio.primary_color_hover"
                    @mouseleave="ok_btn_color = portfolio.primary_color"
                    :disabled="disable_button"
                >
                    Verify Request Code Status
                </b-button>
            </div>
        </div>
    </b-modal>
</template>

<script>
'use strict';

import * as constants from '~/fixed_variables/constants';

const GO_TO_SUCCESS_PAGE_TIMER = 15000;

export default {
    name: 'DecisionLogicVerifyModal',

    components: {
    },

    data () {
        return {
            disable_button: false,
            form_data: null,
            is_success: false,
            show_ok: false,
            url: null,
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.ok_btn_color = this.portfolio.primary_color;
        setTimeout(() => {
            this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_SIX);
            this.hide();
        }, GO_TO_SUCCESS_PAGE_TIMER);
    },

    methods: {
        showOkButton () {
            this.show_ok = true;
        },
        showSuccess () {
            this.is_success = true;
        },
        show () {
            this.$bvModal.show('decision-logic-verify');
        },
        hide () {
            this.$bvModal.hide('decision-logic-verify');
        },
        checkVerification () {
            $.post({
                url: '/api/check-verification-status',
                data: this.form_data,
                beforeSend: () => {
                    this.disable_button = true;
                },
                complete: () => {
                    this.disable_button = false;
                    this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_SIX);
                    this.hide();
                }
            });
        },
        updateData (data) {
            this.url = data.decision_logic_url + data.request_code;
            this.form_data = data;
            this.form_data = Object.assign({}, this.form_data, { token: this.$store.getters.getClient.hash });
        },
    },
};
</script>
