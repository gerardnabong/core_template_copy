<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <span
                    class="icon-login-icon client-portal-icon"
                    :style="{ color: portfolio.secondary_color }"
                />
                <b-form
                    class="pt-4"
                    @submit="login"
                    ref="loading_container"
                >

                    <h2 class="client-portal-heading-text">Login</h2>
                    <b-form-group class="pt-4">
                        <b-alert
                            show
                            variant="danger"
                            v-if="error"
                            class="client-portal-alert"
                        >
                            <div v-html="error.message" />
                            <div
                                v-for="error_type in error.errors"
                                :key="error_type"
                            >
                                <div
                                    v-for="error_message in error_type"
                                    :key="error_message"
                                    v-html="error_message"
                                />
                            </div>
                        </b-alert>
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
                        class="client-portal-btn-primary w-100 border-0"
                        :style="{ 'background-color': loginPrimaryColor }"
                        @mouseover="loginPrimaryColor = portfolio.primary_color_hover"
                        @mouseleave="loginPrimaryColor = portfolio.primary_color"
                        :disabled="is_loading"
                    >
                        Login
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

export default {
    name: 'Login',

    mixins: [Login],



};
</script>
