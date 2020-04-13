'use strict';

import WelcomeMessageModal from '~/components/templates/modal/WelcomeMessageModal';

const LOADING_TIMEOUT_MS = 3000;

export default({
    data () {
        return {
            formData: {
                email_address: null,
                ssn: null,
            },
            isLoading: false,
            error: null,
        };
    },

    components: {
        WelcomeMessageModal,
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.loginPrimaryColor = this.portfolio.primary_color;
    },

    methods: {
        login (event) {
            event.preventDefault();
            let message;
            $.post({
                url: '/api/login-client/',
                data: this.formData,
                beforeSend: (() => {
                    this.isLoading = true;
                    this.showLoader();
                }),
                success: ((response) => {
                    this.$store.commit('setClient', response);
                    let loginModal = this.$refs['welcomeMessageModal'];
                    loginModal.showSuccess();
                    loginModal.hideOkButton();
                    loginModal.show();
                    setTimeout(() => {
                        this.$router.go();
                    }, LOADING_TIMEOUT_MS);
                }),
                error: ((response) => {
                    this.error = response.responseJSON;
                }),
                complete: (() => {
                    this.isLoading = false;
                    this.hideLoader();
                }),
            });
        },
        showLoader () {
            this.loader = this.$loading.show({
                color: this.portfolio.secondary_color,
                loader: 'dots',
                container: this.$refs.loading_container,
                'is-full-page': false,
            });
        },
        hideLoader () {
            this.loader.hide();
            this.loader = null;
        },
    },
});
