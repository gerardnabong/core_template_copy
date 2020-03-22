<template>
    <div>
        <div class="mb-4">Are you a member of the armed forces who is serving on active duty?</div>
        <div class="row">
            <div class="col">
                <b-form-group>
                    <b-form-radio-group
                        v-model="is_military"
                        class="d-flex justify-content-center online-verification"
                        required
                    >
                        <b-form-radio
                            value="true"
                            class="military-radio-color pr-4"
                            :style="{'--radio-color': portfolio.primary_color}"
                        >
                            Yes
                        </b-form-radio>
                        <b-form-radio
                            value="false"
                            class="military-radio-color pl-4"
                            :style="{'--radio-color': portfolio.primary_color}"
                        >
                            No
                        </b-form-radio>
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
                    :style="{ 'background-color': portfolio.primary_color }"
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
    },
};
</script>

<style>
/* TODO Find a way to get rid of var */
.military-radio-color input:checked ~ .custom-control-label::before {
    background-color: var(--radio-color);
    border-color: var(--radio-color);
}
</style>
