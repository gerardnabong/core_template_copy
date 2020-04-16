<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span
                    class="icon-sad-icon client-portal-icon"
                    :style="{color: portfolio.secondary_color}"
                />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <h2 class="client-portal-heading-text mb-4">{{heading_message}}</h2>
                <div class="mt-3">
                    <p class="client-portal-paragraph">
                        {{content}}
                    </p>
                    <b-button
                        class="client-portal-button client-portal-btn-primary client-portal-btn-submit mt-3"
                        :style="{ 'background-color': clientPortalButton }"
                        @mouseover="clientPortalButton = portfolio.primary_color_hover"
                        @mouseleave="clientPortalButton = portfolio.primary_color"
                        @click="tryAgain"
                    >Try Again</b-button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mt-5 mb-3">
                <div class="client-portal-paragraph">
                    If you would like to complete your bank verification over the phone.
                    Please click the call us button below:
                </div>
            </div>
        </div>
        <div class="px-3">
            <div class="d-flex justify-content-center mb-5">
                <call-us-button />
            </div>
        </div>
    </div>
</template>

<script>
'use strict';

import CallUsButton from '~/components/templates/buttons/CallUsButton';

export default {
    name: 'ErrorPage',

    components: {
        CallUsButton,
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.clientPortalButton = this.portfolio.primary_color;
        switch (this.$route.query.type) {
            case 'online-verification':
                this.heading_message = 'Request Code Not Completed';
                this.content = 'The request failed for some reason, but you are still on track.';
                this.url = '/online-verification';
                break;
        }
    },

    methods: {
        tryAgain () {
            this.$router.push(this.url);
        }
    }
};
</script>
