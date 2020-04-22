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
            <div class="col-12 px-5">
                <error-alert />
            </div>
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
import ErrorAlert from '~/components/templates/errors/ErrorAlert';

export default {
    name: 'DecisionLogicVerifyModal',

    components: {
        ErrorAlert,
    },

    data () {
        return {
            show_ok: false,
            is_success: false,
            url: null,
            disable_button: false,
            retry_counter: 0,
            form_data: null,
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.ok_btn_color = this.portfolio.primary_color;
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
            this.retry_counter++;
            this.$store.commit('setError', null);
            if (this.retry_counter <= 2) {
                $.post({
                    url: '/api/check-verification-status',
                    data: this.form_data,
                    beforeSend: () => {
                        this.disable_button = true;
                    },
                    success: (response) => {
                        if (constants.DL_REDIRECT_PAGE_SUCCESS.includes(response)) {
                            this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_SIX);
                            this.hide();
                        } else if (constants.DL_REDIRECT_PAGE_ERROR.includes(response)) {
                            this.$router.push({ path: '/error', query: { type: 'online-verification' } });
                        }
                    },
                    error: (response) => {
                        if (response.status === 401) {
                            setTimeout(() => {
                                this.$store.commit('setClient', null);
                                this.$router.push('/');
                            }, 3000);
                        }
                        this.$store.commit('setError', response.responseJSON);
                    },
                    complete: () => {
                        this.disable_button = false;
                    }
                });
            } else {
                this.$router.push({ path: '/error', query: { type: 'online-verification' } });
            }
        },
        updateData (data) {
            this.url = data.dl_url + data.dl_code;
            this.form_data = data;
            this.form_data = Object.assign({}, this.form_data, { token: this.$store.getters.getClient.hash });
        },
    },
};
</script>
