// TODO this file might be change or be deleted need verification on how passport works.
// This is kept only for the design
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <span
                    class="icon-login-icon client-portal-icon"
                    :style="{'color': portfolio.button_color}"
                ></span>
                <b-form class="pt-4">
                    <h2 class="client-portal-heading-text">Login</h2>
                    <b-form-group class="pt-4">
                        <b-form-input
                            v-model="username"
                            placeholder="Username"
                            class="client-portal-form-input"
                        />
                    </b-form-group>
                    <b-form-group>
                        <b-form-input
                            v-model="ssn"
                            placeholder="SSN"
                            class="client-portal-form-input"
                        />
                    </b-form-group>
                    <b-button
                        class="client-portal-btn-primary w-100"
                        :style="{'background-color': login_button_color}"
                        @mouseover="login_button_color = portfolio.button_hover_color"
                        @mouseleave="login_button_color = portfolio.button_color"
                    >Login</b-button>
                </b-form>
                <div class="pt-4">
                    <p class="text-center font-size-13">Customer Portal Version 1.0.0</p>
                </div>
                <div class="pt-5">
                    <p
                        class="text-center font-size-12"
                    >Copyright &copy; 2020 Inbox Credit. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
'use strict'

export default {
    name: 'Login',

    data() {
        return {
            username: null,
            ssn: null,
        }
    },

    created() {
        this.portfolio = this.$jsVars.portfolio
        this.login_button_color = this.portfolio.button_color
    },

    methods: {
        loginButtonClick() {
            // TODO will add Login Event
        },
    },
}
</script>
