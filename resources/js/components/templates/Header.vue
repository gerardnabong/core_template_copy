<template>
    <div class="row no-gutters">
        <div class="col-12 text-center client-portal-header desktop-hide position-relative">
            <div class="client-portal-background-image">
                <img
                    class="w-100"
                    :src="'/images/' + portfolio.asset_directory + '/header_mobile.svg'"
                />
            </div>
            <router-link to="/">
                <img
                    class="client-portal-header-logo"
                    :src="'/images/' + portfolio.asset_directory + '/logo.svg'"
                />
            </router-link>
        </div>
        <div class="col-12 text-center client-portal-header mobile-hide position-relative">
            <div class="client-portal-background-image">
                <img
                    class="w-100"
                    :src="'/images/' + portfolio.asset_directory + '/header_desktop.svg'"
                />
            </div>
            <router-link to="/">
                <img
                    class="client-portal-header-logo"
                    :src="'/images/' + portfolio.asset_directory + '/logo.svg'"
                />
            </router-link>
        </div>
    </div>
</template>

<script>
'use strict';

export default {
    Name: 'Header',

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
