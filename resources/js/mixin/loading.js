'use strict';

export default {
    data () {
        return {
            is_loading: false,
        }
    },
    methods: {
        showLoader () {
            this.is_loading = true;
            this.loader = this.$loading.show({
                color: this.portfolio.secondary_color,
                loader: 'dots',
                container: this.$refs.loading_container,
                'is-full-page': false,
            });
        },
        hideLoader () {
            this.is_loading = false;
            this.loader.hide();
            this.loader = null;
        },
    },
}
