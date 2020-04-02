<template>
    <!--    TODO this file might be change or be deleted need verification on how passport works.
            This is kept only for the design
    -->
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
                        <b-form-input
                            v-model="email"
                            placeholder="Email"
                            class="client-portal-form-input"
                            required
                            type="email"
                        />
                    </b-form-group>
                    <b-form-group>
                        <b-form-input
                            v-model="ssn"
                            placeholder="SSN"
                            class="client-portal-form-input"
                            required
                            type="password"
                        />
                    </b-form-group>
                    <b-button
                        type='submit'
                        class="client-portal-btn-primary w-100 border-0"
                        :style="{ 'background-color': login_primary_color }"
                        @mouseover="login_primary_color = portfolio.primary_color_hover"
                        @mouseleave="login_primary_color = portfolio.primary_color"
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
                        {{portfolio.portfolio_name}}.
                        All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
        <login-modal ref="login-modal" />
    </div>
</template>

<script>
'use strict';

import LoginModal from '~/components/templates/modal/LoginModal';

export default {
    name: 'Login',

    components: {
        LoginModal,
    },

    data () {
        return {
            email: null,
            ssn: null,
            is_loading: false,
        };
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.login_primary_color = this.portfolio.primary_color;

    },

    methods: {
        login (event) {
            event.preventDefault();
            let data = {
                'email_address': this.email,
                'ssn': this.ssn,
            }
            $.ajax({
                type: 'POST',
                url: '/api/login-client/',
                data: data,
                beforeSend: (() => {
                    this.is_loading = true;
                    this.showLoader();
                }),
                success: ((response) => {
                    this.$store.commit('setClient', response);
                    this.$refs['login-modal'].populate(response.email_address);
                    this.$refs['login-modal'].showSuccess();
                    this.$refs['login-modal'].hideOkButton(false);
                    this.$bvModal.show('login-modal');
                    setTimeout(() => {
                        this.$router.go();
                    }, 3000);
                }),
                error: ((response) => {
                    this.$refs['login-modal'].populate(response.responseJSON);
                    this.$bvModal.show('login-modal');
                }),
                complete: (() => {
                    this.is_loading = false;
                    this.hideLoader();
                }),
            });
        },
        showLoader () {
            this.loader = this.$loading.show({
                color: this.portfolio.secondary_color,
                loader: 'dots',
                container: this.$refs.loading_container,
                'is-full-page': false,
            });
        },
        hideLoader () {
            this.loader.hide();
            this.loader = null;
        },
    },
};
</script>
