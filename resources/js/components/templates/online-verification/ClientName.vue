<template>
    <div class="row">
        <div class="col-12">
            <div class="mb-4">Can you provide me your complete name?</div>
            <b-form-group class="mb-3">
                <b-form-input
                    v-model="first_name"
                    placeholder="First Name"
                    class="client-portal-form-input"
                    required
                />
            </b-form-group>
            <b-form-group class="mb-3">
                <b-form-input
                    v-model="last_name"
                    placeholder="Last Name"
                    class="client-portal-form-input"
                    required
                />
            </b-form-group>
            <b-button
                class="client-portal-btn-primary border-0"
                :style="{ 'background-color': portfolio.primary_color }"
                @click="verifyInput"
            >
                Continue
            </b-button>
        </div>
        <div class="col">
            <div class="px-3">
                <div class="d-flex justify-content-center my-5">
                    <call-us-button />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
'use strict';

import CallUsButton from '~/components/templates/buttons/CallUsButton';

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

    components: {
        CallUsButton,
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
