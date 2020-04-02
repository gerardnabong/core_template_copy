<template>
    <div class="row no-gutters w-100 align-items-end">
        <div class="col-12 desktop-hide position-relative">
            <div class="client-portal-background-image">
                <img
                    class="w-100"
                    :src="'/images/' + portfolio.name + '/' + portfolio.footer_image_mobile_url"
                />
            </div>
        </div>
        <div class="col-12 mobile-hide position-relative">
            <div class="client-portal-background-image">
                <img
                    class="w-100"
                    :src="'/images/' + portfolio.name + '/' + portfolio.footer_image_url"
                />
            </div>
        </div>
    </div>
</template>

<script>
'use strict';

export default {
    Name: 'Footer',

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },
};
</script>
