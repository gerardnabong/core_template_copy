<template>
    <div>
        <div class="mb-4">How about your date of birth?</div>
        <b-form-group class="mb-3">
            <b-form-datepicker
                v-model="birthday"
                class="mb-2 client-portal-form-input client-portal-date-picker"
                placeholder="MM/DD/YYYY"
                :date-format-options="date_format"
                required
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
    </div>
</template>

<script>
'use strict';

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
            page_id: 5,
            birthday: null,
        }
    },

    methods: {
        goBack () {
            this.$store.commit('setProgressBar', 40);
        },
        verifyInput () {
            // TODO will add function to verify after api is created
            if (true) {
                this.$store.commit('setProgressBar', 80);
            }
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },

    computed: {
        date_format () {
            return {
                DATE_FORMAT
            }
        }
    }
};
</script>
