<template>
    <a
        :href="this.phone_number"
        class="text-decoration-none card call-us-background py-3 px-2 client-portal-border-none call-us-button color-black"
    >
        <div class="row justify-content-center no-gutters">
            <div class="col-4 align-self-center call-us-icon mobile-hide tablet-show pr-2">
                <i class="fas fa-phone fa-rotate-90 color-override" :style="iconColor"></i>
            </div>
            <div class="col-8">
                <div class="row flex-column call-us-text no gutters">
                    <div class="col p-0 pl-2">Call us at</div>
                    <div class="col p-0 pl-2 font-weight-bold call-us-number color-override" :style="iconColor">{{this.portfolio.phone_number}}</div>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
"use strict";

export default {
    name: "CallUsButton",

    data() {
        return {
            portfolio: null,
        };
    },

    computed: {
        iconColor() {
            return {
                '--color': this.portfolio.button_color,
            };
        },
        phone_number() {
            var phone_number = this.portfolio.phone_number;
            return 'tel:+' + phone_number.replace(/-/g, '');
        },
    },

    created() {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
