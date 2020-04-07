<template>
    <b-modal
        id="login-modal"
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
                :style="{'background-color': portfolio.primary_color}"
            />
        </div>
        <div class="row mt-4 mb-2">
            <div
                class="col-12 text-center font-size-22 font-weight-bold"
                v-if="is_success"
            >
                Welcome
            </div>
            <div
                class="col-12 mb-5 text-center font-size-16 client-portal-login-message-content px-4"
                v-html="modal_content"
            />
            <div class="col-12 text-center">
                <b-button
                    size="sm"
                    @click="$bvModal.hide('login-modal')"
                    v-if="hide_ok_button"
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
    Name: 'LoginModal',

    components: {
        HeaderClientPortal,
    },

    data () {
        return {
            modal_content: null,
            hide_ok_button: true,
            is_success: false,
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.ok_btn_color = this.portfolio.primary_color;
    },

    methods: {
        populate (content) {
            this.modal_content = content;
        },
        hideOkButton (value) {
            this.hide_ok_button = value;
        },
        showSuccess () {
            this.is_success = true;
        },
    },
};
</script>
