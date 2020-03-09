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
                    <b-button class="client-portal-btn-primary">Login</b-button>
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
    name: "Login",

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
                color: "#" + this.portfolio.button_color,
                hover_color: "#" + this.portfolio.button_hover_color
            };
        },
        loginIcon() {
            return {
                "--color": this.portfolio.button_color
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
<style lang="scss">
.icon-login-icon {
    &::before {
        color: var(--color);
    }
}
.client-portal-btn-primary {
    background-color: var(--background-color);
    &:hover {
        background-color: var(--background-hover-color);
    }
}
</style>
