<template>
    <div>
        <div
            class="col-12 client-portal-footer desktop-hide"
            :style="{'background-image': this.backgroundImage}"
        ></div>
        <div
            class="col-12 client-portal-footer mobile-hide"
            :style="{'background-image': this.backgroundImageDesktop}"
        ></div>
    </div>
</template>

<script>
// TODO This is only for vue template and will be remove later
export default {
    Name: "Footer",
    data() {
        return {
            imageUrlPrepend: "url('../images/"
        };
    },
    computed: {
        backgroundImage() {
            return (
                this.imageUrlPrepend + this.$store.state.portfolio.wave_mobile
            );
        },
        backgroundImageDesktop() {
            return this.imageUrlPrepend + this.$store.state.portfolio.wave;
        }
    }
};
</script>
