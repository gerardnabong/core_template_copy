<template>
    <b-modal
        id="login-modal"
        :hide-header="true"
        :hide-footer="true"
        centered
        size="sm"
        modal-class="client-portal-login-modal p-0"
    >
        <div class="row no-gutters">
            <div class="col-12 position-relative">
                <div class="client-modal-background-image">
                    <img
                        :src="'/images/' + portfolio.header_image_mobile_url"
                        class="w-100"
                    >
                </div>
                <div class="client-modal-logo">
                    <img
                        :src="'/images/logo/' + portfolio.logo_url"
                        class="w-100"
                    >
                </div>
            </div>
            <div
                class="col-12 mt-4 text-center"
                v-html="modal_content"
            />
            <div class="col-12 my-4 text-center">
                <b-button
                    size="sm"
                    @click="$bvModal.hide('login-modal')"
                    v-if="hide_ok_button"
                    class="client-portal-btn-modal border-0"
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
        HeaderClientPortal
    },

    data () {
        return {
            modal_content: null,
            hide_ok_button: true,
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
        }
    },
};
</script>
