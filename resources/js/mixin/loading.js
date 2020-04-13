'use strict';

export default {
    data () {
        return {
            is_loading: false,
        }
    },
    methods: {
        showLoader () {
            this.loader = this.$loading.show({
                color: this.portfolio.secondary_color,
                loader: 'dots',
                container: this.$refs.loading,
                'is-full-page': false,
            });
        },
        hideLoader () {
            this.loader.hide();
            this.loader = null;
        },
    },
}
