<template>
    <div>
        <div class="mb-4">Are you a member of the armed forces who is serving on active duty?</div>
        <div class="row">
            <div class="col">
                <b-form-group>
                    <b-form-radio-group
                        v-model="is_military"
                        class="d-flex justify-content-around online-verification"
                    >
                        <b-form-radio value="true">Yes</b-form-radio>
                        <b-form-radio value="false">No</b-form-radio>
                    </b-form-radio-group>
                </b-form-group>
            </div>
        </div>
        <div class="row online-verification-button-group">
            <div class="col-md-5 mt-3">
                <b-button
                    class="client-portal-btn-secondary w-100"
                    @click="goBack"
                >
                    Back
                </b-button>
            </div>
            <div class="col-md-7 mt-3">

                <b-button
                    class="client-portal-btn-primary border-0 w-100"
                    :style="{ 'background-color': portfolio.button_color }"
                    @click="verifyInput"
                >
                    Continue
                </b-button>
            </div>
        </div>
    </div>
</template>

<script>
'use strict';

export default {
    name: 'ClientMilitaryStatus',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            page_id: 6,
            is_military: true,
        }
    },

    methods: {
        goBack () {
            this.$store.commit('setProgressBar', 60);
        },
        verifyInput () {
            // TODO will add function to verify after api is created
            if (this.is_military == 'false') {
                this.$store.commit('setProgressBar', 90);
            }
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.radio_button_color = this.portfolio.button_color;
    },
};
</script>
