<template>
    <b-modal
        id="welcome-message-modal"
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
            <div
                class="col-12 text-center font-size-22 font-weight-bold"
                v-if="isSuccess"
            >
                Welcome
            </div>
            <p
                class="mt-2 mb-5 text-center font-size-16 client-portal-login-message-content mx-auto"
                v-if="$store.getters.getClient"
                v-html="$store.getters.getClient.first_name"
            />
            <div class="col-12 mt-4 mb-3 text-center">
                <b-button
                    size="sm"
                    @click="$bvModal.hide('welcome-message-modal')"
                    v-if="!hideOk"
                    class="client-portal-btn-modal border-0 mb-3 pb-2"
                    :style="{ 'background-color': ok_btn_color }"
                    @mouseover="ok_btn_color = portfolio.primary_color_hover"
                    @mouseleave="ok_btn_color = portfolio.primary_color"
                >
                    OK
                </b-button>
            </div>
        </div>
    </b-modal>
</template>

<script>
'use strict';

import HeaderClientPortal from '~/components/templates/Header';

export default {
    name: 'WelcomeMessageModal',

    components: {
        HeaderClientPortal,
    },

    data () {
        return {
            hideOk: false,
            isSuccess: false,
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.ok_btn_color = this.portfolio.primary_color;
    },

    methods: {
        hideOkButton () {
            this.hideOk = true;
        },
        showSuccess () {
            this.isSuccess = true;
        },
        show () {
            this.$bvModal.show('welcome-message-modal');
        },
        hide () {
            this.$bvModal.hide('welcome-message-modal');
        }
    },
};
</script>
