<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span
                    class="icon-check-icon client-portal-icon"
                    :style="{color: portfolio.button_color}"
                ></span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <h2
                    class="client-portal-heading-text"
                >Thank You. We have successfully received your application</h2>
                <div class="mt-5">
                    <p
                        class="client-portal-paragraph"
                    >A customer representative will contact you soon!</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="d-flex my-5">
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

    data() {
        return {
            portfolio: null,
        };
    },

    components: {
        CallUsButton,
    },

    created() {
        this.portfolio = this.$jsVars.portfolio;
        this.clientPortalButton = this.portfolio.button_color;
    },
};
</script>
