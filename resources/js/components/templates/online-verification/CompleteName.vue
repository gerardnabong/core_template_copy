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
            class="client-portal-btn-primary w-100 border-0"
            :style="{ 'background-color': portfolio.button_color }"
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
            first_name: null,
            last_name: null,
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
