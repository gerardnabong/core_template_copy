<template>
    <div class="container">
        <div class="row client-portal-vertical-height align-items-center justify-content-center">
            <div
                class="col-md-6 text-center"
                ref="loading_container"
            >
                <i
                    class="fas fa-handshake client-portal-icon"
                    :style="{ color: portfolio.secondary_color }"
                />
                <h2 class="client-portal-heading-text">
                    Welcome! <br> We’re happy to be working with you!
                </h2>
                <p class="client-portal-paragraph mt-4">
                    To get started, choose between two options:
                </p>
                <div class="row">
                    <div class="col-sm-6">
                        <b-button
                            type='button'
                            class="client-portal-btn-primary mx-auto border-0 mt-2"
                            :style="{ 'background-color': loginPrimaryColor }"
                            @mouseover="loginPrimaryColor = portfolio.primary_color_hover"
                            @mouseleave="loginPrimaryColor = portfolio.primary_color"
                            :disabled="is_loading"
                            @click.prevent="btnCallMe"
                        >
                            Call Me Now
                        </b-button>
                    </div>
                    <div class="col-sm-6">
                        <b-button
                            type='button'
                            class="client-portal-btn-primary mx-auto border-0 mt-2"
                            :style="{ 'background-color': loginPrimaryColor }"
                            @mouseover="loginPrimaryColor = portfolio.primary_color_hover"
                            @mouseleave="loginPrimaryColor = portfolio.primary_color"
                            :disabled="is_loading"
                            @click.prevent="btnBankVerification"
                        >
                            Instant Bank Verification
                        </b-button>
                    </div>
                </div>
            </div>
        </div>
        <welcome-message-modal ref="welcomeMessageModal" />
    </div>
</template>

<script>
'use strict';

import * as constants from '~/fixed_variables/constants';
import Loading from '~/mixin/loading';
import Login from '~/mixin/login';
import PageAction from '~/mixin/page_action';

const LOADING_TIMEOUT_MS = 3000;

export default {
    name: 'LeadRegistration',

    mixins: [Login, Loading, PageAction],

    created () {
        let hash = this.$route.params.hash;
        $.post({
            url: '/api/login-client',
            data: { hash: hash },
            beforeSend: () => {
                this.showLoader();
            },
            success: (response) => {
                this.$store.commit('setClient', response);
            },
            error: (response) => {
                // TODO Fix Error where loading is not remove unless refresh
                // this.$router.push({ path: '/error', query: { type: 'register', hash: hash } });
            },
            complete: () => {
                this.hideLoader();
            }
        });
    },

    computed: {
        url () {
            return '/api/register';
        },

        page_id () {
            return constants.PAGE_REGISTER_ID;
        }
    },

    methods: {
        btnCallMe () {
            let data = {
                button_name: 'call_me',
                is_button_click: 1,
                clicked_at: this.moment().format('YYYY-MM-DD HH:mm:ss'),
            };
            this.saveAction(data);
            this.$router.push('/success');
        },
        btnBankVerification () {
            let data = {
                button_name: 'instant_bank_verification',
                is_button_click: 1,
                clicked_at: this.moment().format('YYYY-MM-DD HH:mm:ss'),
            };
            this.saveAction(data);
            this.$router.push('/online-verification');
        }
    }
}
</script>
