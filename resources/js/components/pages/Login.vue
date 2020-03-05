<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="/images/login icon.svg" alt />
                <b-form class="pt-4">
                    <h2>Login</h2>
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
                        class="text-center client-portal-login-btn"
                        :style="{'background-color': portfolio.button_color}"
                    >Login</b-button>
                </b-form>
                <div class="pt-5">
                    <p class="text-center">Customer Portal Version 1.0.0</p>
                    <p class="text-center pt-5">Copyright © 2020 Inbox Credit. All Rights Reserved.</p>
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
        }
    }
};
</script>
