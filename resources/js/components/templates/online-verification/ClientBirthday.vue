<template>
    <div>
        <div class="mb-4">How about your date of birth?</div>
        <b-form-group class="mb-3">
            <b-input-group class="mb-3">
                <!-- TODO ISSUE with date format cannot change format will find a fix -->
                <b-form-input
                    v-model="birthday"
                    type="text"
                    placeholder="YYYY/MM/DD"
                    class="mb-2 client-portal-form-input client-portal-date-picker"
                    :date-format-options="date_format"
                    v-mask="'9999/99/99'"
                    @mouseover='triggerDatePickerButton'
                />
                <b-input-group-append class="client-portal-date-picker-appened">
                    <b-form-datepicker
                        v-model="birthday"
                        button-only
                        right
                        :date-format-options="date_format"
                        class="client-portal-date-picker-button"
                    />
                </b-input-group-append>
            </b-input-group>
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
import * as constants from '~/fixed_variables/online_verification_steps';

const DATE_FORMAT = {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
};

export default {
    name: 'ClientBirthday',

    data () {
        return {
            // TODO will change when created Database Entry for Page
            // TODO create constant id
            page_id: 5,
            birthday: null,
        }
    },

    components: {
        CallUsButton,
    },

    methods: {
        goBack () {
            this.$store.commit('setProgressBar', constants.PROGRESS_BAR_STEP_TWO);
        },
        verifyInput () {
            // TODO will add function to verify after api is created
            if (true) {
                this.$store.commit('setProgressBar', constants.PROGRESS_BAR_STEP_FOUR);
            }
        },
        triggerDatePickerButton () {
            $('.client-portal-date-picker-button button').trigger('click');
        },
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },

    computed: {
        date_format () {
            return {
                DATE_FORMAT,
            }
        }
    }
};
</script>
