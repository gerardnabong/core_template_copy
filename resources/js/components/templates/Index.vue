<template>
    <div class="row no-gutters client-portal-min-height-100">
        <div class="col-12 container-fluid">
            <header-client-portal />
            <div class="row no-gutters">
                <div class="col-12 text-center client-portal-container">
                    <div
                        class="logout-gear"
                        v-if="$store.getters.getClient"
                    >
                        <b-dropdown
                            right
                            no-caret
                            variant='link'
                            class="client-portal-dropdown-none"
                        >
                            <template v-slot:button-content>
                                <div
                                    class="client-portal-gear-icon"
                                    :style="{'background-color' : portfolio.secondary_color}"
                                >
                                    <i class="fas fa-cog fa-2x color-white" />
                                </div>
                            </template>
                            <b-dropdown-item>
                                <logout-button />
                            </b-dropdown-item>
                        </b-dropdown>
                    </div>
                    <transition
                        v-on:before-enter="showLoader"
                        v-on:after-leave="hideLoader"
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
import LogoutButton from '~/components/templates/buttons/LogoutButton';

export default {
    name: 'Index',

    components: {
        HeaderClientPortal,
        FooterClientPortal,
        LogoutButton,
    },

    methods: {
        showLoader () {
            this.loader = this.$loading.show({
                opacity: 1,
                color: this.portfolio.secondary_color,
                loader: 'dots',
                transition: 'client-router-transition',
            });
        },
        hideLoader (delay = 300) {
            setTimeout(() => {
                this.loader.hide();
                this.loader = null;
            }, delay);
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.showLoader();
    },

    mounted () {
        this.hideLoader(500);
    },
};
</script>
