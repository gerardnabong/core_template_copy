<template>
    <a
        :href="phone_number"
        class="client-portal-btn-primary color-white text-decoration-none font-weight-semibold border-0 mb-3"
        :style="{ 'background-color': callUsButtonColor }"
        @mouseover="callUsButtonColor = portfolio.primary_color_hover"
        @mouseleave="callUsButtonColor = portfolio.primary_color"
    >
        {{ portfolio.phone_number }}
    </a>
</template>

<script>
'use strict';

export default {
    name: 'CallUsButton',

    computed: {
        phone_number () {
            var phone_number = this.portfolio.phone_number;
            return 'tel: +' + phone_number.replace(/-/g, '');
        },
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.callUsButtonColor = this.portfolio.primary_color;
    },
};
</script>
