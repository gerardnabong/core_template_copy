<template>
    <div class="row no-gutters client-portal-min-height-100">
        <div class="col-12 container-fluid">
            <header-client-portal />
            <div class="row no-gutters">
                <div class="col-12 text-center client-portal-container">
                    <transition
                        name="client-router-transition"
                        v-on:before-enter="showLoader"
                        v-on:after-enter="hideLoader"
                    >
                        <router-view />
                    </transition>
                </div>
            </div>
        </div>
        <footer-client-portal />
    </div>
</template>
<script>
'use strict';

import HeaderClientPortal from '~/components/templates/Header';
import FooterClientPortal from '~/components/templates/Footer';

export default {
    name: 'Index',
    components: {
        HeaderClientPortal,
        FooterClientPortal,
    },

    methods: {
        showLoader () {
            this.loader = this.$loading.show({
                opacity: 1,
                color: this.portfolio.primary_color,
                loader: 'dots',
            });
        },
        hideLoader () {
            this.loader.hide();
            this.loader = null;
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.showLoader();
    },

    mounted () {
        setTimeout(() => {
            this.hideLoader();
        }, 300);
    },
};
</script>
