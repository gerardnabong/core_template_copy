<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <span
                    class="icon-icon not-found-icon"
                    :style="{ color: portfolio.button_color }"
                ></span>
                <div>
                    <h1 class="client-portal-heading-text">
                        Oops! Sorry we can't find that page
                    </h1>
                    <p class="mt-3">
                        Either something went wrong or the page doesn't exist anymore
                    </p>
                    <router-link
                        class="btn color-white client-portal-btn-primary border-0 mt-3"
                        :style="{ 'background-color': home_button_color }"
                        @mouseover="home_button_color = portfolio.button_hover_color"
                        @mouseleave="home_button_color = portfolio.button_color"
                        to="/"
                    >
                        Home
                    </router-link>
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
    name: 'PageNotFound',

    components: {
        CallUsButton,
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.home_button_color = this.portfolio.button_color;
    },
};
</script>
