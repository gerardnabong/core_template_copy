<template>
    <div>
        <div class="mb-4">Can you please provide me your complete address down to your zip code?</div>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="address"
                placeholder="Address"
                class="client-portal-form-input"
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="city"
                placeholder="City"
                class="client-portal-form-input"
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <b-form-select
                v-model="state"
                :options="state_option"
                size="sm"
                class="client-portal-form-input online-verification-select"
            />
        </b-form-group>
        <b-form-group class="mb-3">
            <b-form-input
                v-model="zip_code"
                placeholder="Zip Code"
                class="client-portal-form-input"
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
    name: 'ClientAddress',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            page_id: 3,
            address: null,
            city: null,
            zip_code: null,
            state: null,
            state_option: [
                { value: null, text: 'State', disabled: true },
                { 'value': "AL", 'text': 'Alabama' },
                { 'value': "AK", 'text': 'Alaska' },
                { 'value': "AZ", 'text': 'Arizona' },
                { 'value': "AR", 'text': 'Arkansas' },
                { 'value': "CA", 'text': 'California' },
                { 'value': "CO", 'text': 'Colorado' },
                { 'value': "CT", 'text': 'Connecticut' },
                { 'value': "DE", 'text': 'Delaware' },
                { 'value': "FL", 'text': 'Florida' },
                { 'value': "GA", 'text': 'Georgia' },
                { 'value': "HI", 'text': 'Hawaii' },
                { 'value': "ID", 'text': 'Idaho' },
                { 'value': "IL", 'text': 'Illinois' },
                { 'value': "IN", 'text': 'Indiana' },
                { 'value': "IA", 'text': 'Iowa' },
                { 'value': "KS", 'text': 'Kansas' },
                { 'value': "KY", 'text': 'Kentucky' },
                { 'value': "LA", 'text': 'Louisiana' },
                { 'value': "ME", 'text': 'Maine' },
                { 'value': "MD", 'text': 'Maryland' },
                { 'value': "MA", 'text': 'Massachusetts' },
                { 'value': "MI", 'text': 'Michigan' },
                { 'value': "MN", 'text': 'Minnesota' },
                { 'value': "MS", 'text': 'Mississippi' },
                { 'value': "MO", 'text': 'Missouri' },
                { 'value': "MT", 'text': 'Montana' },
                { 'value': "NE", 'text': 'Nebraska' },
                { 'value': "NV", 'text': 'Nevada' },
                { 'value': "NH", 'text': 'New Hampshire' },
                { 'value': "NJ", 'text': 'New Jersey' },
                { 'value': "NM", 'text': 'New Mexico' },
                { 'value': "NY", 'text': 'New York' },
                { 'value': "NC", 'text': 'North Carolina' },
                { 'value': "ND", 'text': 'North Dakota' },
                { 'value': "OH", 'text': 'Ohio' },
                { 'value': "OK", 'text': 'Oklahoma' },
                { 'value': "OR", 'text': 'Oregon' },
                { 'value': "PA", 'text': 'Pennsylvania' },
                { 'value': "RI", 'text': 'Rhode Island' },
                { 'value': "SC", 'text': 'South Carolina' },
                { 'value': "SD", 'text': 'South Dakota' },
                { 'value': "TN", 'text': 'Tennessee' },
                { 'value': "TX", 'text': 'Texas' },
                { 'value': "UT", 'text': 'Utah' },
                { 'value': "VT", 'text': 'Vermont' },
                { 'value': "VA", 'text': 'Virginia' },
                { 'value': "WA", 'text': 'Washington' },
                { 'value': "DC", 'text': 'Washington D.C.' },
                { 'value': "WI", 'text': 'Wisconsin' },
                { 'value': "WV", 'text': 'West Virginia' },
                { 'value': "WY", 'text': 'Wyoming' },
            ],
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },

    methods: {
        goBack () {
            this.$store.commit('setProgressBar', 20);
        },
        verifyInput () {
            // TODO will add function to verify after api is created
            if (true) {
                this.$store.commit('setProgressBar', 60);
            }
        }
    }
};
</script>
