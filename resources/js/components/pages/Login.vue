<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="/images/login icon.svg" alt />
                <b-form class="pt-4">
                    <h2 class="font-weight-bold font-size-24">Login</h2>
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
                    <client-portal-primary-button
                        :buttonProperty="buttonLoginProperty"
                        @buttonClick="loginButtonClick"
                    />
                </b-form>
                <div class="pt-4">
                    <p class="text-center font-size-13">Customer Portal Version 1.0.0</p>
                    <p
                        class="text-center pt-5 font-size-12"
                    >Copyright © 2020 Inbox Credit. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClientPortalPrimaryButton from "~/components/templates/buttons/ClientPortalPrimaryButton";
export default {
    name: "Login",
    components: {
        ClientPortalPrimaryButton
    },
    data() {
        return {
            username: null,
            ssn: null
        };
    },
    computed: {
        portfolio() {
            return this.$store.state.portfolio;
        },
        buttonLoginProperty() {
            return {
                class: [
                    "text-center",
                    "client-portal-login-btn",
                    "font-size-14"
                ],
                name: "Login",
                color: "#" + this.portfolio.button_color,
                hover_color: "#" + this.portfolio.button_hover_color
            };
        }
    },
    methods: {
        loginButtonClick() {
            // TODO will add Login Event
        }
    }
};
</script>
