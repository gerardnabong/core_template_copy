<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span
                    class="icon-paper-document-icon client-portal-icon"
                    :style="{color: portfolio.button_color}"
                />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <b-progress class="online-verification-progressbar-container mb-4">
                    <b-progress-bar
                        :style="{'background-color': portfolio.button_color}"
                        :value="progressBar"
                        show-progress
                        class="online-verification-progressbar"
                    />
                </b-progress>
                <h2 class="client-portal-heading-text mb-5">
                    Easy Online Verification as Fast as 5 minutes
                </h2>
                <complete-name />
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
import CompleteName from '~/components/templates/online-verification/CompleteName';

export default {
    name: 'OnlineVerification',

    components: {
        CallUsButton,
        CompleteName,
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.clientPortalButton = this.portfolio.button_color;
        this.$store.commit('setProgressBar', 20);
        this.progressBar = this.$store.getters.getProgressBar;
    },
};
</script>
