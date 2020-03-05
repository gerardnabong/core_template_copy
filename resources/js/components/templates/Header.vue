<template>
    <div>
        <div
            class="col-12 text-center client-portal-header desktop-hide"
            :style="{'background-image': this.backgroundImage}"
        >
            <img :src="'images/logo/'+this.portfolio.logo" alt />
        </div>
        <div
            class="col-12 text-center client-portal-header mobile-hide"
            :style="{'background-image': this.desktopBackgroundImage}"
        >
            <img :src="'images/logo/'+this.portfolio.logo" alt />
        </div>
    </div>
</template>

<script>
// TODO This is only for vue template and will be remove later
export default {
    Name: "Header",
    data() {
        return {
            imgUrlPrepend: "url('../images/"
        };
    },
    computed: {
        portfolio: {
            get() {
                return this.$store.state.portfolio;
            }
        },
        backgroundImage() {
            return this.imgUrlPrepend + this.portfolio.header_background_mobile;
        },
        desktopBackgroundImage() {
            return this.imgUrlPrepend + this.portfolio.header_background;
        }
    }
};
</script>
