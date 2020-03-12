// TODO this file might be change or be deleted need verification on how passport works.
// This is kept only for the design
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <span class="icon-login-icon client-portal-icon" :style="loginIcon"></span>
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
                    <b-button class="client-portal-btn-primary w-100" :style="buttonStyle">Login</b-button>
                </b-form>
                <div class="pt-4">
                    <p class="text-center font-size-13">Customer Portal Version 1.0.0</p>
                </div>
                <div class="pt-5">
                    <p
                        class="text-center font-size-12"
                    >Copyright © 2020 Inbox Credit. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login',

    data() {
        return {
            username: null,
            ssn: null,
        };
    },

    computed: {
        buttonStyle() {
            return {
                '--background-color': this.portfolio.button_color,
                '--background-hover-color': this.portfolio.button_hover_color,
            };
        },
        loginIcon() {
            return {
                '--color': this.portfolio.button_color,
            };
        },
    },

    created() {
        this.portfolio = this.$jsVars.portfolio;
    },

    methods: {
        loginButtonClick() {
            // TODO will add Login Event
        },
    },
};
</script>
