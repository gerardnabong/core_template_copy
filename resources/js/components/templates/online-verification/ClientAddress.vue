<template>
    <div>
        <div class="mb-4">Can you please provide me your complete address down to your zip code?</div>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="address"
                placeholder="Address"
                class="client-portal-form-input"
                required
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <!-- TODO Create a validation rule that validate City is in a State -->
            <b-form-input
                v-model="city"
                placeholder="City"
                class="client-portal-form-input"
                required
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <b-form-select
                v-model="state"
                :options="state_option"
                size="sm"
                class="client-portal-form-input online-verification-select"
                required
            >
            </b-form-select>
        </b-form-group>
        <b-form-group class="mb-3">
            <!-- TODO will add validation if the zip is in the city -->
            <b-form-input
                v-model="zip_code"
                placeholder="Zip Code"
                class="client-portal-form-input"
                required
                v-mask="'999999'"
            />
        </b-form-group>
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
        <div class="px-3">
            <div class="d-flex justify-content-center my-5">
                <call-us-button />
            </div>
        </div>
    </div>
</template>

<script>
'use strict';

import CallUsButton from '~/components/templates/buttons/CallUsButton';
import STATES from '~/fixed_variables/list_of_states';
import * as constants from '~/fixed_variables/online_verification_steps';

export default {
    name: 'ClientAddress',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            // TODO create constant id
            page_id: 3,
            address: null,
            city: null,
            zip_code: null,
            state: null,
        }
    },

    components: {
        CallUsButton,
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },

    methods: {
        goBack () {
            this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_ONE);
        },
        verifyInput () {
            // TODO will add function to verify after api is created
            if (true) {
                this.$store.commit('setProgressBar', constants.ONLINE_VERIFICATION_STEP_THREE);
            }
        },
    },

    computed: {
        state_option () {
            let default_option = { 'value': null, 'text': 'Select State' };
            STATES.unshift(default_option);
            return STATES;
        }
    }
};
</script>
