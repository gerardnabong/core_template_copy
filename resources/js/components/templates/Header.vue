<template>
    <div class="row no-gutters">
        <div class="col-12 text-center client-portal-header desktop-hide position-relative">
            <div class="client-portal-background-image">
                <img class="w-100" :src="'images/'+this.portfolio.header_image_mobile_url" />
            </div>
            <img
                class="client-portal-header-logo"
                :src="'images/logo/'+this.portfolio.logo_url"

            />
        </div>
        <div class="col-12 text-center client-portal-header mobile-hide position-relative">
            <div class="client-portal-background-image">
                <img class="w-100" :src="'images/'+this.portfolio.header_image_url" />
            </div>
            <img
                class="client-portal-header-logo"
                :src="'images/logo/'+this.portfolio.logo_url"
            />
        </div>
    </div>
</template>

<script>
"use strict";
// TODO This is only for vue template and will be remove later
export default {
    Name: "Header",

    computed: {
        portfolio: {
            get() {
                return this.$store.state.portfolio;
            }
        }
    }
};
</script>
