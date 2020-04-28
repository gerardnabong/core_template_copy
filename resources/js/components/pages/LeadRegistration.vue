<template>
    <div class="container">
        <div class="row client-portal-vertical-height align-items-center justify-content-center">
            <div class="col-md-6 text-center">
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
                            to="/success"
                            class="client-portal-btn-primary mx-auto border-0 mt-2"
                            :style="{ 'background-color': loginPrimaryColor }"
                            @mouseover="loginPrimaryColor = portfolio.primary_color_hover"
                            @mouseleave="loginPrimaryColor = portfolio.primary_color"
                            :disabled="is_loading"
                        >
                            Call Me Now
                        </b-button>
                    </div>
                    <div class="col-sm-6">
                        <b-button
                            type='button'
                            to="/online-verification"
                            class="client-portal-btn-primary mx-auto border-0 mt-2"
                            :style="{ 'background-color': loginPrimaryColor }"
                            @mouseover="loginPrimaryColor = portfolio.primary_color_hover"
                            @mouseleave="loginPrimaryColor = portfolio.primary_color"
                            :disabled="is_loading"
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

import Login from '~/mixin/login';
import Loading from '~/mixin/loading';

const LOADING_TIMEOUT_MS = 3000;

export default {
    name: 'LeadRegistration',

    mixins: [Login, Loading],

    created () {
        this.hash = this.$route.params.hash;
        // $.post({
        //     url: '/api/send-redirect-query',
        //     data: { hash: this.hash },
        //     success: (response) => {
        //         this.$store.commit('setClient', response);
        //     },
        //     error: (response) => {
        //         this.$store.commit('setError', response.responseJSON);
        //     },
        // });
    },

    computed: {
        url () {
            return '/api/register';
        },
    }
}
</script>
