<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span
                    class="icon-computer-gear-icon client-portal-icon"
                    :style="{color: portfolio.primary_color}"
                />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <h2 class="client-portal-heading-text">Your application is still on process</h2>
                <div class="mt-5">
                    <p class="client-portal-paragraph">A customer representative will contact you soon!</p>
                    <b-button
                        class="client-portal-button client-portal-btn-primary client-portal-btn-submit mt-3"
                        :style="{ 'background-color': clientPortalButton }"
                        @mouseover="clientPortalButton = portfolio.button_hover_color"
                        @mouseleave="clientPortalButton = portfolio.primary_color"
                    >Logout</b-button>
                </div>
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

export default {
    name: 'OnProcess',

    components: {
        CallUsButton,
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.clientPortalButton = this.portfolio.primary_color;
    },
};
</script>
