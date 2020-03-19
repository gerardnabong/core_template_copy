<template>
    <div>
        <div class="mb-4">Can you provide me your complete name?</div>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="first_name"
                placeholder="First Name"
                class="client-portal-form-input"
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="last_name"
                placeholder="Last Name"
                class="client-portal-form-input"
            />
        </b-form-group>
        <b-button
            class="client-portal-btn-primary border-0"
            :style="{ 'background-color': portfolio.button_color }"
            @click="verifyInput"
        >
            Continue
        </b-button>
    </div>
</template>

<script>
'use strict';

export default {
    name: 'CompleteName',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            page_id: 2,
            first_name: null,
            last_name: null,
        }
    },

    methods: {
        verifyInput () {
            // TODO will add function to verify first_name and last_name after api is created
            if (true) {
                this.$store.commit('setProgressBar', 40);
            }
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
