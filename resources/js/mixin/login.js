'use strict';

import Loading from '~/mixin/loading';
import WelcomeMessageModal from '~/components/templates/modal/WelcomeMessageModal';
import ErrorAlert from '~/components/templates/errors/ErrorAlert';

const LOADING_TIMEOUT_MS = 3000;

export default({
    data () {
        return {
            form_data: {
                email_address: null,
                ssn: null,
            },
            error: null,
        };
    },

    mixins: [Loading],

    components: {
        WelcomeMessageModal,
        ErrorAlert,
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        this.loginPrimaryColor = this.portfolio.primary_color;
    },

    methods: {
        login (event) {
            event.preventDefault();
            $.post({
                url: '/api/login-client/',
                data: this.form_data,
                beforeSend: () => {
                    this.showLoader();
                },
                success: (response) => {
                    this.$store.commit('setClient', response);
                    let loginModal = this.$refs['welcomeMessageModal'];
                    loginModal.showSuccess();
                    loginModal.show();
                    setTimeout(() => {
                        this.$router.go();
                    }, LOADING_TIMEOUT_MS);
                },
                error: (response) => {
                    this.$store.commit('setError', response.responseJSON);
                },
                complete: () => {
                    this.hideLoader();
                },
            });
        },
    },
});
