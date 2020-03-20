<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span
                    class="icon-Success-steps-icon client-portal-icon"
                    :style="{color: portfolio.button_color}"
                    v-if="progressBar == 100"
                />
                <span
                    class="icon-paper-document-icon client-portal-icon"
                    :style="{color: portfolio.button_color}"
                    v-else
                />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <b-progress class="online-verification-progressbar-container mb-4">
                    <b-progress-bar
                        :style="{'background-color': portfolio.button_color}"
                        :value="$store.getters.getProgressBar"
                        show-progress
                        class="online-verification-progressbar"
                    />
                </b-progress>
                <h2
                    class="client-portal-heading-text mb-5"
                    v-if="progressBar == 90"
                >
                    Verify your Bank Account
                </h2>
                <h2
                    class="client-portal-heading-text mb-5"
                    v-else
                >
                    Easy Online Verification as Fast as 5 minutes
                </h2>
                <transition name="online-verification-transition">
                    <client-name v-if="progressBar == 20" />
                    <client-address v-else-if="progressBar == 40" />
                    <client-birthday v-else-if="progressBar == 60" />
                    <client-military-status v-else-if="progressBar == 80" />
                    <client-bank-account v-else-if="progressBar == 90" />
                    <verification-complete v-else-if="progressBar == 100" />
                </transition>
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
import ClientAddress from '~/components/templates/online-verification/ClientAddress';
import ClientBankAccount from '~/components/templates/online-verification/ClientBankAccount';
import ClientBirthday from '~/components/templates/online-verification/ClientBirthday';
import ClientMilitaryStatus from '~/components/templates/online-verification/ClientMilitaryStatus';
import ClientName from '~/components/templates/online-verification/ClientName';
import VerificationComplete from '~/components/templates/online-verification/VerificationComplete';

export default {
    name: 'OnlineVerification',

    components: {
        CallUsButton,
        ClientAddress,
        ClientBankAccount,
        ClientBirthday,
        ClientMilitaryStatus,
        ClientName,
        VerificationComplete,
    },

    computed: {
        progressBar () {
            return this.$store.getters.getProgressBar;
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.clientPortalButton = this.portfolio.button_color;
        this.$store.commit('setProgressBar', 20);
    },
};
</script>
