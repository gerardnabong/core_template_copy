<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <i
                    class="fas fa-handshake client-portal-icon"
                    :style="{ color: portfolio.secondary_color }"
                />
                <b-form
                    class="pt-4"
                    @submit.prevent="login"
                    ref="loading_container"
                >
                    <h2 class="client-portal-heading-text">
                        <!-- TODO Firstname will be base on the redirect link url -->
                        Welcome! <br> We’re happy to be working with you!
                    </h2>
                    <p class="client-portal-paragraph mt-4">
                        To get started, we need to create your user account:
                    </p>
                    <error-alert />
                    <b-form-group class="pt-4">
                        <b-form-input
                            v-model="form_data.email_address"
                            placeholder="Email"
                            class="client-portal-form-input"
                            required
                            type="email"
                        />
                    </b-form-group>
                    <b-form-group>
                        <b-form-input
                            v-model="form_data.ssn"
                            placeholder="SSN"
                            class="client-portal-form-input"
                            required
                            type="password"
                        />
                    </b-form-group>
                    <b-button
                        type='submit'
                        class="client-portal-btn-primary px-5 border-0 mt-2"
                        :style="{ 'background-color': loginPrimaryColor }"
                        @mouseover="loginPrimaryColor = portfolio.primary_color_hover"
                        @mouseleave="loginPrimaryColor = portfolio.primary_color"
                        :disabled="is_loading"
                    >
                        Setup my Account
                    </b-button>
                </b-form>
                <div class="pt-4">
                    <p class="text-center font-size-13">
                        Customer Portal Version 1.0.0
                    </p>
                </div>
                <div class="pt-5">
                    <p class="text-center font-size-12">
                        Copyright &copy;
                        {{(new Date()).getFullYear()}}
                        {{portfolio.display_name}}.
                        All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
        <welcome-message-modal ref="welcomeMessageModal" />
    </div>
</template>

<script>
'use strict';

import Login from '~/mixin/login';

const LOADING_TIMEOUT_MS = 3000;

export default {
    name: 'LeadRegistration',

    mixins: [Login],

    created () {
        this.hash = this.$route.params.hash;
        $.post({
            url: '/api/send-redirect-query',
            data: { hash: this.hash },
        })
    },

    computed: {
        url () {
            return '/api/register';
        },
    }
}
</script>
