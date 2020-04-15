<template>
    <b-modal
        id="decision-logic-verify"
        :hide-header="true"
        :hide-footer="true"
        centered
        size="sm"
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
                <h2>Request Successful!</h2>
                <p>To proceed, please complete the form by clicking
                    <a href="#">here</a>.
                </p>
                <b-button
                    size="sm"
                    @click="checkVerification"
                    v-if="show_ok"
                    class="client-portal-btn-modal border-0 mb-3 pb-2"
                    :style="{ 'background-color': ok_btn_color }"
                    @mouseover="ok_btn_color = portfolio.primary_color_hover"
                    @mouseleave="ok_btn_color = portfolio.primary_color"
                >
                    Verify Request Code Status
                </b-button>
            </div>
        </div>
    </b-modal>
</template>

<script>
'use strict';

export default {
    name: 'DecisionLogicVerifyModal',


    data () {
        return {
            show_ok: false,
            is_success: false,
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
            console.log('test');
        }
    },
};
</script>
