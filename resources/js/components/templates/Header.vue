<template>
    <div class="row no-gutters">
        <div class="col-12 text-center client-portal-header desktop-hide position-relative">
            <div class="client-portal-background-image">
                <img class="w-100" :src="'images/'+portfolio.header_image_mobile_url" />
            </div>
            <img class="client-portal-header-logo" :src="'images/logo/'+portfolio.logo_url" />
        </div>
        <div class="col-12 text-center client-portal-header mobile-hide position-relative">
            <div class="client-portal-background-image">
                <img class="w-100" :src="'images/'+portfolio.header_image_url" />
            </div>
            <img
                class="client-portal-header-logo"
                :src="'images/logo/'+portfolio.logo_url"
            />
        </div>
    </div>
</template>

<script>
"use strict";

export default {
    Name: "Header",
    data() {
        return {
            portfolio: null
        };
    },

    created() {
        this.portfolio = this.$jsVars.portfolio;
    }
};
</script>
